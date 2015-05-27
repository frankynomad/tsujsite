<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo('name') ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<header class="clearfix">
	
	<?php 
		$logoClass;
		$navClass;
		if (get_the_ID() == 1) 
			$logoClass = "hideLogo";
			$navClass = "fullNav";
	?>
	
	<h1 class="nav-logo <?php echo $logoClass ?>">
		<a href="<?php get_home_url(); ?>">
			Chris Tsujiuchi
		</a>
	</h1>
	
	<nav class="menu main <?php echo $navClass ?>">
	    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
	</nav>

</header>