<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
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
			
				<section id="primary" class="site-content col-sm-12">
					<div id="content" role="main">

						<?php
						if ( have_posts() ) {
							?>
							<header class="archive-header">
								<h1 class="archive-title"><?php
									if ( is_day() ) :
										printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
									elseif ( is_month() ) :
										printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
									elseif ( is_year() ) :
										printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
									else :
										_e( 'Archives', 'twentytwelve' );
									endif;
								?></h1>
							</header><!-- .archive-header -->

							<?php
							/* Start the Loop */
							while ( have_posts() ){
								the_post();
								
								get_template_part( 'content/content', 'blog' );
							}
							
							twentytwelve_content_nav( 'nav-below' );
							
						}else{
							get_template_part( 'content', 'none' );
						}
						?>

					</div><!-- #content -->
                    <div class="categories">
						<div class="row">
							<div class="col-sm-12">
								<?php
								$args = array(
								  'taxonomy'     => 'category',
								   'title_li' => '<h3>' . __( 'Categories', 'textdomain' ) . '</h3>'
								);
								$tax_terms = wp_list_categories( $args );
								?>

								<br>
								<?php
								$args = array(
									'numberposts' => 5,
									'offset' => 0,
									'category' => 0,
									'orderby' => 'post_date',
									'order' => 'DESC',
									'include' => '',
									'exclude' => '',
									'meta_key' => '',
									'meta_value' =>'',
									'post_type' => 'post',
									'post_status' => 'publish',
									'suppress_filters' => true
								);

								$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
								?>
								<h3>Recent Posts</h3>
								<ul>
									<?php
									foreach ($recent_posts as $recent_post)
									{
									?>
										<li> <a href="<?php echo get_permalink($recent_post["ID"]); ?>"><?php echo $recent_post['post_title']; ?></a></li>
									<?php
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</section><!-- #primary -->

				<?php //get_sidebar(); ?>
					
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .main_content -->
<?php get_footer(); ?>