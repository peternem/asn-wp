<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package sparkling
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : 
			$row_count = 0;
			$tile_count = 0;
			$curr_cat = get_query_var('cat');  
		?>

			<header class="page-header row">	
					<?php
					$category = get_the_category(); 
					$category[0]->cat_name;
					?>

				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'sparkling' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'sparkling' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'sparkling' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'sparkling' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'sparkling' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'sparkling' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'sparkling' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'sparkling');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'sparkling');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'sparkling' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'sparkling' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'sparkling' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'sparkling' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'sparkling' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'sparkling' );

						else :
							_e( 'Archives', 'sparkling' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->
			<div class="row tiles">

			<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post();
					
					?>
					
					<?php
						$tispan = "col-xs-5 col-sm-5 col-md-5 col-lg-5";	
						$flag="b";
					
						if(($tile_count == 0 ) || ($tile_count == 3 ) || ($tile_count == 4) || ($tile_count == 7) || ($tile_count == 8)){
							$tispan= "col-xs-7 col-sm-7 col-md-7 col-lg-7";
							$flag="a";
						}
						
						if(($tile_count == 5 ) || ($tile_count == 6) ||  ($tile_count == 9)){
							$tispan= "col-xs-5 col-sm-5 col-md-5 col-lg-5";
							$flag="b";
						}
					?>
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						//get_template_part( 'content', get_post_format() );
					?>
					
					<div id="post-<?php the_ID(); ?>" <?php post_class($tispan); ?> data-type-count="<?php echo $tile_count++; ?>">		
						<?php
					$category = get_the_category();
					$cat_name = 'News';
					$cats = '';
					for($i=0; $i<count($category); $i++){
						$cats .= ($cats != '' ? ', ' : '').$category[$i]->cat_name;
						if($category[$i]->cat_name == 'Video') $cat_name = 'Video';
					} 
					?>
						<div class="post-inner-content <?php echo $cat_name; ?>">
							<div class="tile_img">
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php if ($flag=="a") {
										
									if ( has_post_thumbnail()){ 
										the_post_thumbnail('sparkling-img-575x400');
									} else {
										?>
										<img src="<?php echo bloginfo( 'template_url' ); ?>/inc/img/ASN_tile_bg_575x400.png" class="placeholder-image">
										<?php
									}
									
								} elseif ($flag=="b") {
											
									if (has_post_thumbnail()){
										the_post_thumbnail('sparkling-img-405x400'); 
									} else {
									?>
									<img src="<?php echo bloginfo( 'template_url' ); ?>/inc/img/ASN_tile_bg_405x400.png" class="placeholder-image">
									<?php
									}
									
								} else {
										
									if (has_post_thumbnail()){ ?>
										<img src="<?php echo bloginfo( 'template_url' ); ?>/inc/img/ASN_tile_bg_320x400.png" class="placeholder-image">
									<?php
									} else {
										the_post_thumbnail('sparkling-img-320x400');
									}
								}
								?>
								</a>
							</div>
							<div class="post-summary">
								<div class="time_stamp"><small><?php the_time('F jS, Y'); ?></small></div>
								<div class="tile_title">
									<?php if (($cat_name) == "Video"){ ?>
										<h2 class="v_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> </a></h2>
										<div class="video_link"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo bloginfo( 'template_url' ); ?>/inc/img/asn_play_60x60.png" /></a></div>
									<?php } else { ?>
										<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php
						if (($tile_count == 2 ) || ($tile_count == 6 )){
						//if(($tile_count % 2 == 0) && ($tile_count != 10 ) || ($tile_count == 4 )){
						?>
						</div>
						<div class="row tiles">
						<?
						}
						if (($tile_count == 4 ) || ($tile_count == 8 )){
						//if(($tile_count % 2 == 0) && ($tile_count != 10 ) || ($tile_count == 4 )){
						?>
						</div>
						<!-- <div class="row tiles" >
							<div class="col-lg-12 ad_div">
							</div>
						</div> -->
						<div class="row tiles">
						<?
						}
						?>
				<?php endwhile; ?>				
			</div>
			<div class="row">
				<div class="col-lg-12">
					<?php sparkling_paging_nav(); ?>
				</div>
			</div>

		<?php else : ?>
			<div class="row">
				<div class="col-lg-12">
					<?php get_template_part( 'content', 'none' ); ?>
				</div>
			</div>
			

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar('post'); ?>
<?php get_footer(); ?>