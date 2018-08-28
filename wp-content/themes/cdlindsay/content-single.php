<?php
$postType = get_post_type();
?>

<div class="row">
  <?php if ($postType == 'dentist'): ?>
    <div class="col-md-3">
      <?php $image = get_field('picture'); ?>
      <a href="<?php the_permalink(); ?>">
        <img class="w-100 rounded" src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>"/>
      </a>
    </div>

    <div class="col-md-9">
      <div class="contact-info">
        <small><?php the_field('role'); ?></small>
        <h5><?php the_title(); ?></h5>

        <a href="tel:<?php the_field('phone'); ?>"><i
                  class="fas fa-mobile-alt fa-fw"></i> <?php the_field('phone'); ?></a>
        <a href="mailto:<?php the_field('email'); ?>"><i
                  class="fas fa-envelope fa-fw"></i> <?php the_field('email'); ?></a>

      </div>
    </div>
  <?php endif; ?>

  <div class="col-md-12 page-content">
    <?php the_content(); ?>
  </div>
</div>