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

	public function twig_prefix_relative_path(Twig_Environment $env, $value)
	{
		$dir = dirname($_SERVER['SCRIPT_NAME']);
		return $dir.'/'.$value;
	}
}

?>