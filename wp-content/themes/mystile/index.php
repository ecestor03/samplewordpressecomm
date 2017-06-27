<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * Index Template
 *
 * Here we setup all logic and XHTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;
	
?>

    <?php if ( $woo_options[ 'woo_homepage_banner' ] == "true" ) { ?>
    	
    	<div class="homepage-banner">
    		<?php
				if ( $woo_options[ 'woo_homepage_banner' ] == "true" ) { $banner = $woo_options['woo_homepage_banner_path']; }
				if ( $woo_options[ 'woo_homepage_banner' ] == "true" && is_ssl() ) { $banner = preg_replace("/^http:/", "https:", $woo_options['woo_homepage_banner_path']); }
			?>
			<img src="<?php echo $banner; ?>" alt="" />
    		<div class="bannertext">
				<h1><span><?php echo $woo_options['woo_homepage_banner_headline']; ?></span></h1>
				<div class="description"><?php echo wpautop($woo_options['woo_homepage_banner_standfirst']); ?></div>
				<div class="socialicon"><?php if ( function_exists('cn_social_icon') ) echo cn_social_icon(); ?></div>
			</div>
    	</div>
    	
    <?php } ?>

	<div id="maincontents">
	
		<div id="shopwithcategories">
			<div class="col-full">
				<?php
					$taxonomyName = "product_cat";
					//This gets top layer terms only.  This is done by setting parent to 0.  
						$parent_terms = get_terms($taxonomyName, array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => false));

						echo '<ul>';
						echo "<li class='catmain'> <img src='wp-content/themes/mystile/images/catarrow.png' alt='' width='60' height='60' /><br/>CATEGORIES</li>";
						foreach ($parent_terms as $pterm) {
							//print_r($pterm->slug);
							//show parent categories
							//echo '<li><a href=" ' . get_term_link($pterm->name, $taxonomyName) . '">' . $pterm->name . '</a></li>';

							$thumbnail_id = get_woocommerce_term_meta($pterm->term_id, 'thumbnail_id', true);
							// get the image URL for parent category
							$image = wp_get_attachment_url($thumbnail_id);
							// print the IMG HTML for parent category
							?>
							<li><a href='index.php/product-category/<?php echo $pterm->slug ?>/'><img src=<?php echo $image ?> alt='' width='60' height='60' /><br/><?php echo $pterm->name ?></a></li>
							<?php
							//Get the Child terms
							$terms = get_terms($taxonomyName, array('parent' => $pterm->term_id, 'orderby' => 'slug', 'hide_empty' => false));
							foreach ($terms as $term) {

								echo '<li><a href="' . get_term_link($term->name, $taxonomyName) . '">' . $term->name . '</a></li>';
								$thumbnail_id = get_woocommerce_term_meta($pterm->term_id, 'thumbnail_id', true);
								// get the image URL for child category
								$image = wp_get_attachment_url($thumbnail_id);
								// print the IMG HTML for child category
								echo "<img src='{$image}' alt='' width='400' height='400' />";
							}
						}
						echo '</ul>';
				?>
			</div>
		</div>
		<div id="content" class="col-full <?php if ( $woo_options[ 'woo_homepage_banner' ] == "true" ) echo 'with-banner'; ?> <?php if ( $woo_options[ 'woo_homepage_sidebar' ] == "false" ) echo 'no-sidebar'; ?>">
			
			
			
			<?php woo_main_before(); ?>
			<section id="main" class="col-left">  
			<?php mystile_homepage_content(); ?>		
			<?php woo_loop_before(); ?>
			
			<?php if ( $woo_options[ 'woo_homepage_blog' ] == "true" ) { 
				$postsperpage = $woo_options['woo_homepage_blog_perpage'];
			?>
			
			<?php
				
				$the_query = new WP_Query( array( 'posts_per_page' => $postsperpage ) );
				
				if ( have_posts() ) : $count = 0;
			?>
			
				<?php /* Start the Loop */ ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); $count++; ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
					
					?>

				<?php 
					endwhile; 
					// Reset Post Data
					wp_reset_postdata();
				?>
				
				

			<?php else : ?>
			
				<article <?php post_class(); ?>>
					<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
				</article><!-- /.post -->
			
			<?php endif; ?>
			
			<?php } // End query to see if the blog should be displayed ?>
			
			<?php woo_loop_after(); ?>
							
			</section><!-- /#main -->
			
			<?php woo_main_after(); ?>

			<?php if ( $woo_options[ 'woo_homepage_sidebar' ] == "true" ) get_sidebar(); ?>

		</div><!-- /#content -->
		
		<div class="fullwidth frontpagespecial">
			<div class="col-full">
				<?php if (have_posts()) : ?>
						<?php query_posts('category_name=FRONTPAGE-SPECIAL'); ?>
						<h2 class="black">SPECIAL OFFERS</h2>
							<div id="endorsement" >

								<div id="slider1">
									<a class="buttons prev" href="#">&#60;</a>
									<div class="viewport">
										<ul class="overview">
											<?php while (have_posts()) : the_post(); ?>	
												<li>
													<?php  the_content( '',true,''); ?>
													<?php if(has_post_thumbnail()) {the_post_thumbnail();}?>	
												</li>
											<?php endwhile; ?>
										</ul>
									</div>
									<a class="buttons next" href="#">&#62;</a>
								</div>
								
							</div>
						<?php wp_reset_query();?>
					<?php endif; ?>	
			</div>

		</div>
		
		
		
		
		<div class="fullwidth lblue">
			<div class="col-full">
				<div id="snipet">
				<?php if (have_posts()) : ?>
						<?php query_posts('category_name=frontlinks'); ?>
							<div id="endorsement" >
							<?php while (have_posts()) : the_post(); ?>	
								<div class="e-col" >
									<div class="e-image">
										<?php if(has_post_thumbnail()) {the_post_thumbnail();}?>									
									</div>
									<h2 class="black"><?php the_title() ?></h2>
									<!--<div class="e-content" >
										<?php  the_content( '',true,''); ?>
									</div>-->
									<?php  the_excerpt(); ?>
									<p><a href="<?php echo get_permalink($post->ID) ?>" class="readmore" >Read More</a></p>
								</div>
							<?php endwhile; ?>
							</div>
						<?php wp_reset_query();?>
					<?php endif; ?>	
				</div>
			</div>
		</div>

		<div class="fullwidth whitebg">
			<div class="col-full">
		
				<?php eemail_show(); ?>
			</div>
		</div>
		
		<?php get_footer(); ?>
	</div>
	
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#slider1').tinycarousel();
	});
</script>