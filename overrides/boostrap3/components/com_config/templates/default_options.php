<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Load chosen.css
JHtml::_('formbehavior.chosen', 'select');

?>
<?php

$fieldSets = $this->form->getFieldsets('params');
echo '<label>'.JText::_('COM_CONFIG_TEMPLATE_SETTINGS').'</label>'; 

if (!empty($fieldSets['com_config'])):
		echo $this->form->renderFieldset('com_config');
else:
	// Fall-back to display all in params
	foreach ($fieldSets as $name => $fieldSet) :
		$label = !empty($fieldSet->label) ? $fieldSet->label : 'COM_CONFIG_' . $name . '_FIELDSET_LABEL';

		if (isset($fieldSet->description) && trim($fieldSet->description)) :
			echo '<p>' . $this->escape(JText::_($fieldSet->description)) . '</p>';
		endif;
		echo $this->form->renderFieldset($name); 
	endforeach;
endif;
