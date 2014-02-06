<?php
/**
 * Template Name: My Custom Front Page
 * Custom front-page.php template
 *
 * Used to display the homepage of your
 * WordPress site.
 *
 * @link http://themes.required.ch/?p=606
 */
 
get_header(); ?>
 
    <!-- Row for main content area -->
    <div id="content" class="row">
        <div id="main" class=" columns" role="main">
 
            <?php
                /**
                 * Check for the responsive slider plugin
                 */
                if ( class_exists( 'REQ_Orbit' ) ) : ?>
 
            <div class="home-slider">
				<?php echo do_shortcode('[lenslider id="8fb4a22cfd"]'); ?>
            	<hr>
            </div>
 
            <?php endif; ?>
           
<div class="featureslist">
	<div class="post-box three columns">
	
		<?php	
		$post_id = 36;
		$queried_post = get_post($post_id);
		$title = $queried_post->post_title;
		echo "<h3>" . $title . "</h3>";
		echo get_the_post_thumbnail($post_id);
		echo "<p>" . $queried_post->post_excerpt . "</p>";
		echo '<a class=" button [radius round]" href="/?page_id=36">Read More >> </a>';
		?>
	</div>
	<div class="post-box three columns">
		 <?php
		$post_id = 54;
		$queried_post = get_post($post_id);
		$title = $queried_post->post_title;
		echo get_the_post_thumbnail($post_id);
		echo "<h3>" . $title . "</h3>";
		echo "<p>" . $queried_post->post_excerpt . "</p>";
		echo '<a class=" button [radius round]" href="/?page_id=54">Read More >> </a>';
		?>
	</div>
	
	<div class="post-box three columns">
	
		 <?php
		$post_id = 33;
		$queried_post = get_post($post_id);
		$title = $queried_post->post_title;
		echo get_the_post_thumbnail($post_id);
		echo "<h3>" . $title . "</h3>";
		echo "<p>" . $queried_post->post_excerpt . "</p>";
		echo '<a class=" button [radius round]" href="/?page_id=33">Read More >> </a>';
		?>
	</div>
</div>
 
        </div><!-- /#main -->
 
    </div><!-- End Content row -->
 
<?php get_footer(); ?>