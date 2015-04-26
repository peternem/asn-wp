<?php
/**
 * Template Name: Schedule - Full Width Page
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
			<div class="post-inner-content hidden">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header page-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
				
					<div class="entry-content">
						<?php the_content(); ?>
						<?php
						wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'sparkling'), 'after' => '</div>', ));
						?>
					</div><!-- .entry-content -->
					<?php edit_post_link(__('Edit', 'sparkling'), '<footer class="entry-footer"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>'); ?>
				</article><!-- #post-## -->
			</div>
			<?php endwhile; ?>			
		</div><!-- #content -->
		<div class="asn-scheduler">
			<!-- <div class="row event-filter">
				<div class="col-md-12 filters">
					<h2>Sports Filter</h2>
				</div>
			</div> -->
			<div class="row event-filter">
				<div class="col-md-12 filters">
                    <nav class="navbar navbar-default">

                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">Schedule Filter</button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="allsports-selected" role="button" aria-expanded="false">All Sports <span class="caret"></span></a>
                                    <ul class="dropdown-menu " id="allsports" role="menu">
                                        <li><a href="#">All Sports</a></li>

                                        <li><a href="#">Baseball</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="allconferences-selected" role="button" aria-expanded="false">All Conferences<span class="caret"></span></a>
                                    <ul class="dropdown-menu" id="allconferences" role="menu">
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="allteams-selected" role="button" aria-expanded="false">All Teams <span class="caret"></span></a>
                                    <ul class="dropdown-menu" id="allteams" role="menu">
                                    </ul>
                                </li>
                                <li class="dropdown date">
                                    <div class="input-group input-group-sm date-pick">
                                        <input type="text" class="form-control" id="datepicker" placeholder="Select A Date" >
                                        <span class="input-group-btn">
                                            <button class="btn btn-default ui-datepicker-trigger" id="dateButton" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </li>
                                <li class="dropdown zip">
                                    <form class="navbar-form" role="search">
                                        <div class="input-group input-group-sm">
                                            <input id="zip-code" type="text" class="form-control" placeholder="by Zip Code..">
                                            <span class="input-group-btn">
                                                <button id="game-search" class="btn btn-default" type="button">Submit</button>
                                            </span>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </div>
            </div>
	

			<div id="games">

            </div>
		</div>
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
//get_sidebar();
get_footer();
