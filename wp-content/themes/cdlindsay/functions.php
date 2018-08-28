<?php
//add_theme_support('amp');

add_action('init', 'register_cdlindsay_menu');
function register_cdlindsay_menu()
{
  register_nav_menu('header-menu', __('Header Menu'));
}

// WordPress Titles
add_theme_support('title-tag');

// Add stylesheets
add_action('wp_print_styles', 'cdlindsay_styles');
function cdlindsay_styles()
{
  wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', array(), '4.0.0');
  wp_enqueue_style('font_awesome', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css', array(), '5.0.6');
  wp_enqueue_style('cdlindsay', get_template_directory_uri() . '/style.css', array(), '0.0.3');
}

// Add scripts
add_action('wp_enqueue_scripts', 'cdlindsay_scripts');
function cdlindsay_scripts()
{
  wp_deregister_script('jquery');
  wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', array(), '3.2.1');
  wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array(), '4.0.0');
  wp_enqueue_script('infosign', 'https://www.infosignmedia.com/validator.js', array(), '1.0.0');
}

// Remove useless menus
add_action('admin_menu', 'remove_menus');
function remove_menus()
{
//    remove_menu_page('edit.php');                   //Posts
//    remove_menu_page('edit-comments.php');          //Comments
//    remove_menu_page('themes.php');                 //Appearance
//    remove_menu_page('plugins.php');                //Plugins
//    remove_menu_page('users.php');                  //Users
//    remove_menu_page('tools.php');                  //Tools
//    remove_menu_page('options-general.php');        //Settings
}

// Order custom items
add_filter('posts_orderby', 'custom_post_order');
function custom_post_order($orderby)
{
  if (is_archive()) {
    return 'menu_order ASC';
  }

  return $orderby;
}

// Add custom post types
add_action('init', 'create_custom_posts');
function create_custom_posts()
{
  register_post_type('dentist',
    array(
      'labels' => array(
        'name' => __('Dentistes'),
        'singular_name' => __('Dentiste'),
        'add_new_item' => __('Ajouter un nouveau dentiste'),
        'edit_item' => __('Modifier le dentist'),
        'new_item' => __('Nouveau dentiste'),
        'view_item' => __('Voir le dentiste'),
        'view_items' => __('Voir les dentistes'),
        'search_items' => __('Chercher un dentiste'),
        'not_found' => __('Dentiste inconnu'),
        'all_items' => __('Tous les dentistes'),
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-id',
      'supports' => array(
        'title',
        'editor',
        'page-attributes',
      ),
      'rewrite' => array('slug' => 'equipe'),
    ));

  register_post_type('service',
    array(
      'labels' => array(
        'name' => __('Services'),
        'singular_name' => __('Service'),
        'add_new_item' => __('Ajouter un nouveau service'),
        'edit_item' => __('Modifier le service'),
        'new_item' => __('Nouveau service'),
        'view_item' => __('Voir le service'),
        'view_items' => __('Voir les services'),
        'search_items' => __('Chercher un service'),
        'not_found' => __('Service inconnu'),
        'all_items' => __('Tous les services'),
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 21,
      'menu_icon' => 'dashicons-clipboard',
      'supports' => array(
        'title',
        'editor',
        'page-attributes',
      ),
      'rewrite' => array('slug' => 'services'),
    ));

  register_post_type('faq',
    array(
      'labels' => array(
        'name' => __('FAQ'),
        'singular_name' => __('Question'),
        'add_new_item' => __('Ajouter une nouvelle question'),
        'edit_item' => __('Modifier la question'),
        'new_item' => __('Nouvelle question'),
        'view_item' => __('Voir la question'),
        'view_items' => __('Voir les questions'),
        'search_items' => __('Chercher une question'),
        'not_found' => __('Question introuvée'),
        'all_items' => __('Toutes les questions'),
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 22,
      'menu_icon' => 'dashicons-search',
      'supports' => array(
        'title',
        'editor',
        'page-attributes',
      )
    ));
}

// Nav Walker
class bootstrap_4_walker_nav_menu extends Walker_Nav_Menu
{
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    if (isset($args->item_spacing) && 'preserve' === $args->item_spacing) {
      $t = '\t';
    } else {
      $t = '';
    }

    if ($depth) {
      $indent = str_repeat($t, $depth);
    } else {
      $indent = '';
    }

    $css_class = array('nav-link');

    if (in_array('current-menu-item', $item->classes)) {
      $css_class[] = 'active';
    } else if (is_post_type_archive($item->post_name) || is_singular($item->post_name)) {
      $css_class[] = 'active';
    }

    if (!empty($id)) {
      $_current_page = get_post($id);


      if ($item->ID == $id || $_current_page && in_array($item->ID, $_current_page->ancestors)) {
        $css_class[] = 'active';
      }
    } elseif ($item->ID == get_option('page_for_posts')) {
      $css_class[] = 'active';
    }

    $css_classes = join(' ', apply_filters('nav_menu_css_class', array_filter($css_class), $item, $args, $depth));

    if ('' === $item->post_title) {
      /* translators: %d: ID of a post */
      $item->post_title = sprintf(__('#%d (no title)'), $item->ID);
    }

    $args->link_before = empty($args->link_before) ? '' : $args->link_before;
    $args->link_after = empty($args->link_after) ? '' : $args->link_after;

    $atts = array();
    $atts['href'] = $item->url;
    $atts['class'] = $css_classes;

    $atts = apply_filters('page_menu_link_attributes', $atts, $item, $depth, $args, $id);

    $attributes = '';
    foreach ($atts as $attr => $value) {
      if (!empty($value)) {
        $value = esc_attr($value);
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }

    $title = apply_filters('the_title', $item->title, $item->ID);
    $hidden = $title == 'Accueil' ? 'd-none d-xl-block' : '';

    $output .= $indent . sprintf(
        '<li class="nav-item %s"><a%s>%s%s%s</a>',
        $hidden,
        $attributes,
        $args->link_before,
        /** This filter is documented in wp-includes/post-template.php */
        apply_filters('nav_menu_item_title', $title, $item, $args, $depth),
        $args->link_after
      );

    if (!empty($args->show_date)) {
      if ('modified' == $args->show_date) {
        $time = $item->post_modified;
      } else {
        $time = $item->post_date;
      }

      $date_format = empty($args->date_format) ? '' : $args->date_format;
      $output .= ' ' . mysql2date($date_format, $time);
    }
  }
}