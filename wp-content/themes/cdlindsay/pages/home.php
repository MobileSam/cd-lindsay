<?php /* Template Name: Home */

get_header();
?>

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


<?php
$args = array('post_type' => 'dentist', 'orderby' => 'menu_order', 'order' => 'ASC');
$query = new WP_Query($args);
?>

  <div class="contacts section white">
    <div class="container">
      <h3 class="separator">Dentistes</h3>

      <?php if ($query->have_posts()): ?>
        <div class="row">
          <?php while ($query->have_posts()): ?>
            <?php $query->the_post(); ?>
            <?php get_template_part('content/contact-dentist'); ?>
          <?php endwhile; ?>
        </div>

        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>

<?php get_footer(); ?>