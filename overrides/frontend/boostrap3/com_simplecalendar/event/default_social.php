<?php
/**
 *	com_simplecalendar - a simple calendar component for Joomla
 *  Copyright (C) 2008-2013 Fabrizio Albonico
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
?>

<?php 
$link = JRoute::_('index.php?view=event&catid='.$this->item->catslug.'&id='.$this->item->slug);
?>
<?php  if ( $this->params->get('show_twitter', '1') ): ?>
	<div style="float:left; margin-left:5px;">
	<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>
<?php endif; ?>

<?php if ( $this->params->get('show_gplus', '1') ): ?>
	<div style="float:left; margin-left:10px;">
	<div class="g-plusone" data-size="medium" data-href="' . $link . '"></div>
	<script type="text/javascript">
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
	</div>
<?php endif; ?>

<?php if ( $this->params->get('show_facebook', '1') ): ?>
	<div style="float:left; margin-left:10px;">
	<div id="fb-root" style="width:450px;"></div>
			<script>(function(d, s, id) {
		 	var js, fjs = d.getElementsByTagName(s)[0];
		 	if (d.getElementById(id)) return;
		 	js = d.createElement(s); js.id = id;
		 	js.src = "//connect.facebook.net/$langTag/all.js#xfbml=1";
		 	fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
	</div>
<?php endif; ?>