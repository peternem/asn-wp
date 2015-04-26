<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package sparkling
 */
?>
			</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
		</div><!-- close .row -->
	</div><!-- close .container -->
<!-- </div> --><!-- close .main-content -->

	<div id="footer-area">
		<div class="container-fluid footer-inner">
			<div class="row">
				<?php //get_sidebar( 'footer' ); ?>
				<?php sparkling_social(); ?>
			</div>
		</div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info container">
				<div class="row">
					
					<nav role="navigation" class="col-md-12">
						<?php sparkling_footer_links(); ?>
					</nav>
					
				</div>
				<div class="row">
					<div class="copyright col-md-12">
						<?php echo of_get_option( 'custom_footer_text', 'xxxsparkling' ); ?>
						<?php //sparkling_footer_info(); ?>
					</div>
				</div>
			</div><!-- .site-info -->
			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
		</footer><!-- #colophon -->
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>