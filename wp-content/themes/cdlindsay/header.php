<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
  <meta name="author" content="Clinique Dentaire Lindsay">

  <link rel="manifest" href="/manifest.webmanifest">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WHNVH94');</script>
  <!-- End Google Tag Manager -->

  <?php wp_head(); ?>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
  <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WHNVH94"
          height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="header <?php echo(is_front_page() ? 'hero' : ''); ?>">
  <div class="header-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="<?php echo get_bloginfo('wpurl'); ?>">
          <img src="<?php bloginfo('template_url'); ?>/img/logo-centre-dentaire-lindsay.png" alt="logo-centre-dentaire-lindsay"/>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <?php wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'menu_class' => 'nav ml-auto',
            'container' => '',
            'walker' => new bootstrap_4_walker_nav_menu()
          )); ?>

          <a class="btn btn-outline-light phone d-sm-none" href="tel:819-477-2020"><i
                    class="fas fa-mobile-alt"></i></a>
        </div>
      </div>
    </nav>
  </div>

  <?php if (!is_front_page()): ?>
    <div class="container">
      <?php
      $title = '';

      if (is_single()) {
        $title = get_the_title();
      } else if (is_page()) {
        $title = get_the_title();
      } else if (is_archive()) {
        $title = post_type_archive_title('', false);
      } else if (is_category()) {
        $arr = get_the_category();

        if (!empty($arr)) {
          $title = esc_html($arr[0]->name);
        }
      }
      ?>

      <h1>
        <?php echo $title; ?>

        <?php if (function_exists('yoast_breadcrumb')) {
          yoast_breadcrumb('<small id="breadcrumbs">', '</small>');
        }
        ?>
      </h1>
    </div>
  <?php endif; ?>
</div>

<?php if (is_front_page()): ?>
  <div class="header-details">
    <div class="container">
      <div class="row">
        <div class="col-md">
          <h3>Heures d'ouverture</h3>
          <ul class="timetable">
            <li>Lundi - Mardi<strong>8:00 - 19:00</strong></li>
            <li>Mercredi <strong>8:00 - 17:00</strong></li>
            <li>Jeudi - Vendredi <strong>8:00 - 17:00</strong></li>
          </ul>
        </div>

        <div class="col-md">
          <h3>Prendre rendez-vous</h3>

          <p>Pour obtenir un rendez-vous au Centre dentaire Lindsay, vous pouvez nous téléphoner ou le prendre en ligne. Ensuite, vous recevrez une confirmation ou une proposition de rendez-vous.</p>

          <a class="btn btn-outline-primary" href="/cdlindsay/rendez-vous/">Contactez notre clinique dentaire</a>
        </div>

        <div class="col-md-12 col-lg">
          <h3>Urgences dentaires</h3>
          <h2><i class="fas fa-mobile-alt"></i> <a href="tel:819-477-2020">819 477-2020</a></h2>

          <p>Pour toutes urgences dentaires, merci de contacter le Centre dentaire Lindsay par téléphone.</p>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
