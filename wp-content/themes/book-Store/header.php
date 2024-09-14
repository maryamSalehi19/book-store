<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BookStore
 */

?><!DOCTYPE html>

<html <?php language_attributes(); if(is_singular('post')) echo 'style="overflow-x:inherit"' ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); if(is_singular('post')) echo 'style="overflow-x:inherit"' ?>>

<div>
  <header role="banner">
    <div>
      Header
    </div>
  </header>
</div>