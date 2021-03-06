<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
global $woo_options, $woocommerce;
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php if ( $woo_options['woo_boxed_layout'] == 'true' ) echo 'boxed'; ?> <?php if (!class_exists('woocommerce')) echo 'woocommerce-deactivated'; ?>">
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php woo_title(''); ?></title>
<?php woo_meta(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	wp_head();
	woo_head();
?>
<link href='http://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Raleway" rel="stylesheet">


<!--CAROUSEL COMPONENTS-->
<link rel="stylesheet" href="wp-content/themes/mystile/carouselcomponents/tinycarousel.css" type="text/css" media="screen"/>
<script type="text/javascript" src="wp-content/themes/mystile/carouselcomponents/jquery-latest.min.js"></script>
<script src="wp-content/themes/mystile/carouselcomponents/jquery.tinycarousel.js"></script>


</head>

<body <?php body_class(); ?>>
<?php woo_top(); ?>

<div id="wrapper">



	<div id="top">
		<nav class="col-full" role="navigation">
			<?php if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'top-menu' ) ) { ?>
			<?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav fl', 'theme_location' => 'top-menu' ) ); ?>
			<?php } ?>
			<?php
				if ( class_exists( 'woocommerce' ) ) {
					echo '<ul class="nav wc-nav">';
						woocommerce_cart_link();
						echo '<li class="checkout"><a href="'.esc_url($woocommerce->cart->get_checkout_url()).'">'.__('Checkout','woothemes').'</a></li>';
					echo '</ul>';
				}
			?>
		</nav>
		
	</div><!-- /#top -->

	<div class="logo-container">
		<div class="col-full">
			<div class="col-left right-line">
				<hgroup>
					<?php
							$logo = esc_url( get_template_directory_uri() . '/images/logo.png' );
							if ( isset( $woo_options['woo_logo'] ) && $woo_options['woo_logo'] != '' ) { $logo = $woo_options['woo_logo']; }
							if ( isset( $woo_options['woo_logo'] ) && $woo_options['woo_logo'] != '' && is_ssl() ) { $logo = preg_replace("/^http:/", "https:", $woo_options['woo_logo']); }
						?>
						<?php if ( ! isset( $woo_options['woo_texttitle'] ) || $woo_options['woo_texttitle'] != 'true' ) { ?>
								<a id="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr( get_bloginfo( 'description' ) ); ?>">
									<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
								</a>
						<?php } ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src = "<?=$logo ?> "/></a></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<h3 class="nav-toggle"><a href="#navigation"><mark class="websymbols">&#178;</mark> <span><?php _e('Navigation', 'woothemes'); ?></span></a></h3>
				</hgroup>
			</div>
			<div class="top_phone col-left ">
				<div >
					<h2 class="callus">08-095-976</h2>
					<p>Cras vitae diam diam. Quisque tempus euismod odio</p>
				</div>
				<div id="searchcontainer">
				<?php
					if ( class_exists( 'woocommerce' ) ) {
						echo '<ul class="nav wc-nav">';
							echo get_search_form();
						echo '</ul>';
					}
					?>
				</div>
			</div>
			
			<div class="socialicon col-right ">
				<ul>
					<li class="fb"><a href="#" >fb</a></li>
					<li class="tw"><a href="#" >twitter</a></li>
					<li class="ln"><a href="#" >twitter</a></li>
					<li class="gl"><a href="#" >google</a></li>
					<li class="sk"><a href="#" >skype</a></li>
				</ul>
			</div>
			
			<nav id="navigation"  role="navigation">
				<?php
				if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' ) ) {
					wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav fr', 'theme_location' => 'primary-menu' ) );
				} else {
				?>
				<ul id="main-nav" class="nav fl">
					<?php if ( is_page() ) $highlight = 'page_item'; else $highlight = 'page_item current_page_item'; ?>
					<li class="<?php echo $highlight; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Home', 'woothemes' ); ?></a></li>
					<?php wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' ); ?>
				</ul><!-- /#nav -->
				<?php } ?>

			</nav><!-- /#navigation -->
			
			
		</div>
	</div>
	<div class="nav_fullwidth">
		<div class="col-full">		
			
			
			
		</div>
	</div>
	


    <?php woo_header_before(); ?>
	<div class="absolute">
		<header id="header" class="col-full">
			
			<?php woo_nav_before(); ?>
			<?php woo_nav_after(); ?>
		</header><!-- /#header -->
	</div>
	

	<?php woo_content_before(); ?>