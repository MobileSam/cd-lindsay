<?php /* Template Name: Équipe */

get_header();

$args = array('post_type' => 'dentist', 'orderby' => 'menu_order', 'order' => 'ASC');
$query = new WP_Query($args);
?>

  <div class="contacts section white">
    <div class="container">
      <?php if (have_posts()): ?>
        <div class="row">
          <?php while (have_posts()): ?>
            <?php the_post(); ?>
            <?php get_template_part('content/contact-dentist'); ?>
          <?php endwhile; ?>
        </div>

        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>

<?php get_footer(); ?>