<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\toolbar\panels\traits;

use Closure;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

/**
 * Dumper trait.
 *
 * @author Frederic G. Østby
 */
trait DumperTrait
{
	/**
	 * Styles the dumper.
	 *
	 * @access protected
	 * @param \Symfony\Component\VarDumper\Dumper\HtmlDumper $dumper HTML dumper
	 */
	protected function styleDumper(HtmlDumper $dumper)
	{
		$styles =
		[
			'default'   => 'background-color:transparent; color:#91CDA4; line-height:1.2em; font:14px Menlo, Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:99999; word-break: normal',
			'num'       => 'font-weight:normal; color:#666',
	        'const'     => 'font-weight:bold',
	        'str'       => 'font-weight:normal; color:#888',
	        'note'      => 'color:#666',
	        'ref'       => 'color:#A0A0A0',
	        'public'    => 'color:#94A9A9',
	        'protected' => 'color:#94A9A9',
	        'private'   => 'color:#94A9A9',
	        'meta'      => 'color:#7B8D8D',
	        'key'       => 'color:#569771',
	        'index'     => 'color:#666',
	        'ellipsis'  => 'color:#91CDA4',
		];

		$dumper->setStyles($styles);
	}

	/**
	 * Returns a dumper closure.
	 *
	 * @access protected
	 * @return \Closure
	 */
	protected function getDumper(): Closure
	{
		$dumper = new HtmlDumper;

		$this->styleDumper($dumper);

		return function($variable) use ($dumper)
		{
			$dumper->dump((new VarCloner)->cloneVar($variable));
		};
	}
}
