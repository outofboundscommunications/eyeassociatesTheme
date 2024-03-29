<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	
	<div class="main_header">
		<header class="page-header">
			
			<div class="page-header-wrapper">
				<?php get_template_part( 'content/content', 'page-header' );?>
			</div>
			
		</header>
	</div><!-- .main_header -->
	
	<div class="main_content">
		<div class="container">
			<div class="row">
			
				<section id="primary" class="site-content col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="content" role="main">
					<?php
					if ( have_posts() ){
						?>

						<?php
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						 *
						 * We reset this later so we can run the loop
						 * properly with a call to rewind_posts().
						 */
						the_post();
						?>

						<header class="archive-header">
							<h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'twentytwelve' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
						</header><!-- .archive-header -->

						<?php
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();
						
						/* Start the Loop */
						while ( have_posts() ){
							the_post();
							
							get_template_part( 'content/content', 'blog' );
						}
						
						twentytwelve_content_nav( 'nav-below' );
						
					}else{
						// get_template_part( 'content/content', 'no_posts' );
						get_template_part( 'content', 'none' );
					}
					?>

					</div><!-- #content -->
				</section><!-- #primary -->

				<?php //get_sidebar(); ?>
				
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .main_content -->
<?php get_footer(); ?>