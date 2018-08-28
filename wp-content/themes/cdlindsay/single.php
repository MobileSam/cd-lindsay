<?php get_header(); ?>

<?php if (have_posts()): ?>
  <div class="section">
    <div class="container">
      <?php while (have_posts()): ?>
        <?php the_post(); ?>

        <?php get_template_part('content-single', get_post_format()); ?>
      <?php endwhile; ?>
    </div>
  </div>
<?php endif; ?>

<?php get_footer(); ?>