<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor
 *
 * @copyright   Copyright (C) 2016 Alexon Balangue. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function modChrome_nones($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
	}
}
/******************BEGINS BOOSTRAP***********************/
function modChrome_bswell($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'page-header'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="well ' . htmlspecialchars($params->get('moduleclass_sfx')) . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}

/******************BOOSTRAP 3***********************/
function modChrome_bs3withtitlehead($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'col-xs-12 col-sm-12 col-md-' . $bootstrapSize . ' col-lg-' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_bs3frontendshowNocolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'col-xs-' . $bootstrapSize . ' col-sm-' . $bootstrapSize . ' col-md-' . $bootstrapSize . ' col-lg-' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_bs3frontendshowYescolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'col-xs-' . $bootstrapSize . ' col-sm-' . $bootstrapSize . ' col-md-' . $bootstrapSize . ' col-lg-' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_bs3FooterShow($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'col-xs-12 col-sm-6 col-md-' . $bootstrapSize . ' col-lg-' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}

/*********Boostrap4*********/
function modChrome_bs4withtitlehead($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_bs4frontendshowNocolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_bs4frontendshowYescolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_bs4FooterShow($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}


/******************BOOSTRAP 2***********************/
function modChrome_bs2withtitlehead($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_bs2frontendshowNocolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_bs2frontendshowYescolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_bs2FooterShow($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'span' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}

/******************Foundation***********************/
function modChrome_fi6withtitlehead($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'small-12 large-' . $bootstrapSize.' columns' : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_fi6frontendshowNocolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'small-12 large-' . $bootstrapSize.' columns' : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_fi6frontendshowYescolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'small-12 large-' . $bootstrapSize.' columns' : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_fi6FooterShow($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'small-12 large-' . $bootstrapSize.' columns' : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}

/******************MetroUI***********************/
function modChrome_muiwithtitlehead($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'cells' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_muifrontendshowNocolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'cells' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_muifrontendshowYescolor($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'cells' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '" itemprop="alternativeHealine">' . $module->title . '</' . $headerTag . '><hr />';
			}

			echo '<div class="row">'.$module->content.'</div>';
		echo '</' . $moduleTag . '>';
	}
}
function modChrome_muiFooterShow($module, &$params, &$attribs)
{
	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? 'cells' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'text-center'));

	if ($module->content)
	{
		echo '<' . $moduleTag . ' class="' . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '</' . $headerTag . '>';
			}

			echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}