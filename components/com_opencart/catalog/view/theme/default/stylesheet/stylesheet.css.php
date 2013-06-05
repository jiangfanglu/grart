<?php
/**
 * @package		jCart
 * @copyright	Copyright (C) 2009 - 2012 softPHP,http://www.soft-php.com
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<style type="text/css">
<!--
html {
	margin: 0;
	padding: 0;	
}
body {
	background-color: #ffffff;
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	margin: 0px;
	padding: 0px;
	
}
body, td, th, input, textarea, select, a {
	font-size: 12px;
}

h1, .welcome {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	font: Verdana;
	margin-top: 0px;
	margin-bottom: 20px;
	font-size: 24px;
	font-weight: normal;
	text-shadow: 0 0 1px rgba(0, 0, 0, .01);
}
h2 {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	font-size: 16px;
	margin-top: 0px;
	margin-bottom: 5px;
}
p {
	margin-top: 0px;
	margin-bottom: 20px;
}
a, a:visited, a b {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	text-decoration: underline;
	cursor: pointer;
}
a:hover {
	text-decoration: none;
}
a img {
	border: none;
}
form {
	padding: 0;
	margin: 0;
	display: inline;
}
input[type='text'], input[type='password'], textarea {
	background: #F8F8F8;
	border: 1px solid #CCCCCC;
	padding: 3px;
	margin-left: 0px;
	margin-right: 0px;
}
select {
	background: #F8F8F8;
	border: 1px solid #CCCCCC;
	padding: 2px;
}
label {
	cursor: pointer;
}
/* layout */
#container_ext {
	width: 97%;
	margin-left: auto;
	margin-right: auto;
	text-align: left;
	overflow:hidden;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
}
#column-left {
	float: left;
	width: 180px;
}
#column-right {
	float: right;
	width: 180px;
}
#content_ext {
	min-height: 400px;
	margin-bottom: 25px;
}
#column-left + #column-right + #content_ext, #column-left + #content_ext {
	margin-left: 195px;
}
#column-right + #content_ext {
	margin-right: 195px;
}
/* header */
#header_ext {
	height: 170px;
	margin-bottom: 7px;
	padding-bottom: 4px;
	position: relative;
	z-index: 99;
}
#header_ext #logo_ext {
	position: absolute;
	top: 0px;
	left: 0px;
}
#language {
	position: absolute;
	top: 50px;
	right: 150px;
	width: 75px;
	/* color: #999; */
	line-height: 17px;
}
#language img {
	cursor: pointer;
}
#currency {
	width: 75px;
	position: absolute;
	top: 60px;
	left: 5px;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	line-height: 17px;
}
#currency a {
	display: inline-block;
	padding: 2px 4px;
	border: 1px solid <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	/* color: #999; */
	text-decoration: none;
	margin-right: 2px;
	margin-bottom: 2px;
}
#currency a b {
	/* color: #000; */
	text-decoration: none;
}
#header_ext #cart {
	position: absolute;
	top: 47px;
	left: 78px;
	z-index: 9;
	
}
#header_ext #cart .heading {
	float: right;
	margin-right: 172px;
	margin-top: 15px;
	padding-left: 14px;
	padding-right: 14px;
        /*
	border-top: 1px solid #FFFFFF;
	border-left: 1px solid #FFFFFF;
	border-right: 1px solid #EEEEEE;
        */
	position: relative;
	z-index: 1;
}
#header_ext #cart .heading h4 {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	font-size: 15px;
	font-weight: bold;
	margin-top: 0px;
	margin-bottom: 3px;
}
#header_ext #cart .heading a {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>; 
	text-decoration: none;
	margin:0px;
}
#header_ext #cart .heading a span {
	background: url('catalog/view/theme/facebook/image/arrow-down.png') 100% 50% no-repeat;
	padding-right: 15px;
}
#header_ext #cart .content_ext {
	clear: both;
	display: none;
	position: relative;
	top: -1px;
	padding: 8px;
	min-height: 150px;
	border-top: 1px solid #EEEEEE;
	border-left: 1px solid #EEEEEE;
	border-right: 1px solid #EEEEEE;
	border-bottom: 1px solid #EEEEEE;
	-webkit-border-radius: 0px 7px 7px 7px;
	-moz-border-radius: 0px 7px 7px 7px;
	-khtml-border-radius: 0px 7px 7px 7px;
	border-radius: 0px 7px 7px 7px;
	-webkit-box-shadow: 0px 2px 2px #DDDDDD;
	-moz-box-shadow: 0px 2px 2px #DDDDDD;
	box-shadow: 0px 2px 2px #DDDDDD;
	background: #FFF;
	
}

