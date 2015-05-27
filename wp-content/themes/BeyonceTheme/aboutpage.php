<?php 
/*
Template Name: About
*/
get_header() ?>

<main id="about" class="clearfix">
	<section id="heroImage">
			<h1>me</h1>
	</section>

	<section id="aboutSections">
		<div id="fullLayout">
			<div id="leftColumn">
				<div class="centerChildren" id="performer">
					<h2 class="childBlocks"><span id="performerSpan">performer</span></h2>
				</div>
				<div class="centerChildren" id="vocalCoach">
					<h2 class="childBlocks"><span id="vocalSpan">vocal</span>
					<span id="coachSpan">coach</span></h2>
				</div>
				<div class="centerChildren" id="pianist">
					<h2 class="childBlocks"><span id="pianistSpan">pianist</span></h2>
				</div>
				<div class="centerChildren" id="musicDirector">
					<h2 class="childBlocks"><span id="musicSpan">music</span>
					<br>
					<span id="directorSpan">director</span></h2>
				</div>
			</div>
			<div id="rightColumn">
				<div class="centerChildren" id="headshots">
					<h2 class="childBlocks"><span id="headshotsSpan">headshots</span>
					<span id="photosSpan">&#38 photos</span></h2>
				</div>
				<div class="centerChildren" id="bio">
					<h2 class="childBlocks"><span id="bioSpan">bio</span></h2>
				</div>
				<div class="centerChildren" id="press">
					<h2 class="childBlocks"><span id="pressSpan">press</span></h2>
				</div>
			</div>
		</div>
	</section>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

</main>

<?php get_sidebar() ?>
<?php get_footer() ?>
