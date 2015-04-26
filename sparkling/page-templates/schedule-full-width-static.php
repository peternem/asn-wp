<?php
/**
 * Template Name: Schedule - Full Width Page - Static Content
 *
 * @package Sparkling-ASN
 * @subpackage TSparkling-ASN
 *
 */

get_header();
 ?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();
			?>
			<div class="asn-scheduler">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="page-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
				
					<div class="entry-content">
						<?php the_content(); ?>
						<?php
						wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'sparkling'), 'after' => '</div>', ));
						?>
					</div><!-- .entry-content -->
					<?php edit_post_link(__('Edit', 'sparkling'), '<footer class="entry-footer clearfix"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>'); ?>
				</article><!-- #post-## -->
			</div>
			<?php endwhile; ?>			
		</div><!-- #content -->
		<div class="asn-scheduler">
			<div class="row item">
				<div class="col-md-12 zip-search-area">
					<h2>Search For TV Station</h2>
					<div id="zipcode-to-channel">
						<style>
							.hide { display: none;}
						</style>
						<p id='zipcode-to-channel-start'  class='zipcode-to-channel-panel'>
							Don't know your local ASN channel? Give us your zip code and we'll tell you.
						</p>
						<p id='zipcode-to-channel-success' class='zipcode-to-channel-panel hide' >
							Watch ASN on <span id="zipcode-to-channel-channel">your local channel</span>
						</p>
						<p id='zipcode-to-channel-error'  class='zipcode-to-channel-panel hide' >
							Sorry, your Zipcode was not found.
						</p>
						<input id="zipcode-to-channel-input" type="text" placeholder="11111"></input>
						<button id="zipcode-to-channel-button" > submit </button> 
					</div>

				</div>
			</div>
			<div class="row item">
				<div class="col-md-12 scheduleTable">
					<div class="table-responsive">
					<?php
					
					$table = get_field( 'schedule_table' );
					
					if ( $table ) {
					
					    echo '<table class="table table-striped">';
					
					    if ( $table['header'] ) {
					
					        echo '<thead>';
					
					            echo '<tr>';
					
					                foreach ( $table['header'] as $th ) {
					
					                    echo '<th>';
					                        echo $th['c'];
					                    echo '</th>';
					                }
					
					            echo '</tr>';
					
					        echo '</thead>';
					    }
					
					    echo '<tbody>';
					
					        foreach ( $table['body'] as $tr ) {
					
					            echo '<tr>';
					
					                foreach ( $tr as $td ) {
					
					                    echo '<td>';
					                        echo $td['c'];
					                    echo '</td>';
					                }
					
					            echo '</tr>';
					        }
					
					    echo '</tbody>';
					
					echo '</table>';
					}
								
					?>					
					</div>
				</div>
			</div>

			<!-- <div class="row advert">
				<div class="col-md-12">
				</div>
			</div> -->
			<!-- <div class="row group-date">
				<div class="col-md-12">
					<span class="date">Monday- January 31, 2015</span>
				</div>
			</div>
			<div class="row item">
				<div class="col-md-12 sport">Men's Basketball</div>
				<div class="col-md-12 subitem">
					<div class="row">
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><span>University of Washington</span></div>
						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 logo"><img src="http://cdn-png.si.com/sites/default/files/teams/basketball/cbk/logos/bc_50.png"/></div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><span class="result">97 - 63</span></div>
						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 logo"><img src="http://cdn-png.si.com/sites/default/files/teams/basketball/cbk/logos/nd_50.png"/></div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><span>Washington State University</span></div>
					</div>	
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 tv">Final</div>
				<div class="col-xs-6 col-sm-6 col-md-6 upcoming">Watch Video</div>			
			</div> -->
		</div>
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
//get_sidebar();
get_footer();
