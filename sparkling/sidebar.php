<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package sparkling
 */
?>
</div>
	<div id="secondary" class="widget-area col-sm-12 col-md-4 col-lg-3" role="complementary">
		<?php sparkling_social(); ?>
		
		<div class="well">
			
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' )) : ?>

				<aside id="search" class="widget widget_search">
					<div class="content">
						<?php get_search_form(); ?>
					</div>
				</aside>

				<aside id="archives" class="widget">
					<div class="content">
						<h3 class="widget-title"><?php _e( 'Archives', 'sparkling' ); ?></h3>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</div>
				</aside>

				<aside id="meta" class="widget">
					<div class="content">
						<h3 class="widget-title"><?php _e( 'Meta', 'sparkling' ); ?></h3>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</div>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div>
	</div><!-- #secondary -->
