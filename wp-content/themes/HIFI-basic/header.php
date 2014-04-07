<?php
	/**
		* the generic header that will be displayed everywhere in the test file.
		* @package WordPress
		* @subpackage HIFI-basic
		* @since April 2014
	**/
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
		<![endif]-->

		<!-- including the basic style.css file for the site -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"/>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<!-- head and nav sections would be written here -->

		<!-- beginning of the body content -->
		<section id="main" class="site-main">
