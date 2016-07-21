<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Twofactorauth.totp.tmpl
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="well">
	<?php echo JText::_('PLG_TWOFACTORAUTH_YUBIKEY_INTRO') ?>
</div>

<?php if ($new_totp): ?>

	<label>
		<?php echo JText::_('PLG_TWOFACTORAUTH_YUBIKEY_STEP1_HEAD') ?>
	</label>

	<p>
		<?php echo JText::_('PLG_TWOFACTORAUTH_YUBIKEY_STEP1_TEXT') ?>
	</p>

	<div class="form-group">
		<label class="col-sm-2 control-label" for="yubikeysecuritycode">
			<?php echo JText::_('PLG_TWOFACTORAUTH_YUBIKEY_SECURITYCODE') ?>
		</label>
		<div class="col-sm-offset-2 col-sm-10">
			<input type="text" class="input-lg" name="jform[twofactor][yubikey][securitycode]" id="yubikeysecuritycode" autocomplete="0">
		</div>
	</div>

<?php else: ?>

	<label>
		<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_RESET_HEAD') ?>
	</label>

	<p>
		<?php echo JText::_('PLG_TWOFACTORAUTH_TOTP_RESET_TEXT') ?>
	</p>

<?php endif; ?>
