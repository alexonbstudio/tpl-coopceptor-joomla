<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor
 *
 * @copyright   Copyright (C) 2016 Alexon Balangue. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

$apps             = JFactory::getApplication();
$docs             = JFactory::getDocument();
$users            = JFactory::getUser();
$this->language  = $docs->language;
$this->direction = $docs->direction;

// Getting params from template
$params = $apps->getTemplate(true)->params;

$sitename = $apps->get('sitename');
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

// Load optional RTL Bootstrap CSS
//JHtml::_('bootstrap.loadCss', false, $this->direction);

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

//CSS CUSTM PARAMS
$FullCss = '/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.css';
$FullCssMin = '/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.min.css';
$TPLCss = '/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/template.css';
$TPLCssMin = '/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/template.min.css';
$Params_grpsCSS = $this->params->get('groups-method');
switch($Params_grpsCSS):
	case 'base': if (file_exists($FullCss) && filesize($FullCss) > 0) { $docs->addStyleSheetVersion($FullCss); } break;
	case 'default': if (file_exists($TPLCss) && filesize($TPLCss) > 0) { $docs->addStyleSheetVersion($TPLCss); } break;
	case 'developpment': if (file_exists($TPLCss) && filesize($TPLCss) > 0) { $docs->addStyleSheetVersion($TPLCss); } if (file_exists($FullCss) && filesize($FullCss) > 0) { $docs->addStyleSheetVersion($FullCss); } break;
	case 'custom': if (file_exists($FullCss) && filesize($FullCss) > 0) { $docs->addStyleSheetVersion($FullCss); } if (file_exists($TPLCss) && filesize($TPLCss) > 0) { $docs->addStyleSheetVersion($TPLCss); } break;
	case 'production': if (file_exists($FullCssMin) && filesize($FullCssMin) > 0) { $docs->addStyleSheetVersion($FullCssMin); } break;
endswitch;
//Js CUSTM PARAMS
$FullJs = '/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/full.js';
$FullJsMin = '/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/full.min.js';
$TPLJs = '/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/template.js';
$TPLJsMin = '/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/template.min.js';
$Params_grpsJs = $this->params->get('groups-method');


?>
[doctype html="html" /]
<html <?php echo $params->get('ampHTML'); ?> lang="en" dir="<?php echo $this->direction; ?>">
	[head]<jdoc:include type="head" />[/head]
	<?php switch($Grps_html): case 'boostrap2': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		<?php /**********************************	header	*********************************************/ ?>
		[header]
			<?php echo $logo; ?>
		[/header]
		<?php /**********************************	BODY	*********************************************/ ?>
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />		
		[/section]
		<?php /**********************************	FOOTER	*********************************************/ ?>
		[footer]
			
		[/footer]
		<?php
			switch($Params_grpsJs):
				case 'base': 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
				break;
				case 'default': 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]'; } 
				break;
				case 'developpment': 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]';} 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
				break;
				case 'custom': 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]'; } 
				break;
				case 'production': 
					if (file_exists($FullJsMin) && filesize($FullJsMin) > 0) { echo '[script src="'.$FullJsMin.'" /]'; } 
				break;
			endswitch;
		?>
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/application.js" /]  
	<?php break; case 'boostrap3': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		<?php /**********************************	header	*********************************************/ ?>
		[header]
			<?php echo $logo; ?>
		[/header]
		<?php /**********************************	BODY	*********************************************/ ?>
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		<?php /**********************************	FOOTER	*********************************************/ ?>
		[footer]
		
		[/footer]
		<?php
			switch($Params_grpsJs):
				case 'base': 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
				break;
				case 'default': 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]'; } 
				break;
				case 'developpment': 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]';} 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
				break;
				case 'custom': 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]'; } 
				break;
				case 'production': 
					if (file_exists($FullJsMin) && filesize($FullJsMin) > 0) { echo '[script src="'.$FullJsMin.'" /]'; } 
				break;
			endswitch;
		?>
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/application.js" /]
	<?php break; case 'amp': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		<?php /**********************************	header	*********************************************/ ?>
		[header]
			<?php echo $logo; ?>
		[/header]
		<?php /**********************************	BODY	*********************************************/ ?>
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		<?php /**********************************	FOOTER	*********************************************/ ?>
		[footer]
		
		[/footer]
	<?php break; case 'foundation': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		<?php /**********************************	header	*********************************************/ ?>
		[header]
		<?php echo $logo; ?>
		[/header]
		<?php /**********************************	BODY	*********************************************/ ?>
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		<?php /**********************************	FOOTER	*********************************************/ ?>
		[footer]
		
		[/footer]
		<?php
			switch($Params_grpsJs):
				case 'base': 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
				break;
				case 'default': 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]'; } 
				break;
				case 'developpment': 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]';} 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
				break;
				case 'custom': 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]'; } 
				break;
				case 'production': 
					if (file_exists($FullJsMin) && filesize($FullJsMin) > 0) { echo '[script src="'.$FullJsMin.'" /]'; } 
				break;
			endswitch;
		?>  
	<?php break; case 'metroui': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		<?php /**********************************	header	*********************************************/ ?>
		[header]
			<?php echo $logo; ?>
		[/header]
		<?php /**********************************	BODY	*********************************************/ ?>
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		<?php /**********************************	FOOTER	*********************************************/ ?>
		[footer]
		
		[/footer]
		<?php
			switch($Params_grpsJs):
				case 'base': 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
				break;
				case 'default': 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]'; } 
				break;
				case 'developpment': 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]';} 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
				break;
				case 'custom': 
					if (file_exists($FullJs) && filesize($FullJs) > 0) { echo '[script src="'.$FullJs.'" /]'; } 
					if (file_exists($TPLJs) && filesize($TPLJs) > 0) { echo '[script src="'.$TPLJs.'" /]'; } 
				break;
				case 'production': 
					if (file_exists($FullJsMin) && filesize($FullJsMin) > 0) { echo '[script src="'.$FullJsMin.'" /]'; } 
				break;
			endswitch;
		?>
	<?php break; endswitch; ?>
		<?php /**********************************	OTHERS	*********************************************/ ?>
		<?php if (!$params->get('ampHTML') == 'amp'): ?>[cookies legal="<?php echo JText::_('TPL_COOPCEPTOR_COOKIESEU_HOME'); ?>" botton="Ok" url="#" /]<?php else: echo ' '; endif; ?>
		<?php if ($this->countModules('referencer')) : ?><jdoc:include type="modules" name="referencer" style="none" /><?php endif; ?>	
		<jdoc:include type="modules" name="debug" style="none" />	

	[ends tags="body" /]  
</html>
