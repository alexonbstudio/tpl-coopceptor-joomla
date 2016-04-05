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
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
[head]<jdoc:include type="head" />[/head]
[begins tags="body" mdatatype="http://schema.org/WebPage" /]
<jdoc:include type="message" />



		<jdoc:include type="modules" name="referencer" style="none" />
		<jdoc:include type="modules" name="debug" style="none" />	

	[ends tags="body" /]  
</html>
