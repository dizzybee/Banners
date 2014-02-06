<?php
/**
 * Template Name: For use with ram108 Plugin
 * Description: A Page Template without a sidebar
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.2.0
 */

get_header(); ?>

	<!-- Row for main content area -->
	<div id="content" class="row">

		<div id="main" class="twelve columns" role="main">

			<div class="post-box">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

						<?php echo do_shortcode('[fbalbum url="https://www.facebook.com/media/set/?set=a.'.$_GET['fbid'].'.'.$_GET['aid'].'.'.$_GET['id'].'=3" desc="1"]'); ?>
						<!--comments_template( '', true );-->

				<?php endwhile; // end of the loop. ?>

			</div>

		</div><!-- /#main -->

	</div><!-- End Content row -->

<?php get_footer(); ?>

