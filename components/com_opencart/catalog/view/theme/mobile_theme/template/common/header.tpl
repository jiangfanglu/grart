<?php $_REQUEST["tmpl"]="component";?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN"
"http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" xml:lang="<?php echo $lang; ?>">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/mobile_theme/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript">jQuery.noConflict();</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/external/jquery.cookie.js"></script>
<script type="text/javascript" src="catalog/view/javascript/m_common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>

<?php echo $google_analytics; ?>
</head>
<body>
<div id="container">
<div id="header">
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
  <div class="links">
  <a href="<?php echo $home; ?>"><?php echo $text_home; ?></a>
  <a href="<?php echo $account; ?>"><?php echo $text_account; ?></a>
  <?php if ($this->cart->countProducts() > 0 ) $count = " (<span id='m_basket_count'>".$this->cart->countProducts()."</span>)";
  else $count = "";?>
  <a id="m_basket" href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart.$count; ?></a>
  </div>
</div>
<div id="content_top"><?php echo $content_top;?></div>
<?php if ($categories && (isset($_REQUEST["route"]) && $_REQUEST["route"]=="common/home") || (isset($_REQUEST["_route_"]) && $_REQUEST["_route_"]=="home") || (!isset($_REQUEST["_route_"]) && !isset($_REQUEST["route"]))) { ?>
<div>
  <ul class="link_list">
    <?php foreach ($categories as $category) { ?>
	<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
      <?php if ($category['children'] ) { ?>
        <ul>
        <?php foreach ($category['children'] as $child) { ?>
          	<li><a href="<?php echo $child['href']; ?>"><?php echo "- ".$child['name']; ?></a></li>
        <?php } ?>
        </ul>
      <?php } ?>
    </li>
    <?php } ?>
  </ul>
</div>
<?php } ?>
<div id="notification"></div>