#header_ext #cart.active .heading {
	margin-top: 5px;
	padding-top: 10px;
	padding-bottom: 6px;
	border-top: 1px solid #EEEEEE;
	border-left: 1px solid #EEEEEE;
	border-right: 1px solid #EEEEEE;
	-webkit-border-radius: 7px 7px 0px 0px;
	-moz-border-radius: 7px 7px 0px 0px;
	-khtml-border-radius: 7px 7px 0px 0px;
	border-radius: 7px 7px 0px 0px;
}
#header_ext #cart.active .content_ext {
	display: block;
}
.mini-cart-info table {
	border-collapse: collapse;
	width: 100%;
	margin-bottom: 5px;
}
.mini-cart-info td {
	color: #000;
	vertical-align: top;
	padding: 10px 5px;
	border-bottom: 1px solid #EEEEEE;
}
.mini-cart-info .image {
	width: 1px;
}
.mini-cart-info .image img {
	border: 1px solid #EEEEEE;
	text-align: left;
}
.mini-cart-info .name small {
	color: #666;
}
.mini-cart-info .quantity {
	text-align: right;
}
.mini-cart-info td.total {
	text-align: right;
}
.mini-cart-info .remove {
	text-align: right;
}
#header_ext #cart .cart .remove img {
	cursor: pointer;
}
#cart_module .cart {
	width:100%;	
}
#cart_module .cart .remove img {
	cursor: pointer;
}
.mini-cart-info .remove img {
	cursor: pointer;
}
.mini-cart-total {
	text-align: right;
}
.mini-cart-total table {
	border-collapse: collapse;
	display: inline-block;
	margin-bottom: 5px;
}
.mini-cart-total td {
	color: #000;
	padding: 4px;
}
#header_ext #cart .checkout {
	text-align: right;
	clear: both;
}
#cart_module .content_ext .checkout {
	text-align: right;
	clear: both;
}
#header_ext #cart .empty {
	padding-top: 50px;
	text-align: center;
}
#header_ext #search_ext {
	position: absolute;
	top: 60px;
	right: 0px;
	width: 150px;
	z-index: 15;
}
#header_ext .button-search {
	position: absolute;
	left: 0px;
	background: url('catalog/view/theme/facebook/image/button-search.png') center center no-repeat;
	width: 28px;
	height: 24px;
	border-right: 1px solid #CCCCCC;
	cursor: pointer;
}
#header_ext #search_ext input {
	background: #FFF;
	padding: 1px 1px 1px 33px;
	width: 110px;
	height: 21px;
	border: 1px solid #CCCCCC;
	-webkit-border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px 3px 3px 3px;
	-khtml-border-radius: 3px 3px 3px 3px;
	border-radius: 3px 3px 3px 3px;
	-webkit-box-shadow: 0px 2px 0px #F0F0F0;
	-moz-box-shadow: 0px 2px 0px #F0F0F0;
	box-shadow: 0px 2px 0px #F0F0F0;	
}
#header_ext #welcome {
	position: absolute;
	top: 101px;
	right: 0px;
	z-index: 5;
	/* width: 298px; */
	text-align: right;
	color: #999999;
	display:block;
}
#header_ext .links {
	position: absolute;
	right: 0px;
	top: 145px;
	font-size: 10px;
	padding-right: 4px;
}
#header_ext .links a {
	float: left;
	display: block;
	padding: 0px 0px 0px 4px;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	text-decoration: none;
	font-size: 12px;
	font-weight:bold;
}
#header_ext .links a + a {
	margin-left: 4px;
	border-left: 2px solid <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
}
/* menu */
#menu_ext {
	background: <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-bottom: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	height: 37px;
	margin-bottom: 15px;
	-webkit-border-radius: 5px 5px 5px 5px;
	-moz-border-radius: 5px 5px 5px 5px;
	-khtml-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
	-webkit-box-shadow: 0px 2px 2px #DDDDDD;
	-moz-box-shadow: 0px 2px 2px #DDDDDD;
	box-shadow: 0px 2px 2px #DDDDDD;
	padding: 0px 5px;
}
#menu_ext ul {
	list-style: none;
	margin: 0;
	padding: 0;
}
#menu_ext > ul > li {
	position: relative;
	float: left;
		
}
#menu_ext > ul > li:hover {
	background: <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;
}
#menu_ext > ul > li > a {
	font-size: 13px;
	color: #FFF;
	line-height: 14px;
	text-decoration: none;
	display: block;
	padding: 6px 10px 6px 10px;
	margin-bottom: 5px;
	z-index: 6;
	position: relative;
}
#menu_ext > ul > li:hover > a {
	background: <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
	border-radius: 5px;
}
#menu_ext > ul > li > div {
	display: none;
	background: #FFFFFF;
	position: absolute;
	z-index: 5;
	padding: 5px;
	border: 1px solid <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;
	-webkit-border-radius: 0px 0px 5px 5px;
	-moz-border-radius: 0px 0px 5px 5px;
	-khtml-border-radius: 0px 0px 5px 5px;
	border-radius: 0px 0px 5px 5px;
	background-color:<?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;
}
#menu_ext > ul > li:hover > div {
	display: table;
}
#menu_ext > ul > li > div > ul {
	display: table-cell;
}
#menu_ext > ul > li ul + ul {
	padding-left: 20px;
}
#menu_ext > ul > li ul > li > a {
	text-decoration: none;
	padding: 4px;
	color: #FFFFFF;
	display: block;
	white-space: nowrap;
	min-width: 120px;
}
#menu_ext > ul > li ul > li > a:hover {
	background: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
}
#menu_ext > ul > li > div > ul > li > a {
	color: #FFFFFF;
}
.breadcrumb_ext {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	margin-bottom: 10px;
}

