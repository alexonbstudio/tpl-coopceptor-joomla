<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

	<label><?php echo JText::_('COM_CONFIG_SEO_SETTINGS'); ?></label>
	<?php
	foreach ($this->form->getFieldset('seo') as $field):
	?>
		<div class="form-group">
			<div class="col-sm-2 control-label"><?php echo $field->label; ?></div>
			<div class="col-sm-offset-2 col-sm-10"><?php echo $field->input; ?></div>
		</div>
	<?php
	endforeach;
	?>

