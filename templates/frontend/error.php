<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
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
$Grps_html = $this->params->get('groups-html');
$sitename = $apps->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Logo file or site title param
if ($params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $params->get('logoFile') . '" alt="' . $sitename . '">';
}
elseif ($params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html <?php echo ($params->get('ampHTML') ? 'amp' : ''); ?> lang="en" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="ronots" content="noindex,nofollow">
	<?php switch($Grps_html): case 'boostrap2': ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/mod_opensource/media/jui/css/bootstrap.min.css" type="text/css">
	<?php break; case 'boostrap3': ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/mod_opensource/bootstrap/bootstrap.min.css" type="text/css">
	<?php break; case 'amp': ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl.'/templates/'.$this->template.'/assets/'.$this->params->get('groups-method').'/css/full.min.css'; ?>" type="text/css">
	<?php break; case 'foundation': ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/mod_opensource/foundation.zurb/foundation.min.css" type="text/css">
	<?php break; case 'metroui': ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/mod_opensource/metro-ui/metro.min.css" type="text/css">
	<?php break; endswitch; ?>	
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/mod_opensource/fontawesome/font-awesome.min.css" type="text/css">
	<?php if ($apps->get('debug_lang', '0') == '1' || $apps->get('debug', '0') == '1') : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/cms/css/debug.css" type="text/css">
	<?php endif; ?>
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
	<!--<if lt IE 9>
		<script src="<?php echo $this->baseurl; ?>/media/jui/js/html5.js"></script>
	<!<endif>-->
</head>

<body>
	<?php switch($Grps_html): case 'boostrap2': ?>
		<begins tags="body" itemscope itemtype="http://schema.org/WebPage">
		<?php /**********************************	header	*********************************************/ ?>
		<header>
		
		</header>
		<?php /**********************************	BODY	*********************************************/ ?>
		<section>				<div class="row-fluid">
				<div id="content" class="span12">
					<!-- Begin Content -->
					<h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
								<p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
								<ul>
									<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
								</ul>
							</div>
							<div class="span6">
								<?php if (JModuleHelper::getModule('search')) : ?>
									<p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
									<p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
									<?php echo $docs->getBuffer('module', 'search'); ?>
								<?php endif; ?>
								<p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
								<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home"></span> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
							</div>
						</div>
						<hr>
						<p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
						<blockquote>
							<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
						</blockquote>
						<?php if ($this->debug) : ?>
							<?php echo $this->renderBacktrace(); ?>
						<?php endif; ?>
					</div>
					<!-- End Content -->
				</div>
			</div>
		</section>
		<?php /**********************************	FOOTER	*********************************************/ ?>
		<footer>
		
		</footer>
		<script src="<?php echo $this->baseurl; ?>/media/jui/js/bootstrap.min.js"></script> 	
	<?php break; case 'boostrap3': ?>
		<begins tags="body" itemscope itemtype="http://schema.org/WebPage">
		<?php /**********************************	header	*********************************************/ ?>
		<header>
		
		</header>
		<?php /**********************************	BODY	*********************************************/ ?>
		<section>			<div class="row-fluid">
				<div id="content" class="span12">
					<!-- Begin Content -->
					<h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
								<p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
								<ul>
									<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
								</ul>
							</div>
							<div class="span6">
								<?php if (JModuleHelper::getModule('search')) : ?>
									<p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
									<p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
									<?php echo $docs->getBuffer('module', 'search'); ?>
								<?php endif; ?>
								<p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
								<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home"></span> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
							</div>
						</div>
						<hr>
						<p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
						<blockquote>
							<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
						</blockquote>
						<?php if ($this->debug) : ?>
							<?php echo $this->renderBacktrace(); ?>
						<?php endif; ?>
					</div>
					<!-- End Content -->
				</div>
			</div>
		</section>
		<?php /**********************************	FOOTER	*********************************************/ ?>
		<footer>
		
		</footer>
		<script src="<?php echo $this->baseurl; ?>/media/mod_opensource/bootstrap/bootstrap.min.js"></script>
	<?php break; case 'amp': ?>
		<begins tags="body" itemscope itemtype="http://schema.org/WebPage">
		<?php /**********************************	header	*********************************************/ ?>
		<header>
		
		</header>
		<?php /**********************************	BODY	*********************************************/ ?>
		<section>			<div class="row-fluid">
				<div id="content" class="span12">
					<!-- Begin Content -->
					<h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
								<p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
								<ul>
									<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
								</ul>
							</div>
							<div class="span6">
								<?php if (JModuleHelper::getModule('search')) : ?>
									<p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
									<p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
									<?php echo $docs->getBuffer('module', 'search'); ?>
								<?php endif; ?>
								<p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
								<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home"></span> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
							</div>
						</div>
						<hr>
						<p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
						<blockquote>
							<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
						</blockquote>
						<?php if ($this->debug) : ?>
							<?php echo $this->renderBacktrace(); ?>
						<?php endif; ?>
					</div>
					<!-- End Content -->
				</div>
			</div>
		</section>
		<?php /**********************************	FOOTER	*********************************************/ ?>
		<footer>
		
		</footer>
	<?php break; case 'foundation': ?>
		<begins tags="body" itemscope itemtype="http://schema.org/WebPage">
		<?php /**********************************	header	*********************************************/ ?>
		<header>
		
		</header>
		<?php /**********************************	BODY	*********************************************/ ?>
		<section>			<div class="row-fluid">
				<div id="content" class="span12">
					<!-- Begin Content -->
					<h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
								<p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
								<ul>
									<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
								</ul>
							</div>
							<div class="span6">
								<?php if (JModuleHelper::getModule('search')) : ?>
									<p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
									<p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
									<?php echo $docs->getBuffer('module', 'search'); ?>
								<?php endif; ?>
								<p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
								<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home"></span> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
							</div>
						</div>
						<hr>
						<p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
						<blockquote>
							<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
						</blockquote>
						<?php if ($this->debug) : ?>
							<?php echo $this->renderBacktrace(); ?>
						<?php endif; ?>
					</div>
					<!-- End Content -->
				</div>
			</div>
		</section>
		<?php /**********************************	FOOTER	*********************************************/ ?>
		<footer>
		
		</footer>
		<script src="<?php echo $this->baseurl; ?>/media/mod_opensource/foundation.zurb/foundation.min.js"></script> 
	<?php break; case 'metroui': ?>
		<begins tags="body" itemscope itemtype="http://schema.org/WebPage">
		<?php /**********************************	header	*********************************************/ ?>
		<header>
		
		</header>
		<?php /**********************************	BODY	*********************************************/ ?>
		<section>
			<div class="row-fluid">
				<div id="content" class="span12">
					<!-- Begin Content -->
					<h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
								<p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
								<ul>
									<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
								</ul>
							</div>
							<div class="span6">
								<?php if (JModuleHelper::getModule('search')) : ?>
									<p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
									<p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
									<?php echo $docs->getBuffer('module', 'search'); ?>
								<?php endif; ?>
								<p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
								<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home"></span> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
							</div>
						</div>
						<hr>
						<p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
						<blockquote>
							<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
						</blockquote>
						<?php if ($this->debug) : ?>
							<?php echo $this->renderBacktrace(); ?>
						<?php endif; ?>
					</div>
					<!-- End Content -->
				</div>
			</div>
		</section>
		<?php /**********************************	FOOTER	*********************************************/ ?>
		<footer>
		
		</footer>
		<script src="<?php echo $this->baseurl; ?>/media/mod_opensource/metro-ui/metro.min.js"></script>
	<?php break; endswitch; ?>
	<!-- Body -->
	<div class="body">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<!-- Header -->
			<header class="header" role="banner">
				<div class="header-inner clearfix">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
						<?php echo $logo; ?>
					</a>
					<div class="header-search pull-right">
						<?php // Display position-0 modules ?>
						<?php echo $docs->getBuffer('modules', 'position-0', array('style' => 'none')); ?>
					</div>
				</div>
			</header>
			<div class="navigation">
				<?php // Display position-1 modules ?>
				<?php echo $docs->getBuffer('modules', 'position-1', array('style' => 'none')); ?>
			</div>
			<!-- Banner -->
			<div class="banner">
				<?php echo $docs->getBuffer('modules', 'banner', array('style' => 'xhtml')); ?>
			</div>

		</div>
	</div>
	<div class="footer">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<hr>
			<?php echo $docs->getBuffer('modules', 'footer', array('style' => 'none')); ?>
			<p class="pull-right">
				<a href="#top" id="back-top">
					<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
				</a>
			</p>
			<p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			</p>
		</div>
	</div>
	<?php echo $docs->getBuffer('modules', 'debug', array('style' => 'none')); ?>
</body>
</html>