.breadcrumb_ext a {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	font-weight:bold;
}
.success, .warning, .attention, .information {
	padding: 10px 10px 10px 33px;
	margin-bottom: 15px;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	font-weight:bold;
	-webkit-border-radius: 5px 5px 5px 5px;
	-moz-border-radius: 5px 5px 5px 5px;
	-khtml-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
}
.success {
	background: #EBEBFC url('catalog/view/theme/facebook/image/success.png') 10px center no-repeat;
	border: 1px solid #EBEBFC;
	-webkit-border-radius: 5px 5px 5px 5px;
	-moz-border-radius: 5px 5px 5px 5px;
	-khtml-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
}
.warning {
	background: #FFD1D1 url('catalog/view/theme/facebook/image/warning.png') 10px center no-repeat;
	border: 1px solid #F8ACAC;
	-webkit-border-radius: 5px 5px 5px 5px;
	-moz-border-radius: 5px 5px 5px 5px;
	-khtml-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
}
.attention {
	background: #FFF5CC url('catalog/view/theme/facebook/image/attention.png') 10px center no-repeat;
	border: 1px solid #F2DD8C;
	-webkit-border-radius: 5px 5px 5px 5px;
	-moz-border-radius: 5px 5px 5px 5px;
	-khtml-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
}
.success .close, .warning .close, .attention .close, .information .close {
	float: right;
	padding-top: 4px;
	padding-right: 4px;
	cursor: pointer;
}
.required {
	color: #FF0000;
	font-weight: bold;
}
.error {
	display: block;
	color: #FF0000;
}
.help {
	color: #999;
	font-size: 10px;
	font-weight: normal;
	font-family: Verdana, Geneva, sans-serif;
	display: block;
}
table.form {
	width: 100%;
	border-collapse: collapse;
	margin-bottom: 20px;
}
table.form tr td:first-child {
	width: 150px;
}
table.form > * > * > td {
	color: #000000;
}
table.form td {
	padding: 4px;
}
input.large-field, select.large-field {
	width: 95%;
}
table.list {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-bottom: 20px;
}
table.list td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
table.list thead td {
	background-color: #EFEFEF;
	padding: 0px 5px;
}
table.list thead td a, .list thead td {
	text-decoration: none;
	color: #222222;
	font-weight: bold;
}
table.list tbody td {
	vertical-align: top;
	padding: 0px 5px;
}
table.list .left_ext {
	text-align: left;
	padding: 7px;
}
table.list .right_ext {
	text-align: right;
	padding: 7px;
}
table.list .center {
	text-align: center;
	padding: 7px;
}
table.radio {
	width: 100%;
	border-collapse: collapse;
}
table.radio td {
	padding: 5px;
	vertical-align: middle;
}
table.radio tr td:first-child {
	width: 1px;
}
table.radio tr.highlight:hover td {
	background: #F1FFDD;
	cursor: pointer;
}
table.radio label {
	width: 100%;
	height: 15px;
	display: inline-block;
}
.pagination {
	border-top: 1px solid #EEEEEE;
	padding-top: 8px;
	display: inline-block;
	width: 100%;
	margin-bottom: 10px;
}
.pagination .links {
	float: left;
}
.pagination .links a {
	display: inline-block;
	border: 1px solid #EEEEEE;
	padding: 4px 10px;
	text-decoration: none;
	/* color: #A3A3A3; */
}
.pagination .links b {
	display: inline-block;
	border: 1px solid #269BC6;
	padding: 4px 10px;
	font-weight: normal;
	text-decoration: none;
	/* color: #269BC6; */
	background: #FFFFFF;
}
.pagination .results {
	float: right;
	padding-top: 3px;
}
/* button */
a.button_ext,input.button_ext {
	cursor: pointer;
	color: #FFFFFF;
	line-height: 12px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;	
	background-color:<?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	-webkit-border-radius: 7px 7px 7px 7px;
	-moz-border-radius: 7px 7px 7px 7px;
	-khtml-border-radius: 7px 7px 7px 7px;
	border-radius: 7px 7px 7px 7px;
	-webkit-box-shadow: 0px 2px 2px #DDDDDD;
	-moz-box-shadow: 0px 2px 2px #DDDDDD;
	box-shadow: 0px 2px 2px #DDDDDD;	
}
a.button_ext {
	display: inline-block;
	text-decoration: none;
	padding: 5px 12px 6px 12px;
}
input.button_ext {
	margin: 0;
	border: 0;
	height: 24px;
	padding: 0px 12px 0px 12px;
}
a.button_ext:hover, input.button_ext:hover {
	text-decoration:none;
	background-color:<?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;
}
#main a.button_ext:hover {
	text-decoration:none;
	background-color:<?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;
}

