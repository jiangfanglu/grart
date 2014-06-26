<?php
/**
* asfaleiafacebooklikebox Joomla! 3 Native Component
* @version 1.0
* @author Joshua Gies
* @link http://wwww.asfaleiaautokinitou.com
* @license GNU/GPL */

defined('_JEXEC') or die('Restricted access');
	$href=$params->get( 'href' );
	$width=$params->get( 'width' );
	$height=$params->get( 'height' );
	$border_color=$params->get( 'border_color' );
	$displaylanguage=$params->get( 'displaylanguage' );
	$colorscheme=$params->get( 'colorscheme' );
	$show_faces=$params->get( 'show_faces' );
	$stream=(int)$params->get( 'stream' );
	$header=(int)$params->get( 'header' );
  
	?>
	
	<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/<?php echo $displaylanguage ?>/all.js#xfbml=1";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	
	<?php
	echo '<fb:like-box '
	.'href="'.$href.'" '
	.'width="'.$width.'" '
	.'height="'.$height.'" '
	.'border_color="'.$border_color.'" '
	.'show_faces="'.($show_faces ? 'true' : 'false').'" '
	.'stream="'.($stream ? 'true' : 'false').'" '
	.'header="'.($header ? 'true' : 'false').'"'
	.($colorscheme=='dark' ? 'colorscheme="dark"' : '')
	.'></fb:like-box>';
		
	 echo 'by <a href="http://asfaleiesautokinitou.com/" title="asfaleies autokinitou">asfaleies autokiniton</a>';
?>