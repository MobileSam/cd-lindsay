<div class="col-md-4">
  <div class="contact">
    <a href="<?php the_permalink(); ?>">
      <?php $image = get_field('picture'); ?>
      <img class="w-100" data-src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>"/>
    </a>

    <div class="contact-info">
      <a href="<?php the_permalink(); ?>">
        <small><?php the_field('role'); ?></small>
        <h5><?php the_title(); ?></h5>
      </a>

      <a href="tel:<?php the_field('phone'); ?>"><i
                class="fas fa-mobile-alt fa-fw"></i> <?php the_field('phone'); ?></a>
      <a href="mailto:<?php the_field('email'); ?>"><i
                class="fas fa-envelope fa-fw"></i> <?php the_field('email'); ?></a>
    </div>
  </div>
</div>