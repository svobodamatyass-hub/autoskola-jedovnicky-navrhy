<?php get_header(); ?>
<main id="main" class="wrap section-pad">
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <article <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </article>
    <?php endwhile; ?>
    <?php the_posts_navigation(); ?>
  <?php else : ?>
    <h1>Stránka nebyla nalezena</h1>
    <p>Požadovaný obsah není k dispozici.</p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
