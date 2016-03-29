<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _tk
 */
?>
<div class="question col-md-3 col-sm-4 col-xs-10">
	<?php
	$post_id = 42;
	$quest_title = get_post_meta( $post_id, 'quest_title', true );
	$quest_text_field = get_post_meta( $post_id, 'quest_text_field', true );
	$quest_text_area_field = get_post_meta( $post_id, 'quest_text_area_field', true );
	?>
	<h4 class="quest-title" style="background-color: #<?php echo get_post_meta( '44', 'help_title_color', true ); ?>; color: #<?php echo get_post_meta( '44', 'help_text_color', true ); ?>;" ><?php echo $quest_title; ?> <i class="fa fa-times"></i></h4>

	<div class="quest-text">
		<form method="post" id="quest">
			<input type="email" class="email" required placeholder="<?php echo $quest_text_field; ?>">
			<textarea name="message" id="message" required rows="7" placeholder="<?php echo $quest_text_area_field; ?>"
			          class="message"></textarea>
			<input type="submit" class="btn btn-primary btn-md send" style="background-color: #<?php echo get_post_meta( '44', 'help_title_color', true ); ?>; color: #<?php echo get_post_meta( '44', 'help_text_color', true ); ?>;" value="Отправить">
		</form>
	</div>
</div>
</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
</div><!-- close .row -->
</div><!-- close .container -->
</div><!-- close .main-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container">
		<div class="row">
			<div class="site-footer-inner col-sm-12">

				<div class="site-info">
					<?php do_action( '_tk_credits' ); ?>
					<a href="http://wordpress.org/"
					   title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', '_tk' ); ?>"
					   rel="generator"><?php printf( __( 'Proudly powered by %s', '_tk' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<a class="credits" href="http://themekraft.com/" target="_blank"
					   title="Themes and Plugins developed by Themekraft"
					   alt="Themes and Plugins developed by Themekraft"><?php _e( 'Themes and Plugins developed by Themekraft.', '_tk' ) ?> </a>
				</div>
				<!-- close .site-info -->

			</div>
		</div>
	</div>
	<!-- close .container -->
</footer><!-- close #colophon -->

<?php wp_footer(); ?>

</body>
</html>
