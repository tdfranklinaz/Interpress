<?php 
/**
 * Theme header
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

  <!-- placeholder favicon -->
  <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">

  <!-- fonts -->
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700&family=Space+Mono&display=swap" rel="stylesheet"> -->

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <div id="page" class="site">

    <!-- screen reader skip to main content -->
    <a class="sr-only" href="#primary">
      <?php esc_html_e('Skip to content', 'rapidpress'); ?>
    </a>

    <!-- navbar -->
    <header class="container mx-auto">
    </header>