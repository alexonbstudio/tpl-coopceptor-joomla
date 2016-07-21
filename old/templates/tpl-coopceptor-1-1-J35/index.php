<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor (stylish)
 *
 * @copyright   Copyright (C) 2016 Alexon Balangue. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;
#if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);# Add this code For Joomla 3.3.4+
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
$option   = $apps->input->getCmd('option', '');
$view     = $apps->input->getCmd('view', '');
$layout   = $apps->input->getCmd('layout', '');
$task     = $apps->input->getCmd('task', '');
$itemid   = $apps->input->getCmd('Itemid', '');

if($task == "edit" || $layout == "form" ){ $fullWidth = 1; } else { $fullWidth = 0; }
//Remove défault JS Joomla 3.3.6/+ on front end home pages or other component


		
switch($hide_joomla_default):
	case 'home':
		$this->_script = $this->_scripts = array();	
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/core.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/modal.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/caption.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
		JHtmlBootstrap::framework(false);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);
	break;
	case 'component':
		foreach ($this->_scripts as $script => $value){ if (preg_match('/media\/jui/i', $script)){ unset($this->_scripts[$script]); } }	
		JHtmlBootstrap::framework(false);
	break;
	default:
		$docs->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/assets/template.js');
		// Add Stylesheets
		$docs->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/assets/template.css');
		// Check for a custom CSS file
		$userCss = JPATH_SITE . '/templates/' . $this->template . '/assets/user.css';
		if (file_exists($userCss) && filesize($userCss) > 0)
		{
			$docs->addStyleSheetVersion('templates/' . $this->template . '/assets/user.css');
		}
			break;
endswitch;

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

// Logo file or site title param logoFile

if(!empty($this->params->get('logoFile'))):
	$mypersonal_photo = $this->baseurl.'/'.$this->params->get('logoFile');
else:
	$mypersonal_photo = $this->baseurl.'/templates/'.$this->template.'/assets/img/profile.png';
endif;

$Params_grpsJs = $this->params->get('groups-method');
$Params_grpsCSS = $this->params->get('groups-method');
if ($Params_grpsJs == 'production') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/production/'.$this->params->get('groups-script').'-full.min.css');
elseif ($Params_grpsJs == 'custom') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/custom/'.$this->params->get('groups-script').'-full.css');
endif;


//$docs->addStyleSheet('https://fonts.googleapis.com/css?family=Montserrat:400,700');
//$docs->addStyleSheet('//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');


require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'html'.DIRECTORY_SEPARATOR.'renderer'.DIRECTORY_SEPARATOR.'head.php';
require_once JPATH_SITE.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'mod_opensource'.DIRECTORY_SEPARATOR.'Mobile_Detect.php';
$detect = new Mobile_Detect;
$JMobileDetectHeader = $detect->isMobile() && $detect->isTablet() ? '<jdoc:include type="modules" name="banner-mheader" style="nones" />' : '<jdoc:include type="modules" name="banner-header" style="nones" />';
$JMobileDetectFooter = $detect->isMobile() && $detect->isTablet() ? '<jdoc:include type="modules" name="banner-mfooter" style="nones" />' : '<jdoc:include type="modules" name="banner-footer" style="nones" />';
?>

