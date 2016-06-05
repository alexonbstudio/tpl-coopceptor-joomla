# tpl-coopceptor-joomla

[![Join the chat at https://gitter.im/alexonbalangue/tpl-coopceptor-joomla](https://badges.gitter.im/alexonbalangue/tpl-coopceptor-joomla.svg)](https://gitter.im/alexonbalangue/tpl-coopceptor-joomla?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
Template created from by http://www.alexonbalangue.me (here only developpment mode) on J3.5/+


Autorisate and maintener this template the author by Alexon Balangue:
-You can custom it's togethere sinces github only
-Not take or host and share on you website (if template custom autorisate saller)
-You're not autorisate to sales order that template
-totaly free





Frontend - Default:
-modules.php
-pagination.php
-layouts
-renderer


IF problem:

#JQuery default use on joomla shur to disable it (or maybe 3part component use this):=
JHtml::_('jquery.framework');
#ON: overrides/Framework-HTML5/layouts/joomla/html/formbehavior/chosen.php:=
JHtml::_('script', 'jui/chosen.jquery.min.js', false, true, false, false, $debug);
JHtml::_('stylesheet', 'jui/chosen.css', false, true);
#ON: overrides/Framework-HTML5/layouts/joomla/html/formbehavior/ajaxchosen.php:=
JHtml::_('script', 'jui/ajax-chosen.min.js', false, true, false, false, $debug);
#ON: overrides/Framework-HTML5/layouts/joomla/form/field/checkboxes.php & radio.php:=
JHtml::_('script', 'system/html5fallback.js', false, true);
#ON: overrides/Framework-HTML5/layouts/joomla/form/field/user.php:=
JHtml::script('jui/fielduser.min.js', false, true, false, false, true);
#ON: overrides/Framework-HTML5/layouts/joomla/form/field/media.php:=
JHtml::_('script', 'media/mediafield-mootools.min.js', true, true, false, false, true);
#ON: overrides/Framework-HTML5/layouts/joomla/form/renderfield.php:=
JHtml::_('script', 'jui/cms.js', false, true);



Why?
Some people not likes Boostrap prefere, what he want to choose favorite framework HTML, so that create a one-off complet template and renovate use on Joomla.

Then not totaly dependance default template by the CMS!!!(SHORTCODES)


The stable version available only on http://www.alexonbalangue.me/project/coopceptor.html


Thnx to collaborate and take moment to your contribution

Regards

