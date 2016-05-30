<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor
 *
 * @copyright   Copyright (C) 2016 Alexon Balangue. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;
if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);# Add this code For Joomla 3.3.4+
$apps             = JFactory::getApplication();
$docs             = JFactory::getDocument();
$users            = JFactory::getUser();
$this->language  = $docs->language;
$this->direction = $docs->direction;

// Getting params from template
$params = $apps->getTemplate(true)->params;

$sitename = $apps->get('sitename');
$desc_site = $apps->getCfg('MetaDesc');
//PARAMS
$Grps_html = $this->params->get('groups-html');
$hide_joomla_default = $this->params->get('Pages-js-default');
// Output as HTML5
$docs->setHtml5(true);

//Remove défault JS Joomla 3.3.6/+ on front end home pages or other component
switch($hide_joomla_default):
	case 'home':
		$this->_script = $this->_scripts = array();	
		//JHtml::_('bootstrap.framework', false); <= this method not work
		//JHtml::_('jquery.framework', false);<=this method not work
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/core.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/modal.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/caption.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);
	break;
	case 'component':
		foreach ($this->_scripts as $script => $value){ if (preg_match('/media\/jui/i', $script)){ unset($this->_scripts[$script]); } }	
	break;
endswitch;

/*
if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Check for a custom CSS file
$userCss = JPATH_SITE . '/templates/' . $this->template . '/css/user.css';

if (file_exists($userCss) && filesize($userCss) > 0)
{
	$docs->addStyleSheetVersionVersion('templates/' . $this->template . '/css/user.css');
}

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}
*/
// Logo file or site title param

if ($this->params->get('logoFile')){ $logo = '[img src="'.JUri::root() . $this->params->get('logoFile').'" alt="'.$sitename.'" /]'; } else { $logo = $sitename; }

$Params_grpsJs = $this->params->get('groups-method');
$Params_grpsCSS = $this->params->get('groups-method');
if ($Params_grpsJs == 'production') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.min.css');
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/template.min.css');
elseif ($Params_grpsJs == 'custom') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.min.css');
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/template.min.css');
elseif ($Params_grpsJs == 'developpment') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.min.css');
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/template.min.css');
elseif ($Params_grpsJs == 'default') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.min.css');
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/template.min.css');
elseif ($Params_grpsJs == 'base') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.min.css');
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/template.min.css');
endif;

?>

[doctype html="html" /]
<html <?php echo $params->get('ampHTML'); ?> lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	[head]<jdoc:include type="head" />[/head]
	<?php switch($Grps_html): case 'boostrap2': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conception by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer] 
	<?php break; case 'boostrap3': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conception by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'amp': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conception by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'foundation': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conception by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'metroui': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conception by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; endswitch; ?>
	
		<?php if ($this->countModules('referencer')) : ?><jdoc:include type="modules" name="referencer" style="none" /><?php endif; ?>	
		<?php if ($Params_grpsJs == 'production') : ?>
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/full.min.js'; ?>" /]			
		<?php elseif ($Params_grpsJs == 'custom') : ?>	
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/full.js'; ?>" /]		
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/template.js'; ?>" /]				
		<?php elseif ($Params_grpsJs == 'developpment') : ?>	
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/full.js'; ?>" /]		
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/template.js'; ?>" /]			
		<?php elseif ($Params_grpsJs == 'default') : ?>	
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/template.js'; ?>" /]
		<?php elseif ($Params_grpsJs == 'base') : ?>	
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/template.js'; ?>" /]	
		<?php endif; ?>	
	
	
		<?php if (!$params->get('ampHTML') == 'amp'): ?>[cookies legal="<?php echo JText::_('TPL_COOPCEPTOR_COOKIESEU_HOME'); ?>" botton="Ok" url="#" /]<?php else: echo ' '; endif; ?>
		
		<jdoc:include type="modules" name="debug" style="none" />	

	[ends tags="body" /]  
</html>
