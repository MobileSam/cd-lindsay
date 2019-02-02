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
      <h3 class="separator">Dentiste du Centre dentaire Lindsay</h3>

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

  <div class="contacts section">
    <div class="container">
      <h3 class="separator">Accessibilité pour les personnes à mobilité réduite</h3>

      <div class="row">
        <div class="col-md-12 page-content">
          <p>Parce que nous avons à coeur le bien-être de nos patients et l'accessibilité de nos services, notre clinique dentaire s'est nouvellement équipée d'un fauteuil lève-personne afin de vous aider dans l'ascension des escaliers qui mènent à nos bureaux. Il nous fera toujours plaisir de vous expliquer leur fonctionnement et de vous accompagner dans leur utilisation.</p>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>