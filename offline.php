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
$sitename = $apps->get('sitename');

$this->_script = $this->_scripts = array();	

unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/core.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/modal.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/caption.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);

require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';

$twofactormethods = UsersHelper::getTwoFactorMethods();
?>
<!DOCTYPE html>
<html lang="en">
[head]
	<jdoc:include type="head" />
	<link rel="stylesheet" href="<?php echo $this->baseurl.'/templates/'.$this->template.'/assets/production/css/offline.min.css'; ?>" type="text/css">
	<?php if ($apps->get('debug_lang', '0') == '1' || $apps->get('debug', '0') == '1') : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/cms/css/debug.css" type="text/css">
	<?php endif; ?>
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
[/head]
[begins tags="body" mdatatype="http://schema.org/WebPage" /]
<jdoc:include type="message" />
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
					<?php if ($apps->get('offline_image') && file_exists($apps->get('offline_image'))) : ?>
							<img src="<?php echo $apps->get('offline_image'); ?>" alt="<?php echo htmlspecialchars($apps->get('sitename')); ?>" />
					<?php endif; ?>
						<h1>
							<?php echo htmlspecialchars($apps->get('sitename')); ?>
						</h1>
					<?php if ($apps->get('display_offline_message', 1) == 1 && str_replace(' ', '', $apps->get('offline_message')) != '') : ?>
						<p>
							<?php echo $apps->get('offline_message'); ?>
						</p>
					<?php elseif ($apps->get('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != '') : ?>
						<p>
							<?php echo JText::_('JOFFLINE_MESSAGE'); ?>
						</p>
					<?php endif; ?>	
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 itemprop="alternativeHealine">Sorry, Member team login only</h2>
                    <hr>
                    <div class="row text-center">
						<form action="<?php echo JRoute::_('index.php', true); ?>" class="form-inline" method="post" id="form-login">

							<div class="form-group">
								<label for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
								<input name="username" id="username" type="text" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" />
							</div>
							<div class="form-group">
								<label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
								<input type="password" name="password" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" id="passwd" />
							</div>
							<?php if (count($twofactormethods) > 1) : ?>
								<div class="form-group">
									<label for="secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
									<input type="text" name="secretkey" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" id="secretkey" />
								</div>
							<?php endif; ?>
								<input type="submit" name="Submit" class="btn btn-dark" value="<?php echo JText::_('JLOGIN'); ?>" />
							<input type="hidden" name="option" value="com_users" />
							<input type="hidden" name="task" value="user.login" />
							<input type="hidden" name="return" value="<?php echo base64_encode(JUri::base()); ?>" />
							<?php echo JHtml::_('form.token'); ?>
						</form>
					</div>
                </div>
            </div>
        </div>
    </section>
    [footer]
		[begins tags="div" class="container" /]  
			[begins tags="div" class="row" /]  
				[begins tags="div" class="col-lg-12 text-center" /]  
					&copy; <?php echo date('Y').' '.$sitename; ?> - 
					Conception by [url href="www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] 
                [ends tags="div" /]  
            [ends tags="div" /]  
        [ends tags="div" /]  
    [/footer]
	[ends tags="body" /]  
</html>
