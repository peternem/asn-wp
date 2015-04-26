<?php
/**
 * @package sparkling
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="post-inner-content">
		<header class="entry-header page-header">

			<h1 class="entry-title "><?php the_title(); ?></h1>

			<div class="entry-meta">
				<?php sparkling_posted_on(); ?>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'sparkling' ) );
					if ( $categories_list && sparkling_categorized_blog() ) :
				?>
				<span class="cat-links"><i class="fa fa-folder-open-o"></i>
					<?php printf( __( ' %1$s', 'sparkling' ), $categories_list ); ?>
				</span>
				<?php endif; // End if categories ?>
				<?php edit_post_link( __( 'Edit', 'sparkling' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>

			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		<?php the_post_thumbnail( 'sparkling-featured-post', array( 'class' => 'single-featured' )); ?>
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
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before'            => '<div class="page-links">'.__( 'Pages:', 'sparkling' ),
					'after'             => '</div>',
					'link_before'       => '<span>',
					'link_after'        => '</span>',
					'pagelink'          => '%',
					'echo'              => 1
	       		) );
	    	?>

		</div><!-- .entry-content -->

		<footer class="entry-meta">

	    	<?php if(has_tag()) : ?>
	      <!-- tags -->
	      <div class="tagcloud">

	          <?php
	              $tags = get_the_tags(get_the_ID());
	              foreach($tags as $tag){
	                  echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a> ';
	              } ?>

	      </div>
	      <!-- end tags -->
	      <?php endif; ?>

		</footer><!-- .entry-meta -->
	</div>
<div class="post-inner-content secondary-content-box">
<!-- author bio -->
<div class="row author-bio content-box-inner">
	<div class="col-lg-3">
			<!-- avatar -->
			<div class="avatar"></div>
				<?php echo get_avatar(get_the_author_meta('ID') , '200'); ?>
			
			<!-- end avatar -->
		</div>
		<div class="col-lg-9 author-bio-content">
			<h4 class="author-name"><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author_meta('display_name'); ?></a></h4>
			<p class="author-description">
			<?php echo get_the_author_meta('description'); ?>
			</p>
		</div>
</div>

<!-- end author bio -->
</div>
</article><!-- #post-## -->