.buttons {
	/* background: #FFFFFF;  */
	border: 1px solid #EEEEEE;
	overflow: auto;
	padding: 6px;
	margin-bottom: 20px;
}
.buttons .left_ext {
	float: left;
	text-align: left;
}
.buttons .right_ext {
	float: right;
	text-align: right;
}
.buttons .center {
	text-align: center;
	margin-left: auto;
	margin-right: auto;
}
.htabs {
	margin-bottom: -1px;
	overflow: auto;
	border-bottom: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;	
}
.htabs a {
	border-top: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-left: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-right: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>; 
	background-color:<?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	padding: 7px 15px 6px 15px;
	float: left;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight: bold;
	text-align: center;
	text-decoration: none;
	color: #FFFFFF;
	margin-right: 2px;
	display: none;
}
.htabs a.selected {
	padding-bottom: 7px;
	background: <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
}
.htabs a:hover {
	background: <?php echo "#".DEFAULT_BUTTON_HOVER_COLOR_TEMPLATE;?>;
	color:<?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>0;
}
.tab-content {
	border-left: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-right: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-bottom: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	padding: 10px;
	margin-bottom: 20px;
	z-index: 2;
	overflow: hidden;
}
/* box */
.box_ext {
	margin-bottom: 20px;
}
.box_ext .box-heading {
	-webkit-border-radius: 7px 7px 0px 0px;
	-moz-border-radius: 7px 7px 0px 0px;
	-khtml-border-radius: 7px 7px 0px 0px;
	border-radius: 7px 7px 0px 0px;
	border: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	background-color:<?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	padding: 8px 10px 7px 10px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
	line-height: 14px;
	color: #FFFFFF;
}
.box_ext .box-content {
	-webkit-border-radius: 0px 0px 7px 7px;
	-moz-border-radius: 0px 0px 7px 7px;
	-khtml-border-radius: 0px 0px 7px 7px;
	border-radius: 0px 0px 7px 7px;
	border-left: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-right: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-bottom: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	padding: 10px;
}
/* box products */
.box-product {
	width: 100%;
	overflow: hidden;
	margin-left:38px;
}
.box-product > div {
	width: 130px;
	display: inline-block;
	vertical-align: top;
	margin-right: 20px;
	margin-bottom: 20px;	
}
#column-left + #column-right + #content_ext .box-product > div {
	width: 119px;
}
.box-product .image {
	display: block;
	margin-bottom: 0px;
}
.image a:hover {
	background-color:transparent;
}
.box-product .image img {
	padding: 3px;
	border: 1px solid #E7E7E7;	
	
}
#main .box-product .image img:hover {
	background-color:transparent;
}
.box-product .name a {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>; 
	font-weight: bold;
	text-decoration: none;
	display: block;
	margin-bottom: 4px;
}
.box-product .price {
	display: block;
	font-weight: bold;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	margin-bottom: 4px;
}
.box-product .price-old {
	color: #F00;
	text-decoration: line-through;
}
.box-product .price-new {
	font-weight: bold;
}
.box-product .rating {
	display: block;
	margin-bottom: 4px;
}
/* box category */
.box-category {
	margin-top: -5px;
}
.box-category ul {
	list-style: none;
	margin: 0;
	padding: 0;
}
.box-category > ul > li {
	/*  padding: 8px 8px 8px 0px; */
}
.box-category > ul > li + li {
	border-top: 1px solid #EEEEEE;
}
.box-category > ul > li > a {
	text-decoration: none;
	/* color: #333; */
}
.box-category > ul > li ul {
	display: none;
}
.box-category > ul > li a.active {
	font-weight: bold;
}
.box-category > ul > li a.active + ul {
	display: block;
}
.box-category > ul > li ul > li {
	/* padding: 5px 5px 0px 10px; */
}
.box-category > ul > li ul > li > a {
	text-decoration: none;
	display: block;
}
.box-category > ul > li ul > li > a.active {
	font-weight: bold;
}
/* content */
#content_ext .content_ext {
	padding: 10px;
	overflow: auto;
	margin-bottom: 20px;
	border: 1px solid #EEEEEE;
}
#content_ext .content_ext .left_ext {
	float: left;
	width: 49%;
}
#content_ext .content_ext .right_ext {
	float: right;
	width: 49%;
}
/* category */
.category-info {
	overflow: auto;
	margin-bottom: 20px;
}
.category-info .image {
	float: left;
	padding: 5px;
	margin-right: 15px;
	border: 1px solid #E7E7E7;
}
.category-list {
	overflow: hidden;
	margin-bottom: 20px;
}
.category-list ul {
	float: left;
	width: 18%;
}
.category-list .div a {
	text-decoration: underline;
	font-weight: bold;
}
/* manufacturer */
.manufacturer-list {
	border: 1px solid <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	padding: 5px;
	overflow: auto;
	margin-bottom: 20px;
}
.manufacturer-heading {
	background: #F8F8F8;
	font-size: 15px;
	font-weight: bold;
	padding: 5px 8px;
	margin-bottom: 6px;
}
.manufacturer-content {
	padding: 8px;
}
.manufacturer-list ul {
	float: left;
	width: 25%;
	margin: 0;
	padding: 0;
	list-style: none;
	margin-bottom: 10px;
}
/* product */
.product-filter {
	border-bottom: 1px solid #EEEEEE;
	padding-bottom: 5px;
	overflow: auto;
}
.product-filter .display {
	margin-right: 15px;
	float: left;
	padding-top: 4px;
	/* color: #333; */
}
.product-filter .display a {
	font-weight: bold;
	margin:0px;
}
.product-filter .sort {
	float: right;
	/* color: #333; */
}
.product-filter .limit {
	margin-left: 15px;
	float: right;
	/* color: #333; */
}
.product-compare {
	padding-top: 6px;
	margin-bottom: 25px;
	font-weight: bold;
}
.product-compare a {
	text-decoration: none;
	font-weight: bold;
}
.product-list > div {
	overflow: hidden;
	margin-bottom: 15px;
}
.product-list .right_ext {
	float: right;
	margin-left: 15px;
}
.product-list > div + div {
	border-top: 1px solid #EEEEEE;
	padding-top: 16px;
}
.product-list .image {
	float: left;
	margin-right: 10px;
}
.product-list .image img {
	padding: 3px;
	border: 1px solid #E7E7E7;
}
.product-list .name {
	margin-bottom: 3px;
}
.product-list .name a {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	font-weight: bold;
	text-decoration: none;
}
.product-list .description {
	line-height: 15px;
	margin-bottom: 5px;
	/* color: #4D4D4D; */
}
.product-list .rating {
	/* color: #7B7B7B; */
}
.product-list .price {
	float: right;
	height: 50px;
	margin-left: 8px;
	text-align: right;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	font-size: 12px;
}
.product-list .price-old {
	color: #F00;
	text-decoration: line-through;
}
.product-list .price-new {
	font-weight: bold;
}
.product-list .price-tax {
	font-size: 12px;
	font-weight: normal;
	/* color: #BBBBBB; */
}
.product-list .cart {
	margin-bottom: 3px;
}
.product-list .wishlist, .product-list .compare {
	margin-bottom: 3px;
}
.product-list .wishlist a {
	/* color: #333333; */
	text-decoration: none;
	padding-left: 18px;
	display: block;
	background: url('catalog/view/theme/facebook/image/add.png') left center no-repeat;
}
.product-list .compare a {
	/* color: #333333; */
	text-decoration: none;
	padding-left: 18px;
	display: block;
	background: url('catalog/view/theme/facebook/image/add.png') left 60% no-repeat;
}
.product-list .p_share a {
text-decoration: none;
padding-left: 18px;
display: block;
background: url('catalog/view/theme/facebook/image/share.jpg') left 60% no-repeat;
}
	
