<?php
/**
 * Template Name: Двери в камин
 */
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<div class="entry-content-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php the_content(); ?>
			<form method="post" id="calc">
				<h3>С какой стороны необходимы петли?</h3>
				<p class="orientation"><input type="radio" id="left_orientation" class="petlya_orientation" name="petlya_orientation" value="left" checked><label
						for="left_orientation">С левой стороны</label></p>
				<p class="orientation"><input type="radio" id="right_orientation" class="petlya_orientation" name="petlya_orientation" value="right" ><label
						for="right_orientation">С правой стороны</label></p>
				<h3>Укажите ширину:</h3>
				<input type="number" class="width">
				<h3>Укажите высоту:</h3>
				<input type="number" class="height">

				<h3>Изделие будет иметь сложную форму (арка, криволинейная форма)?</h3>
				<p><input type="radio" id="hard_form" class="hard_form"  value="yes" checked><label
						for="hard_form">Прямоугольной формы</label></p>
				<p><input type="radio" id="not_hard_form" class="hard_form" value="no" ><label
						for="right_orientation">Сложной формы</label></p>

				<input type="submit" class="btn btn-primary btn-md send" style="background-color: #<?php echo get_post_meta( '44', 'help_title_color', true ); ?>; color: #<?php echo get_post_meta( '44', 'help_text_color', true ); ?>;" value="Отправить">
			</form>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->


<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>