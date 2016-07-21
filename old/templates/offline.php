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
$this->language  = $docs->language;
$this->direction = $docs->direction;

// Getting params from template
$params = $apps->getTemplate(true)->params;
$sitename = $apps->get('sitename');

$twofactormethods = UsersHelper::getTwoFactorMethods();
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
[head]
	[meta charset="utf-8" /]
	[title]<?php echo $sitename.' - '.JText::_('JOFFLINE_MESSAGE'); ?>[/title]
	[meta name="viewport" content="width=device-width, initial-scale=1" /]
	[meta name="robots" content="noindex,nofollow" /]	
	[link rel="stylesheet" href="<?php echo $this->baseurl.'/templates/'.$this->template.'/assets/production/css/offline.min.css'; ?>" type="text/css" /]
	<?php if ($apps->get('debug_lang', '0') == '1' || $apps->get('debug', '0') == '1') : ?>
		[link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/cms/css/debug.css" type="text/css" /]
	<?php endif; ?>
	[link rel="shortcut icon" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.ico" type="image/vnd.microsoft.icon" /]
	[link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/mod_opensource/fontawesome/font-awesome.min.css" /]
	[link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/mod_opensource/bootstrap/bootstrap.min.css" /]
[/head]
[begins mdatatype="http://schema.org/WebPage" /]
<jdoc:include type="message" />
    [header class="well"]
        [begins tags="div" class="container" /]  
            [begins tags="div" class="rowr" /]  
                [begins tags="div" class="col-lg-12 text-center" /]  
					<?php if ($apps->get('offline_image') && file_exists($apps->get('offline_image'))) : ?>
							[img src="<?php echo $apps->get('offline_image'); ?>" alt="<?php echo htmlspecialchars($apps->get('sitename')); ?>" /]
					<?php endif; ?>
						[h1]<?php echo htmlspecialchars($apps->get('sitename')); ?>[/h1]
					<?php if ($apps->get('display_offline_message', 1) == 1 && str_replace(' ', '', $apps->get('offline_message')) != '') : ?>
						[p]<?php echo $apps->get('offline_message'); ?>[/p]
					<?php elseif ($apps->get('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != '') : ?>
						[p]<?php echo JText::_('JOFFLINE_MESSAGE'); ?>[/p]
					<?php endif; ?>	
                [ends tags="div" /]  
            [ends tags="div" /]  
        [ends tags="div" /]  
    [/header]
    [section]
        [begins tags="div" class="container" /]  
            [begins tags="div" class="row" /]  
                [begins tags="div" class="col-lg-12 text-center" /]  
                    [h2 itemprop="alternativeHealine">Sorry, Member team login only[/h1]
                    [hr /]
                    [begins tags="div" class="row text-center" /]  
						[begins tags='form' class='form-inline' id='form-login' more='action="<?php echo JRoute::_('index.php', true); ?>" method="post"' /]  
							[begins tags="div" class="form-group" /]  
								[begins tags='label' more='for="username"' /]<?php echo JText::_('JGLOBAL_USERNAME'); ?>[ends tags="label" /]
								[input name="username" id="username" type="text" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" /]
							[ends tags="div" /]  
							[begins tags="div" class="form-group" /] 
								[begins tags='label' more='for="passwd"' /]<?php echo JText::_('JGLOBAL_PASSWORD'); ?>[ends tags="label" /]
								[input type="password" name="password" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" id="passwd" /]
							[ends tags="div" /]  
							<?php if (count($twofactormethods) > 1) : ?>
								[begins tags="div" class="form-group" /] 
									[begins tags='label' more='for="secretkey"' /]<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>[ends tags="label" /]
									[input type="text" name="secretkey" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" id="secretkey" /]
								[ends tags="div" /]  
							<?php endif; ?>
							[input type="submit" name="Submit" class="btn btn-dark" value="<?php echo JText::_('JLOGIN'); ?>" /]
							[input type="hidden" name="option" value="com_users" /]
							[input type="hidden" name="task" value="user.login" /]
							[input type="hidden" name="return" value="<?php echo base64_encode(JUri::base()); ?>" /]
							<?php echo JHtml::_('form.token'); ?>
						[ends tags="form" /]
					[ends tags="div" /]  
                [ends tags="div" /]  
            [ends tags="div" /]  
        [ends tags="div" /]  
    [/section]
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
		[script src="<?php echo $this->baseurl; ?>/media/mod_opensource/jquery/jquery-1.x.min.js" /] 
		[script src="<?php echo $this->baseurl; ?>/media/mod_opensource/bootstrap/bootstrap.min.js" /] 
	[ends tags="body" /]  
</html>