.product-grid {
	width: 100%;
	overflow: auto;
}
.product-grid > div {
	width: 130px;
	display: inline-block;
	vertical-align: top;
	margin-right: 20px;
	margin-bottom: 15px;
	overflow: hidden;
}
#column-left + #column-right + #content_ext .product-grid > div {
	width: 125px;
}
.product-grid .image {
	display: block;
	margin-bottom: 0px;
}
.product-grid .image img {
	padding: 3px;
	border: 1px solid #E7E7E7;
}
.product-grid .name a {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	font-weight: bold;
	text-decoration: none;
	display: block;
	margin-bottom: 4px;
}
.product-grid .description {
	display: none;
}
.product-grid .rating {
	display: block;
	margin-bottom: 4px;
}
.product-grid .price {
	display: block;
	font-weight: bold;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	margin-bottom: 4px;
}
.product-grid .price-old {
	color: #F00;
	text-decoration: line-through;
}
.product-grid .price-new {
	font-weight: bold;
}
.product-grid .price .price-tax {
	display: none;
}
.product-grid .cart {
	margin-bottom: 3px;
}
.product-grid .wishlist, .product-grid .compare {
	margin-bottom: 3px;
}
.product-grid .wishlist a {
	/* color: #333333; */
	text-decoration: none;
	padding-left: 18px;
	display: block;
	background: url('catalog/view/theme/facebook/image/add.png') left center no-repeat;
}
.product-grid .compare a {
	/* color: #333333; */
	text-decoration: none;
	padding-left: 18px;
	display: block;
	background: url('catalog/view/theme/facebook/image/add.png') left center no-repeat;
}
.product-grid .p_share a {
	text-decoration: none;
	padding-left: 18px;
	display: block;
	background: url('catalog/view/theme/facebook/image/share.jpg') left center no-repeat;
}

