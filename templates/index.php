<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor
 *
 * @copyright   Copyright (C) 2016 Alexon Balangue. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;
//Variables not really use actualy on tpl: if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);# Add this code For Joomla 3.3.4+
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
		JHtmlBootstrap::framework(false);
	break;
	case 'component':
		foreach ($this->_scripts as $script => $value){ 
			if (preg_match('/media\/jui/i', $script)){ unset($this->_scripts[$script]); } 
			if (preg_match('/media\/system/i', $script)){ unset($this->_scripts[$script]); } 
		}	
		JHtmlBootstrap::framework(false);/**Desactive Boostrap 2.3.2, because Joomla use default source code**/
	break;
	default:
		JHtmlBootstrap::framework(false);
	break;
endswitch;

// Detecting Active Variables
$option   = $apps->input->getCmd('option', '');
$view     = $apps->input->getCmd('view', '');
$layout   = $apps->input->getCmd('layout', '');
$task     = $apps->input->getCmd('task', '');
$itemid   = $apps->input->getCmd('Itemid', '');

if($task == "edit" || $layout == "form" ){ $fullWidth = 1; } else { $fullWidth = 0; }

# Adjusting content width
if ($this->countModules('sidebar-left') && $this->countModules('sidebar-right')){
	$boostrap2_sizes = "span6";
	$boostrap3_sizes = "col-xs-12 col-sm-6 col-md-6 col-lg-6";
	$amp_sizes = "";
	$foundation_sizes = "small-12 medium-6 large-6 columns";
	$metroui_sizes = "cell colspan6";
} elseif ($this->countModules('sidebar-left') && !$this->countModules('sidebar-right')){
	$boostrap2_sizes = "span9";
	$boostrap3_sizes = "col-xs-12 col-sm-9 col-md-9 col-lg-9";
	$amp_sizes = "";
	$foundation_sizes = "small-12 medium-9 large-9 columns";
	$metroui_sizes = "cell colspan9";
} elseif (!$this->countModules('sidebar-left') && $this->countModules('sidebar-right')){
	$boostrap2_sizes = "span9";
	$boostrap3_sizes = "col-xs-12 col-sm-9 col-md-9 col-lg-9";
	$amp_sizes = "";
	$foundation_sizes = "small-12 medium-9 large-9 columns";
	$metroui_sizes = "cell colspan9";
} else {
	$boostrap2_sizes = "span12";
	$boostrap3_sizes = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
	$amp_sizes = "";
	$foundation_sizes = "small-12 medium-expand large-expand columns";
	$metroui_sizes = "cell colspan12";
}
// Logo file or site title param

if ($this->params->get('logoFile')){ $logo = '[img src="'.JUri::root() . $this->params->get('logoFile').'" alt="'.$sitename.'" /]'; } else { $logo = $sitename; }

$Params_grpsJs = $this->params->get('groups-method');
$Params_grpsCSS = $this->params->get('groups-method');
if ($Params_grpsJs == 'production') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.min.css');
elseif ($Params_grpsJs == 'custom') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.min.css');
endif;

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'html'.DIRECTORY_SEPARATOR.'renderer'.DIRECTORY_SEPARATOR.'head.php';
require_once JPATH_SITE.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'mod_opensource'.DIRECTORY_SEPARATOR.'Mobile_Detect.php';
$detect = new Mobile_Detect;
$JMobileDetectHeader = $detect->isMobile() && $detect->isTablet() ? '<jdoc:include type="modules" name="banner-mheader" style="nones" />' : '<jdoc:include type="modules" name="banner-header" style="nones" />';
$JMobileDetectFooter = $detect->isMobile() && $detect->isTablet() ? '<jdoc:include type="modules" name="banner-mfooter" style="nones" />' : '<jdoc:include type="modules" name="banner-footer" style="nones" />';
/**
if need keeep for you
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">
**/
?>

[doctype html="html" /]
<html <?php echo $params->get('ampHTML'); ?> lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	[head]<jdoc:include type="head" />[/head]
	<?php switch($Grps_html): case 'boostrap2-home': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="bs2-home" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="span12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer] 
	<?php break; case 'boostrap2-component': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
			[section]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row-fluid" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap2_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags='div' class='<?php echo $boostrap2_sizes; ?>' /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="bs2-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap2_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="span12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer] 
	<?php break; case 'boostrap3-home': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="bs3-home" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'boostrap3-component': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
			[section]
				[begins tags="div" class="container" /]  
					[begins tags="div" class="row-fluid" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags='div' class='<?php echo $boostrap3_sizes; ?>' /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="bs3-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'boostrap4-home': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="bs4-home" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'boostrap4-component': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
			[section]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap4_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags='div' class='<?php echo $boostrap4_sizes; ?>' /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="bs4-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap4_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'amp-home': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="amp-home" />	
		[/section]
		[footer]  
			[begins tags="div" style="text-align: center" /]  
				&copy; <?php echo date('Y').' '.$sitename; ?> - 
				Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
			[ends tags="div" /]     
		[/footer]
	<?php break; case 'amp-component': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
			[section]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $amp_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags='div' class='<?php echo $amp_sizes; ?>' /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="amp-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $amp_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		[footer]  
			[begins tags="div" style="text-align: center" /]  
				&copy; <?php echo date('Y').' '.$sitename; ?> - 
				Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
			[ends tags="div" /]     
		[/footer]
	<?php break; case 'foundation-home': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="fi-home" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="small-12 medium-expand large-expand columns text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'foundation-component': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
			[section]
				[begins tags="div" class="container" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $foundation_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags='div' class='<?php echo $foundation_sizes; ?>' /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="fi-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $foundation_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="small-12 medium-expand large-expand columns text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'metroui-home': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			<jdoc:include type="message" />
			<jdoc:include type="mui-home" />	
		[/section]
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="cell colspan12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; case 'metroui-component': ?>
		[begins tags="body" mdatatype="http://schema.org/WebPage" /]
		[header]
			<?php echo $logo; ?>
		[/header]
			[section]
				[begins tags="div" class="container" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $metroui_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags='div' class='<?php echo $metroui_sizes; ?>' /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="mui-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $metroui_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		[footer]
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="cell colspan12 text-center" /]  
						&copy; <?php echo date('Y').' '.$sitename; ?> - 
						Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
		[/footer]
	<?php break; default: ?>
		[begins tags="body" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			No content here, please contact the webmaster.	
		[/section]
		[footer] 
			&copy; <?php echo date("Y").' '.$sitename; ?> - 
			Conceptor by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url]  
		[/footer]
	<?php break; endswitch; ?>
	
		<?php if ($this->countModules('referencer')) : ?><jdoc:include type="modules" name="referencer" style="none" /><?php endif; ?>	
		<?php if ($Params_grpsJs == 'production') : ?>
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/full.min.js'; ?>" /]			
		<?php elseif ($Params_grpsJs == 'custom') : ?>	
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/js/full.js'; ?>" /]					

		<?php endif; ?>	
	
	
		<?php if (!$params->get('ampHTML') == 'amp'): ?>[cookies legal="<?php echo JText::_('TPL_COOPCEPTOR_COOKIESEU_HOME'); ?>" botton="Ok" url="#" /]<?php else: echo ' '; endif; ?>
		
		<jdoc:include type="modules" name="debug" style="none" />	

	[ends tags="body" /]  
</html>
