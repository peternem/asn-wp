<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package sparkling
 */

get_header(); ?>

	<div id="primary" class="content-area">
		
		<main id="main" class="site-main" role="main">
		<div class="row featured_post">
			<?php $my_feat_query = new WP_Query('category_name=Featured&showposts=1');
			while ($my_feat_query->have_posts()) : $my_feat_query->the_post();
			$do_not_duplicate = $post->ID; ?>	
			<div class="col-md-12">		
				<div class="featured_tile row">
					<div class="tile_content col-md-12">
						<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
					</div>
					<div class="tile_img col-md-12">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('sparkling-featured-post'); ?></a>
						<?php
			
						if(get_field('video_iframe'))
						{
							//echo '<p>' . get_field('field_name') . '</p>';
						 ?>
							<div class='embed-container'>
								<iframe src="<?php echo get_field('video_iframe'); ?>" frameborder='0' allowfullscreen></iframe>
							</div>
						<?php
						}
						?>
					</div>
			
					<div class="tile_content col-md-12">
						<!-- <div class="time_stamp"><small><?php //the_author_posts_link(); ?> | <?php //the_time('F jS, Y'); ?></small></div> -->
						<div class="excerpt"><p><?php echo the_excerpt(); ?></p></div>
					</div>
				</div>	
			</div>	
			<?php endwhile; ?>
		</div>
		<?php if ( have_posts() ) : ?>


			<?php /* Start the Loop */
			
			//Set the initial count outside of the loop.
			$tile_count = (int)0; 
			?>
			<div class="row tiles">
			
			<?php
			//Get the Featured Category So we can exclude it in the query loop below.
			$category_ID = get_category_id('Featured');  
			?> 
			<?php $my_query = new WP_Query('category_name=Video,News&cat=-'.$category_ID); ?>
			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
				
				<?php	
					//Set the span to our default span12
					$tispan = "col-xs-7 col-sm-7 col-md-7 col-lg-7";	
					$flag="a";
					//If the count is 2 or 3 change span to be span3. You can put whatever conditions you want here
					if(( $tile_count == 2 || $tile_count == 3 || $tile_count == 4 ||  $tile_count == 7 || $tile_count == 8 ||$tile_count == 9 || $tile_count == 10 )){
				   		$tispan = "col-xs-4 col-sm-4 col-md-4 col-lg-4";
						$flag="b";
					}
					
					if(($tile_count == 1 || $tile_count == 6)){
						$tispan= "col-xs-5 col-sm-5 col-md-5 col-lg-5";
						$flag="c";
					}
		
					if($tile_count >= 10){
					   	$tile_count = 1;
					   	$tispan = "col-xs-4 col-sm-4 col-md-4 col-lg-4";	
						$flag="d";
					}
					
					//If its not 3 or higher, increase the count
					else{
					   	$tile_count++;
					}
					
					if (($tile_count == 3)) { ?>
						</div>
						<!-- <div class="row tiles">
							<div class="col-md-12 ad_div"></div>
						</div> -->
						<div class="row tiles">
					
					<?php
					}
					
					if (($tile_count == 6)) { ?>
						</div>
						<!-- <div class="row tiles">
							<div class="col-md-12 ad_div"></div>
						</div> -->
						<div class="row tiles">
					
					<?php
					}
				
					if (($tile_count == 8)) { ?>
						</div>
						<!-- <div class="row tiles">
							<div class="col-md-12 ad_div"></div>
						</div> -->
						<div class="row tiles">
				
					<?php
					}
					?>

				<div class="<?php echo $tispan; ?>">
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
									
								if (has_post_thumbnail()) {
									the_post_thumbnail('sparkling-img-575x400'); 
								} else {
								?>
									<img src="<?php echo bloginfo( 'template_url' ); ?>/inc/img/ASN_tile_bg_575x400.png" class="placeholder-image">
								<?php
								}
									
							} elseif ($flag=="c") {
								
								if (has_post_thumbnail()) {
									the_post_thumbnail('sparkling-img-405x400');
								} else {
								?>
									<img src="<?php echo bloginfo( 'template_url' ); ?>/inc/img/ASN_tile_bg_405x400.png" class="placeholder-image">
								<?php	
								}
									
							} else {

								if (has_post_thumbnail()) {
									the_post_thumbnail('sparkling-img-320x400');
								} else {
								?>
									<img src="<?php echo bloginfo( 'template_url' ); ?>/inc/img/ASN_tile_bg_320x400.png" class="placeholder-image">
								<?php
								}
								
							}?>
							</a>
						</div>
						<div class="post-summary">
							<div class="time_stamp"><small><?php the_time('F jS, Y'); ?></small></div>
							<div class="tile_title">
								<?php //echo $cats ?>
								<?php if (($cat_name) == "Video"){ ?>
									<h2 class="v_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<div class="video_link"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo bloginfo( 'template_url' ); ?>/inc/img/asn_play_60x60.png" /></a></div>
								<?php } else { ?>
									<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

			<?php endwhile; else : ?>
				
			</div>
		</div>
		<?php endif; ?></div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