/* Product */
.product-info {
	overflow: auto;
	margin-bottom: 20px;
}
.product-info > .left_ext {
	float: left;
	width:38%;
}
.product-info > .right_ext {
	float: right;
	width:59%;
}
/*
.product-info > .left_ext + .right_ext {
	margin-left: 265px;
}
*/
.product-info .image {
	border: 1px solid #E7E7E7;
	float: left;
	margin-bottom: 20px;
	padding: 10px;
	text-align: center;

}
.product-info .image-additional {
	width: 200px;
	margin-left: -10px;
	clear: both;
	overflow: hidden;
}
.product-info .image-additional img {
	border: 1px solid #E7E7E7;
}
.product-info .image-additional a {
	float: left;
	display: block;
	margin-left: 10px;
	margin-bottom: 10px;
	background-color:transparent;
}
.product-info .description {
	border-top: 1px solid #E7E7E7;
	border-bottom: 1px solid #E7E7E7;
	padding: 5px 5px 10px 5px;
	margin-bottom: 10px;
	line-height: 20px;
	/* color: #4D4D4D; */
}
.product-info .description span {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
}
.product-info .description a {
	/* color: #4D4D4D; */
	text-decoration: none;
}
.product-info .price {
	overflow: auto;
	border-bottom: 1px solid #E7E7E7;
	padding: 0px 5px 10px 5px;
	margin-bottom: 10px;
	font-size: 15px;
	font-weight: bold;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
}
.product-info .price-old {
	color: #F00;
	text-decoration: line-through;
}
.product-info .price-new {
	
}
.product-info .price-tax {
	font-size: 12px;
	font-weight: normal;
	/* color: #999; */
}
.product-info .price .reward {
	font-size: 12px;
	font-weight: normal;
	/* color: #999; */
}
.product-info .price .discount {
	font-weight: normal;
	font-size: 12px;
	/* color: #4D4D4D; */
}
.product-info .options {
	border-bottom: 1px solid #E7E7E7;
	padding: 0px 5px 10px 5px;
	margin-bottom: 10px;
	/* color: #000000; */
}
.product-info .option-image {
	margin-top: 3px;
	margin-bottom: 10px;
}
.product-info .option-image label {
	display: block;
	width: 100%;
	height: 100%;
}
.product-info .option-image img {
	margin-right: 5px;
	border: 1px solid #CCCCCC;
	cursor: pointer;
}
.product-info .cart {
	border-bottom: 1px solid #E7E7E7;
	padding: 0px 5px 10px 5px;
	margin-bottom: 20px;
	/* color: #4D4D4D; */
	overflow: hidden;
}
.product-info .cart div {
	float: left;
	vertical-align: middle;
}
.product-info .cart div > span {
	padding-top: 7px;
	display: block;
	/* color: #999; */
}
.product-info .cart .minimum {
	padding-top: 5px;
	font-size: 11px;
	/* color: #999; */
	clear: both;
}
.product-info .review {
	/* color: #4D4D4D; */
	border-top: 1px solid #E7E7E7;
	border-left: 1px solid #E7E7E7;
	border-right: 1px solid #E7E7E7;
	margin-bottom: 10px;
}
.product-info .review > div {
	padding: 8px;
	border-bottom: 1px solid #E7E7E7;
	line-height: 20px;
}
.product-info .review > div > span {
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
}
.product-info .review .share {
	overflow: auto;
	line-height: normal;
}
.product-info .review .share a {
	text-decoration: none;
}
.attribute {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-bottom: 20px;
}
.attribute thead td, .attribute thead tr td:first-child {
	color: #000000;
	font-size: 14px;
	font-weight: bold;
	background: #F7F7F7;
	text-align: left;
}
.attribute tr td:first-child {
	color: #000000;
	font-weight: bold;
	text-align: right;
	width: 20%;
}
.attribute td {
	padding: 7px;
	color: #4D4D4D;
	text-align: center;
	vertical-align: top;
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
.compare-info {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-bottom: 20px;
}
.compare-info thead td, .compare-info thead tr td:first-child {
	color: #000000;
	font-size: 14px;
	font-weight: bold;
	background: #F7F7F7;
	text-align: left;
}
.compare-info tr td:first-child {
	color: #000000;
	font-weight: bold;
	text-align: right;
}
.compare-info td {
	padding: 7px;
	width: 20%;
	color: #4D4D4D;
	text-align: center;
	vertical-align: top;
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
.compare-info .name a {
	font-weight: bold;
}
.compare-info .price-old {
	font-weight: bold;
	/* color: #F00; */
	text-decoration: line-through;
}
.compare-info .price-new {
	font-weight: bold;
}
/* wishlist */
.wishlist-info table {
	width: 100%;
	border-collapse: collapse;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	border-right: 1px solid #DDDDDD;
	margin-bottom: 20px;
}
.wishlist-info td {
	padding: 7px;
}
.wishlist-info thead td {
	color: #4D4D4D;
	font-weight: bold;
	background-color: #F7F7F7;
	border-bottom: 1px solid #DDDDDD;
}
.wishlist-info thead .image {
	text-align: center;
}
.wishlist-info thead .name, .wishlist-info thead .model, .wishlist-info thead .stock {
	text-align: left;
}
.wishlist-info thead .quantity, .wishlist-info thead .price, .wishlist-info thead .total, .wishlist-info thead .action {
	text-align: right;
}
.wishlist-info tbody td {
	vertical-align: top;
	border-bottom: 1px solid #DDDDDD;
}
.wishlist-info tbody .image img {
	border: 1px solid #DDDDDD;
}
.wishlist-info tbody .image {
	text-align: center;
}
.wishlist-info tbody .name, .wishlist-info tbody .model, .wishlist-info tbody .stock {
	text-align: left;
}
.wishlist-info tbody .quantity, .wishlist-info tbody .price, .wishlist-info tbody .total, .wishlist-info tbody .action {
	text-align: right;
}
.wishlist-info tbody .price s {
	/* color: #F00; */
}
.wishlist-info tbody .action img {
	cursor: pointer;
}
.login-content {
	margin-bottom: 20px;
	overflow: auto;
}
.login-content .left_ext {
	float: left;
	width: 48%;
}
.login-content .right_ext {
	float: right;
	width: 48%
}
.login-content .left_ext .content_ext, .login-content .right_ext .content_ext {
	min-height: 190px;
}
/* orders */
.order-list {
	margin-bottom: 10px;
}
.order-list .order-id {
	width: 49%;
	float: left;
	margin-bottom: 2px;
}
.order-list .order-status {
	width: 49%;
	float: right;
	text-align: right;
	margin-bottom: 2px;
}
.order-list .order-content {
	padding: 10px 0px;
	display: inline-block;
	width: 100%;
	margin-bottom: 20px;
	border-top: 1px solid #EEEEEE;
	border-bottom: 1px solid #EEEEEE;
}
.order-list .order-content div {
	float: left;
	width: 33.3%;
}
.order-list .order-info {
	text-align: right;
}
.order-detail {
	background: #EFEFEF;
	font-weight: bold;
}
/* returns */
.return-list {
	margin-bottom: 10px;
}
.return-list .return-id {
	width: 49%;
	float: left;
	margin-bottom: 2px;
}
.return-list .return-status {
	width: 49%;
	float: right;
	text-align: right;
	margin-bottom: 2px;
}
.return-list .return-content {
	padding: 10px 0px;
	display: inline-block;
	width: 100%;
	margin-bottom: 20px;
	border-top: 1px solid #EEEEEE;
	border-bottom: 1px solid #EEEEEE;
}
.return-list .return-content div {
	float: left;
	width: 33.3%;
}
.return-list .return-info {
	text-align: right;
}
.return-product {
	overflow: auto;
	margin-bottom: 20px;
}
.return-name {
	float: left;
	width: 31%;
	margin-right: 15px;
}
.return-model {
	float: left;
	width: 31%;
	margin-right: 15px;
}
.return-quantity {
	float: left;
	width: 31%;
}
.return-detail {
	overflow: auto;
	margin-bottom: 20px;
}
.return-reason {
	float: left;
	width: 31%;
	margin-right: 15px;
}
.return-opened {
	float: left;
	width: 31%;
	margin-right: 15px;
}
.return-opened textarea {
	width: 98%;
	vertical-align: top;
}
.return-captcha {
	float: left;
}
.download-list {
	margin-bottom: 10px;
}
.download-list .download-id {
	width: 49%;
	float: left;
	margin-bottom: 2px;
}
.download-list .download-status {
	width: 49%;
	float: right;
	text-align: right;
	margin-bottom: 2px;
}
.download-list .download-content {
	padding: 10px 0px;
	display: inline-block;
	width: 100%;
	margin-bottom: 20px;
	border-top: 1px solid #EEEEEE;
	border-bottom: 1px solid #EEEEEE;
}
.download-list .download-content div {
	float: left;
	width: 33.3%;
}
.download-list .download-info {
	text-align: right;
}
/* cart */
.cart-info table {
	width: 100%;
	margin-bottom: 20px;
	border-collapse: collapse;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	border-right: 1px solid #DDDDDD;
}
.cart-info td {
	padding: 7px;
}
.cart-info thead td {
	color: #4D4D4D;
	font-weight: bold;
	background-color: #F7F7F7;
	border-bottom: 1px solid #DDDDDD;
}
.cart-info thead .image {
	text-align: center;
}
.cart-info thead .name, .cart-info thead .model, .cart-info thead .quantity {
	text-align: left;
}
.cart-info thead .price, .cart-info thead .total {
	text-align: right;
}
.cart-info tbody td {
	vertical-align: top;
	border-bottom: 1px solid #DDDDDD;
}
.cart-info tbody .image img {
	border: 1px solid #DDDDDD;
}
.cart-info tbody .image {
	text-align: center;
}
.cart-info tbody .name, .cart-info tbody .model, .cart-info tbody .quantity {
	text-align: left;
}
.cart-info tbody .quantity input[type='image'], .cart-info tbody .quantity img {
	position: relative;
	top: 4px;
	cursor: pointer;
}
.cart-info tbody .price, .cart-info tbody .total {
	text-align: right;
}
.cart-info tbody span.stock {
	/* color: #F00; */
	font-weight: bold;
}
.cart-module > div {
	display: none;
	overflow: auto;
}
.cart-total {
	border-top: 1px solid #DDDDDD;
	overflow: auto;
	padding-top: 8px;
	margin-bottom: 15px;
}
.cart-total table {
	float: right;
}
.cart-total td {
	padding: 3px;
	text-align: right;
}
/* checkout */
.checkout-heading {
	/* background: #F8F8F8; */
	border: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	padding: 8px;
	font-weight: bold;
	font-size: 13px;
	/* color: #555555; */
	margin-bottom: 15px;
}
.checkout-heading a {
	float: right;
	margin-top: 1px;
	font-weight: normal;
	text-decoration: none;
}
.checkout-content {
	padding: 0px 0px 15px 0px;
	display: none;
	overflow: hidden;
}
.checkout-content .left_ext {
	float: left;
	width: 48%;
}
.checkout-content .right_ext {
	float: right;
	width: 48%;
}
.checkout-content .buttons {
	clear: both;
}
.checkout-product table {
	width: 100%;
	border-collapse: collapse;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	border-right: 1px solid #DDDDDD;
	margin-bottom: 20px;
}
.checkout-product td {
	padding: 7px;
}
.checkout-product thead td {
	color: #4D4D4D;
	font-weight: bold;
	background-color: #F7F7F7;
	border-bottom: 1px solid #DDDDDD;
}
.checkout-product thead .name, .checkout-product thead .model {
	text-align: left;
}
.checkout-product thead .quantity, .checkout-product thead .price, .checkout-product thead .total {
	text-align: right;
}
.checkout-product tbody td {
	vertical-align: top;
	border-bottom: 1px solid #DDDDDD;
}
.checkout-product tbody .name, .checkout-product tbody .model {
	text-align: left;
}
.checkout-product tbody .quantity, .checkout-product tbody .price, .checkout-product tbody .total {
	text-align: right;
}
.checkout-product tfoot td {
	text-align: right;
	border-bottom: 1px solid #DDDDDD;
}
.contact-info {
	overflow: auto;
}
.contact-info .left_ext {
	float: left;
	width: 48%;
}
.contact-info .right_ext {
	float: left;
	width: 48%;
}
.sitemap-info {
	overflow: auto;
	margin-bottom: 40px;
}
.sitemap-info .left_ext {
	float: left;
	width: 48%;
}
.sitemap-info .right_ext {
	float: left;
	width: 48%;
}
/* footer */ 
#footer_ext {
	clear: both;
	overflow: hidden;
	min-height: 135px;
	padding: 20px;
	border-top: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-bottom: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-left: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
	border-right: 1px solid <?php echo "#".DEFAULT_BUTTONBOX_COLOR_TEMPLATE;?>;
}
#footer_ext h3 {
	font-size: 14px;
	margin-top: 0px;
	margin-bottom: 8px;
	color:<?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
}
#footer_ext .column {
	float: left;
	width: 25%;
	min-height: 135px;
}
#footer_ext .column ul {
	margin-top: 0px;
	margin-left: 8px;
	padding-left: 12px;
        /* list-style: url('catalog/view/theme/facebook/image/bullet.png'); */
}
#footer_ext .column ul li {
	margin-bottom: 3px;
}
#footer_ext .column a {
	padding: 0px 0px 0px 4px;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
	text-decoration: none;
	font-size: 12px;
	font-weight:bold;
}
#footer_ext .column a:hover {
	text-decoration: underline;
}
#powered {
	margin-top: 5px;
	text-align: right;
	clear: both;
	color: <?php echo "#".DEFAULT_TXT_COLOR_TEMPLATE;?>;
}
/* banner */
.banner_ext div {
	text-align: center;
	width: 100%;
	display: none;
}
.banner_ext div img {
	margin-bottom: 20px;
}
-->
</style>