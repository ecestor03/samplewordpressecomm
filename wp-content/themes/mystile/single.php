<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Single Post Template
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a post ('post' post_type).
 * @link http://codex.wordpress.org/Post_Types#Post
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;
	
/**
 * The Variables
 *
 * Setup default variables, overriding them if the "Theme Options" have been saved.
 */
	
	$settings = array(
					'thumb_single' => 'false', 
					'single_w' => 300, 
					'single_h' => 300, 
					'thumb_single_align' => 'alignleft'
					);
					
	$settings = woo_get_dynamic_values( $settings );
?>
       
    <div id="content" class="col-full">
    
    	<?php woo_main_before(); ?>
    	
		<section id="main" class="fullwidth">
		           
        <?php
        	if ( have_posts() ) { $count = 0;
        		while ( have_posts() ) { the_post(); $count++;
        ?>
			<article <?php post_class(); ?>>
				<!--<aside class="meta">
					<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
						<?php echo get_avatar( get_the_author_meta('email'), '128' ); ?>
					</a>
					<span class="month"><?php the_time( 'M' ); ?></span>
					<span class="day"><?php the_time( 'd' ); ?></span>
					<span class="year"><?php the_time( 'o' ); ?></span>
				</aside>-->
				
				

					 <section class="entry fix postcontent">
						<header>
						
							<h1><?php the_title(); ?></h1>
							
								<?php echo woo_embed( 'width=300' ); ?>
								<?php if ( $settings['thumb_single'] == 'true' && ! woo_embed( '' ) ) { woo_image( 'width=' . 300 . '&height=' . 300 . '&class=thumbnail ' ); } ?>
								<?php //woo_post_meta(); ?>
							
						</header>
	                
	               
	                	<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
					</section>
													
				
                                
            </article><!-- .post -->

				<?php woo_subscribe_connect(); ?>

	        <!--<nav id="post-entries" class="fix">
	            <div class="nav-prev fl"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ); ?></div>
	            <div class="nav-next fr"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ); ?></div>
	        </nav><!-- #post-entries -->
            <?php
            	// Determine wether or not to display comments here, based on "Theme Options".
            	if ( isset( $woo_options['woo_comments'] ) && in_array( $woo_options['woo_comments'], array( 'post', 'both' ) ) ) {
            		comments_template();
            	}

				} // End WHILE Loop
			} else {
		?>
			<article <?php post_class(); ?>>
            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
			</article><!-- .post -->             
       	<?php } ?>  
        
		</section><!-- #main -->
		
		<?php woo_main_after(); ?>

        <?php //get_sidebar(); ?>

    </div><!-- #content -->

		
<?php get_footer(); ?>