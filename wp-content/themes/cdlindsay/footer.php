<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <a href="/la-clinique/"><h5>La Clinique</h5></a>

        <?php
        $page = get_page_by_path('la-clinique');
        $args = array('child_of' => $page->ID, 'sort_column' => 'menu_order', 'sort_order' => 'ASC');
        $children = get_pages($args);
        $index = 0;
        ?>

        <ul class="nav flex-column">
          <?php foreach ($children as $child): ?>
            <li class="nav-item">
              <a class="nav-link"
                 href="/la-clinique/#tab-<?php echo $child->ID; ?>"><?php echo $child->post_title; ?></a>
            </li>

            <?php $index += 1; ?>
          <?php endforeach; ?>
        </ul>

      </div>

      <div class="col-md-2">
        <a href="/equipe/"><h5>Équipe</h5></a>

        <?php
        $args = array('post_type' => 'dentist', 'orderby' => 'menu_order', 'order' => 'ASC');
        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()): ?>
          <ul class="nav flex-column">
            <?php while ($query->have_posts()): ?>
              <?php $query->the_post(); ?>

              <li class="nav-item">
                <a class="nav-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </li>
            <?php endwhile; ?>
          </ul>

          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>

      <div class="col-md-2">
        <a href="/services/"><h5>Services</h5></a>

        <?php
        $args = array('post_type' => 'service', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => 3);
        $query = new WP_Query($args);
        ?>

        <?php if ($query->have_posts()): ?>
          <ul class="nav flex-column">
            <?php while ($query->have_posts()): ?>
              <?php $query->the_post(); ?>

              <li class="nav-item">
                <a class="nav-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </li>
            <?php endwhile; ?>

            <li class="nav-item">
              <a class="nav-link" href="/services/">Voir plus […]</a>
            </li>
          </ul>

          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>

      <div class="col-md-2">
        <h5>Autres</h5>

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="/rendez-vous/">Rendez-vous</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/faq/">FAQ</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/contact/">Contact</a>
          </li>
        </ul>
      </div>

      <div class="col-md-4">
        <a class="btn btn-lg btn-block btn-light" href="https://www.acdq.qc.ca" target="_blank" rel="noopener">
          <img data-src="<?php bloginfo('template_url'); ?>/img/logo-acdq.png"
               alt="Association des chirurgiens dentistes du Québec"/>
        </a>
        <a class="btn btn-lg btn-block btn-light" href="http://www.odq.qc.ca/" target="_blank" rel="noopener">
          <img data-src="<?php bloginfo('template_url'); ?>/img/logo-odq.gif" alt="Ordre des dentistes du Québec"/>
        </a>
      </div>

    </div>
  </div> <!-- container -->
</div>
<?php wp_footer(); ?>

<script>
  var $ = window.$ || jQuery;
  var $document = $(document);

  function animateHero() {
    var $header = $('.header.hero');
    var images = ['slider-01', 'slider-02', 'slider-03', 'slider-04', 'slider-05', 'slider-06', 'slider-07'];

    setTimeout(function () {
      $(images).each(function (i, img) {
        new Image().src = '/wp-content/themes/cdlindsay/img/' + img + '.png';
      });
    }, 4000);

    var i = 1;

    setInterval(function () {
      var img = images[(++i % images.length)];
      $header.css('background-image', 'url(/wp-content/themes/cdlindsay/img/' + img + '.png)');
    }, 10000);
  }

  function handleNewPatient() {
    $('#service').on('change', function (e) {
      $('.new-patient').toggleClass('d-none', $(this).val() !== 'Nettoyage/examen nouveau patient');
    })
  }

  $document.ready(function () {
    var $body = $('body');

    $document.on('scroll', function () {
      $body.toggleClass('scrolled', $document.scrollTop() > 0);
    });

    $('.header.hero').css('background-image', 'url(/wp-content/themes/cdlindsay/img/slider-01.png)');
    animateHero();
    handleNewPatient();

    $('img[data-src]').each(function () {
      $(this).attr('src', $(this).attr('data-src'));
    });
  });
</script>
</body>

</html>