[doctype html="html" /]
<html <?php echo $params->get('ampHTML'); ?> lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	[head]
	<jdoc:include type="head" />
	[/head]
	<?php switch($Grps_html): case 'boostrap2-home': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#recherche" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]
		<?php if ($this->countModules('bs2-search')): ?>
			[section id="recherche"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_SEARCH_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs2-search" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
		<?php if ($this->countModules('bs2-information')): ?>
			[section id="information"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_INFORMATION_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs2-information" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs2-services')): ?>
			[section id="services"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_SERVICES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs2-services" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
		<?php if ($this->countModules('bs2-consumer')): ?>
			[section id="consumer"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONSUMER_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs2-consumer" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs2-contribute')): ?>
			[section id="contribute"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONTRIBUTE_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs2-contribute" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
		<?php if ($this->countModules('bs2-confiances')): ?>
			[section id="confiances"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONFIANCES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs2-confiances" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs2-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs2-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						<?php if ($this->countModules('bs2-footer1')) : ?>
							[begins tags='div' class='span3' /]<jdoc:include type="modules" name="bs2-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer2')) : ?>
							[begins tags='div' class='span3' /]<jdoc:include type="modules" name="bs2-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer3')) : ?>
							[begins tags='div' class='span3' /]<jdoc:include type="modules" name="bs2-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer4')) : ?>
							[begins tags='div' class='span3' /]<jdoc:include type="modules" name="bs2-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row-fluid"' /]
						[begins tags='div' class='span12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; case 'boostrap2-component': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#recherche" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]
		<?php if ($this->countModules('bs2-information')): ?>
			[section id="information"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]
							[begins tags="div" class="row" /] 
								<?php echo $JMobileDetectHeader; ?>
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		<?php if ($this->countModules('bs2-search')): ?>
			[section id="recherche"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_SEARCH_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs2-search" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
			[article id="components"]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap2_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $boostrap2_sizes; ?>" /]
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
			[/article]   
		<?php if ($this->countModules('bs2-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs2-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
                <?php echo $JMobileDetectFooter; ?>
				  [hr class="clearfix" /]
						<?php if ($this->countModules('bs2-footer1')) : ?>
							[begins tags='div' class='span3' /]<jdoc:include type="modules" name="bs2-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer2')) : ?>
							[begins tags='div' class='span3' /]<jdoc:include type="modules" name="bs2-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer3')) : ?>
							[begins tags='div' class='span3' /]<jdoc:include type="modules" name="bs2-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer4')) : ?>
							[begins tags='div' class='span3' /]<jdoc:include type="modules" name="bs2-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row-fluid"' /]
						[begins tags='div' class='span12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; case 'boostrap3-home': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#services" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#services" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]
		<?php if ($this->countModules('bs3-services')): ?>
			[section id="services"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_SERVICES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-services" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		<?php if ($this->countModules('bs3-information')): ?>
			[section id="information"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_INFORMATION_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-information" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-choose-us')): ?>
			[section id="choose-us"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CHOOSE_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-choose-us" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
			[section id="membres"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Membres[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-left" style="none" />
								[ends tags="div" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-right" style="none" />
								[ends tags="div" /] 
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php if ($this->countModules('bs3-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 	  
		<?php if ($this->countModules('bs3-payments')): ?>
			[section id="payments"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONFIANCES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-payments" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-contact')): ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Contacter l'équipe[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-contact" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 		     
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						
						
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; case 'boostrap3-component': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#components" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#components" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]   
			[article id="components"]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="amp-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/article]	       
			[section id="membres"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Membres[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-left" style="none" />
								[ends tags="div" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-right" style="none" />
								[ends tags="div" /] 
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php if ($this->countModules('bs3-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 	  
		<?php if ($this->countModules('bs3-payments')): ?>
			[section id="payments"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONFIANCES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-payments" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-contact')): ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Contacter l'équipe[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-contact" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
                <?php echo $JMobileDetectFooter; ?>
				  [hr class="clearfix visible-xs-block visible-sm-block visible-md-block visible-lg-block" /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						
						
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; case 'amp-home': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#services" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#services" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]
		<?php if ($this->countModules('bs3-services')): ?>
			[section id="services"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_SERVICES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-services" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		<?php if ($this->countModules('bs3-information')): ?>
			[section id="information"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_INFORMATION_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-information" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-choose-us')): ?>
			[section id="choose-us"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CHOOSE_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-choose-us" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
			[section id="membres"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Membres[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-left" style="none" />
								[ends tags="div" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-right" style="none" />
								[ends tags="div" /] 
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php if ($this->countModules('bs3-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 	  
		<?php if ($this->countModules('bs3-payments')): ?>
			[section id="payments"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONFIANCES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-payments" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-contact')): ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Contacter l'équipe[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-contact" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 		     
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						
						
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; case 'amp-component': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#components" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#components" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]   
			[article id="components"]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="amp-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/article]	       
			[section id="membres"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Membres[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-left" style="none" />
								[ends tags="div" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-right" style="none" />
								[ends tags="div" /] 
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php if ($this->countModules('bs3-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 	  
		<?php if ($this->countModules('bs3-payments')): ?>
			[section id="payments"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONFIANCES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-payments" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-contact')): ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Contacter l'équipe[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-contact" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
                <?php echo $JMobileDetectFooter; ?>
				  [hr class="clearfix visible-xs-block visible-sm-block visible-md-block visible-lg-block" /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						
						
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; case 'foundation-home': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#services" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#services" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]
		<?php if ($this->countModules('bs3-services')): ?>
			[section id="services"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_SERVICES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-services" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		<?php if ($this->countModules('bs3-information')): ?>
			[section id="information"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_INFORMATION_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-information" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-choose-us')): ?>
			[section id="choose-us"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CHOOSE_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-choose-us" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
			[section id="membres"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Membres[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-left" style="none" />
								[ends tags="div" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-right" style="none" />
								[ends tags="div" /] 
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php if ($this->countModules('bs3-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 	  
		<?php if ($this->countModules('bs3-payments')): ?>
			[section id="payments"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONFIANCES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-payments" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-contact')): ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Contacter l'équipe[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-contact" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 		     
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						
						
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; case 'foundation-component': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#components" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#components" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]   
			[article id="components"]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="amp-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/article]	       
			[section id="membres"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Membres[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-left" style="none" />
								[ends tags="div" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-right" style="none" />
								[ends tags="div" /] 
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php if ($this->countModules('bs3-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 	  
		<?php if ($this->countModules('bs3-payments')): ?>
			[section id="payments"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONFIANCES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-payments" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-contact')): ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Contacter l'équipe[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-contact" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
                <?php echo $JMobileDetectFooter; ?>
				  [hr class="clearfix visible-xs-block visible-sm-block visible-md-block visible-lg-block" /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						
						
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; case 'metroui-home': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#services" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#services" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]
		<?php if ($this->countModules('bs3-services')): ?>
			[section id="services"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_SERVICES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-services" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		<?php if ($this->countModules('bs3-information')): ?>
			[section id="information"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_INFORMATION_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-information" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-choose-us')): ?>
			[section id="choose-us"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CHOOSE_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-choose-us" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
			[section id="membres"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Membres[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-left" style="none" />
								[ends tags="div" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-right" style="none" />
								[ends tags="div" /] 
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php if ($this->countModules('bs3-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 	  
		<?php if ($this->countModules('bs3-payments')): ?>
			[section id="payments"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONFIANCES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-payments" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-contact')): ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Contacter l'équipe[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-contact" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 		     
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						
						
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; case 'metroui-component': ?>
		[begins tags='body' mdatatype='http://schema.org/WebPage' /]	
		[a href="#components" id="menu-toggle" class="btn btn-dark btn-lg toggle"][fa name="bars" /][/a]
		[nav id="navbar navbar-inverse navbar-fixed-top"]
			<jdoc:include type="modules" name="coopceptor_menu" style="nones" />
		[/nav]
		[header]
			[begins tags="div" /]
			<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
            [h1 mdataprop="name"]<?php echo $sitename; ?>[/h1]
			<meta itemprop="name" content="<?php echo $sitename; ?>">
            [h4 mdataprop="description"]<?php echo $desc_site; ?>[/h4]
			<meta itemprop="description" content="<?php echo $desc_site; ?>">
            [br /]
            [a href="#components" class="btn btn-dark btn-lg"][fa name="angle-double-down" zoom="5x" /][/a]
			[ends tags="div" /]
		[/header]   
			[article id="components"]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="amp-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/article]	       
			[section id="membres"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Membres[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-left" style="none" />
								[ends tags="div" /] 
								[begins tags="div" class="col-xs-12 col-sm-6 col-md-6 col-lg-6" /]
								<jdoc:include type="modules" name="bs3-membres-right" style="none" />
								[ends tags="div" /] 
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php if ($this->countModules('bs3-translator')): ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_TRANSLATOR_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-translator" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 	  
		<?php if ($this->countModules('bs3-payments')): ?>
			[section id="payments"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]<?php echo JText::_('TPL_COOPCETOR_CONFIANCES_HOME'); ?>[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-payments" style="none" />
							[ends tags="div" /] 
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-contact')): ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12' /]

							[h2 class="text-center" mdataprop="alternativeHealine"]Contacter l'équipe[/h2]
							[hr /]
							[begins tags="div" class="row" /] 
								<jdoc:include type="modules" name="bs3-contact" style="none" />
							[ends tags="div" /]
						[ends tags="div" /]
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
			[section id="copyright"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
                <?php echo $JMobileDetectFooter; ?>
				  [hr class="clearfix visible-xs-block visible-sm-block visible-md-block visible-lg-block" /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-4 col-md-3 col-lg-3' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		[footer]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						
						
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
		[/footer]
	<?php break; default: ?>
		[begins tags="body" /]
		[header]
			<?php echo $mypersonal_photo; ?>
		[/header]
		[section]
			No content here, please contact the webmaster.	
		[/section]
		[footer] 
			&copy; <?php echo date("Y").' '.$sitename; ?> - 
			Conception by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url]  
		[/footer]
	<?php break; endswitch; ?>	
		<?php if ($this->countModules('referencer')) : ?><jdoc:include type="modules" name="referencer" style="none" /><?php endif; ?>	
		<?php if ($Params_grpsJs == 'production') : ?>
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/production/'.$this->params->get('groups-script').'-full.min.js'; ?>" /] 
			
		<?php elseif ($Params_grpsJs == 'custom') : ?>	
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/custom/'.$this->params->get('groups-script').'-full.js'; ?>" /]				
		<?php endif; ?>	
	

<?php /********[ LAWS EUROPEAN - obligation show cookie legal ]*******/ ?>
		[cookies legal="<?php echo JText::_('TPL_COOPCETOR_COOKIESEU_HOME'); ?>" botton="Ok" url="//www.livingxworld.com/info/mention-legale" /] 	
		<jdoc:include type="modules" name="debug" style="none" />	

	[ends tags="body" /]  
</html>
