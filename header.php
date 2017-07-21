<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>

<header id="header">

    <div class="navbar wrap">
      
      <a href="<?php echo home_url() ?>" title="<?php bloginfo('name') ?>" class="logo"><?php bloginfo('name') ?></a>

      <?php wp_nav_menu(
        array(
            'theme_location' => 'primary',
            'container' => '',
            'menu_class' => 'nav',
            'fallback_cb' => '',
            'menu_id' => 'main-menu'
        )
      ); ?>
    </div>

</header><!-- /header -->
<div class="container" id="main">