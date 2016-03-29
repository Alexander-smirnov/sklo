<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _tk
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="canonical" href="<?php echo get_home_url(); ?>" itemprop="url">
	<title itemprop='name'><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="shortcut icon" type="image/x-icon"
	      href="<?php echo get_template_directory_uri() . '/includes/img/favicon.ico' ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'before' ); ?>

<header id="masthead" class="site-header" role="banner">
	<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="site-header-inner">

					<?php $header_image = get_header_image();
					if ( ! empty( $header_image ) ) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
						   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>"
							     height="<?php echo get_custom_header()->height; ?>" alt="">
						</a>
					<?php } // end if ( ! empty( $header_image ) ) ?>

					<div class="row">
						<div class="site-branding col-md-3" itemscope itemtype="http://schema.org/Organization">
							<a href="<?php echo get_home_url(); ?>"
							   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
							   rel="home" itemprop="name" class="home-url"> </a>

							<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>

							<p class="lead"><?php bloginfo( 'description' ); ?></p>
						</div>
						<div class="contacts col-md-9">
							<?php
							$phone        = get_post_meta( 9, 'life', true );
							$phone_number = str_replace( '-', '', $phone );
							if ( $phone ) { ?>
								<p class="phone life-phone"><a itemprop="telephone"
										href="tel:<?php echo $phone_number ?>"><?php echo sanitize_text_field( $phone ); ?></a>
								</p>
							<?php }
							?>
							<?php
							$phone        = get_post_meta( 9, 'mts', true );
							$phone_number = str_replace( '-', '', $phone );
							if ( $phone ) { ?>
								<p class="phone mts-phone"><a itemprop="telephone"
										href="tel:<?php echo $phone_number ?>"><?php echo sanitize_text_field( $phone ); ?></a>
								</p>
							<?php }
							?>
							<?php
							$phone        = get_post_meta( 9, 'kyivstar', true );
							$phone_number = str_replace( '-', '', $phone );
							if ( $phone ) { ?>
								<p class="phone kyivstar-phone"><a itemprop="telephone"
										href="tel:<?php echo $phone_number ?>"><?php echo sanitize_text_field( $phone ); ?></a>
								</p>
							<?php }
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .container -->
</header>
<!-- #masthead -->

<nav class="site-navigation">
	<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="site-navigation-inner">
					<div class="navbar navbar-default">
						<div class="navbar-header">
							<!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
							<button type="button" class="navbar-toggle" data-toggle="collapse"
							        data-target=".navbar-collapse">
								<span class="sr-only"><?php _e( 'Toggle navigation', '_tk' ) ?> </span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<!-- The WordPress Menu goes here -->
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'depth'           => 2,
								'container'       => 'div',
								'container_class' => 'collapse navbar-collapse',
								'menu_class'      => 'nav navbar-nav',
								'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
								'menu_id'         => 'main-menu',
								'walker'          => new wp_bootstrap_navwalker()
							)
						); ?>

					</div>
				</div>
				<!-- .navbar -->
			</div>
		</div>
	</div>
	<!-- .container -->
</nav>
<!-- .site-navigation -->

<div class="main-content">
	<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container">
		<div class="row">
			<div id="content" class="main-content-inner col-sm-12">

