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
// Output as HTML5
$docs->setHtml5(true);
//Remove défault JS Joomla 3.3.6/+ on front end home pages only
$this->_script = $this->_scripts = array();	
/* OR THIS
foreach ($this->_scripts as $script => $value)
{
    if (preg_match('/media\/jui/i', $script))
	{
      unset($this->_scripts[$script]);
	}
}	
*/
//JHtml::_('bootstrap.framework');
//JHtml::_('jquery.framework');
unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/core.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/modal.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/caption.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);
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
	$docs->addStyleSheetVersion('templates/' . $this->template . '/css/user.css');
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

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
*/
//JText::_('TPL_COOPCEPTOR_');
$docs->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.css');
$docs->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/template.css');
?>
[doctype html="html" /]
<html <?php echo ($params->get('ampHTML') ? 'amp' : ''); ?> lang="en" dir="<?php echo $this->direction; ?>">
	[head]<jdoc:include type="head" />[/head]
	<?php switch($Grps_html): case 'boostrap2': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		<?php /**********************************	header	*********************************************/ ?>
		[header]
		
		[/header]
		<?php /**********************************	BODY	*********************************************/ ?>
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />		
		[/section]
		<?php /**********************************	FOOTER	*********************************************/ ?>
		[footer]
		
		[/footer]
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/application.js" /]
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/template.js" /]  
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/full.js" /]  	
	<?php break; case 'boostrap3': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		<?php /**********************************	header	*********************************************/ ?>
		[header]
		
		[/header]
		<?php /**********************************	BODY	*********************************************/ ?>
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		<?php /**********************************	FOOTER	*********************************************/ ?>
		[footer]
		
		[/footer]
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/application.js" /]
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/template.js" /]  
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/full.js" /]  
	<?php break; case 'amp': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		<?php /**********************************	header	*********************************************/ ?>
		[header]
		
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
		
		[/header]
		<?php /**********************************	BODY	*********************************************/ ?>
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		<?php /**********************************	FOOTER	*********************************************/ ?>
		[footer]
		
		[/footer]
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/application.js" /]
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/template.js" /]  
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/full.js" /]  
	<?php break; case 'metroui': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		<?php /**********************************	header	*********************************************/ ?>
		[header]
		
		[/header]
		<?php /**********************************	BODY	*********************************************/ ?>
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="component" />	
		[/section]
		<?php /**********************************	FOOTER	*********************************************/ ?>
		[footer]
		
		[/footer]
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/application.js" /]
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/template.js" /]  
		[script src="<?php echo $this->baseurl.'/templates/'.$this->template; ?>/assets/<?php echo $this->params->get('groups-method'); ?>/js/full.js" /]  
	<?php break; endswitch; ?>
		<?php /**********************************	OTHERS	*********************************************/ ?>
		<?php if ($params->get('ampHTML') == '1'): ?>[cookies legal="<?php echo JText::_('TPL_COOPCEPTOR_COOKIESEU_HOME'); ?>" botton="Ok" url="#" /]<?php endif; ?>
		<?php if ($this->countModules('referencer')) : ?><jdoc:include type="modules" name="referencer" style="none" /><?php endif; ?>	
		<jdoc:include type="modules" name="debug" style="none" />	

	[ends tags="body" /]  
</html>
