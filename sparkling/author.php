<?php get_header(); ?>

<div id="content" class="narrowcolumn">
<!-- This sets the $curauth variable -->
<?php
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<header class="page-header">
	<?php $realName = $curauth->first_name.' '.$curauth->last_name;?>
	<h1 class="page-title">About: <?php echo $realName  ?> </h1>
</header>
<div class="row author-section">
	<div class="col-lg-3">
		<!-- avatar -->
		<div class="avatar">
			<?php echo get_avatar(get_the_author_meta('ID') , '200'); ?>
		</div>
		<!-- end avatar -->
	</div>
	<div class="col-lg-7">
	    <dl>
	        <!-- <dt>Website</dt>
	        <dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd> -->
	        <dt>Profile:</dt>
	        <dd> <?php echo get_the_author_meta('description'); ?></dd>
	    </dl>   
	</div>
</div>
<div class="row author-section">
	<div class="col-lg-12">
		<header class="page-header">
			<h2 class="page-subtitle" >Recent Posts by: <?php echo $realName  ?></h2>
		</header>
		<ul>
			<!-- The Loop -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<li>
			    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a>,
			    <?php the_time('d M Y'); ?> in <?php the_category(' & ');?>
			</li>
			<?php endwhile; else: ?>
			<p><?php _e('No posts by this author.'); ?></p>
			<?php endif; ?>
			<!-- End Loop -->
		</ul>
	</div>
</div>
<?php 
$xyz = $curauth->user_login;
$lastname = $curauth->last_name;
$firstname = $curauth->first_name;
if (($firstname == "Mark") && ($lastname == "Adams") ){
	// echo $lastname = $curauth->last_name. 'xx';
	// echo $firstname = $curauth->first_name;
?>
<div class="row author-section">
	<div class="col-lg-12">
		<?php 
		// the query for Mar's Picks
		$the_query = new WP_Query( 'tag=marks-picks' ); ?>
		
		<?php if ( $the_query->have_posts() ) : ?>
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<header class="page-header">
			<h2 class="page-subtitle" ><?php the_title(); ?></h2>
			</header>
			<div class="author-content">
				<?php echo the_content(); ?>
			</div>
		<?php endwhile; ?>
		<!-- end of the loop -->
		<?php wp_reset_postdata(); ?>
		
		<?php else : ?>
			<header class="page-header">
			<h2 class="page-subtitle" >Mark's Picks</h2>
			</header>
			<div class="author-content">
				<p><?php _e( 'Sorry, no Mark\'s Picks at this time.' ); ?></p>
			</div>
			
		<?php endif; ?>
		
		
   	</div>
   </div>
<?php
}
?>
<?php get_sidebar( 'home' ); ?>

</div>
<?php get_sidebar('post'); ?>
<?php get_footer(); ?>