<?php

/**
 * This file is part of Twig.
 *
 * (c) 2009 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Henrik Bjornskov <hb@peytz.dk>
 * @package Twig
 * @subpackage Twig-extensions
 */

namespace slc\twig_relative_directory;

use Twig_Extension;
use Twig_SimpleFilter;
use Twig_Environment;

class RelativePath extends Twig_Extension
{
	private static $pathReplacements = array();
	/**
	 * Returns a list of filters.
	 *
	 * @return array
	 */
	public function getFilters()
	{
		return array(
			new Twig_SimpleFilter('prefix_relative_path', array($this, 'twig_prefix_relative_path'), array('needs_environment' => true)),
		);
	}

	/**
	 * Name of this extension
	 *
	 * @return string
	 */
	public function getName()
	{
		return 'RelativePath';
	}
	public static function setPathReplacements(array $values) {
		static::$pathReplacements = $values;
	}
	public static function getPathReplacements() {
		return static::$pathReplacements;
	}

	public function twig_prefix_relative_path(Twig_Environment $env, $value)
	{
		$dir = dirname($_SERVER['SCRIPT_NAME']);
		if(sizeof(static::$pathReplacements) > 0) {
			$dir = preg_replace(array_keys(static::$pathReplacements), array_values(static::$pathReplacements), $dir);
		}
		if(substr($dir, -1) === '/') {
			return $dir.$value;
		}
		return $dir . '/' . $value;
	}
}

?>