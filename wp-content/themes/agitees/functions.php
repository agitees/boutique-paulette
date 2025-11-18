<?php
/***************** Appeler fichiers de style CSS *****************/

if (!function_exists('agitees_theme_styles')) {
    function agitees_theme_styles() {
        // Tailwind CSS / Mode dev (commenter pour mise en ligne)
        wp_register_style('agitees-tailwindcss', get_template_directory_uri() . '/src/css/output.css', array(), '1.0', 'all');
        wp_enqueue_style('agitees-tailwindcss');
        /* Tailwind CSS / Mode prod (décommenter pour mise en ligne)
        wp_register_style('agitees-tailwindcss', get_template_directory_uri() . '/src/dist/output-min.css', array(), '1.0', 'all');
        wp_enqueue_style('agitees-tailwindcss'); */

        // Style de base
        wp_register_style('agitees-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all');
        wp_enqueue_style('agitees-style');
    }
}
add_action('wp_enqueue_scripts', 'agitees_theme_styles');


/***************** Créer un menu (navbar) *****************/

function new_menu() {
    register_nav_menu('menu',__( 'Menu de navigation' ));
  }
add_action( 'init', 'new_menu' );


// Désactiver la barre d'administration pour tous les utilisateurs
add_filter('show_admin_bar', '__return_false');


// Personnaliser connexion WordPress
function agitees_custom_login() {
    $logo = get_field('logo', 'option'); 

    if ($logo) { ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url('<?php echo esc_url($logo['url']); ?>');
                background-size: contain;
                width: 100%;
                height: 150px;
            }

            /* Bouton submit */
            body.login form input[type="submit"] {
                background-color: <?= esc_attr(get_field('bleu', 'option')); ?>;
                border-color: <?= esc_attr(get_field('bleu', 'option')); ?>;
                color: white;
            }

            body.login form input[type="submit"]:hover {
                background-color: white;
                color: <?= esc_attr(get_field('bleu', 'option')); ?>;
            }

            /* Lien */
            body.login a {
                color: <?= esc_attr(get_field('bleu', 'option')); ?>;
            }

            /* Icône oeil */
            body.login .dashicons {
                color: <?= esc_attr(get_field('bleu', 'option')); ?>;
            }

            body.login form input[type="text"]:focus,
            body.login form input[type="password"]:focus {
                border-color: <?= esc_attr(get_field('bleu_clair', 'option')); ?>;
                outline: none;
            }
        </style>
    <?php }
}
add_action('login_enqueue_scripts', 'agitees_custom_login');


/* Ajouter des fonts personnalisées
function custom_fonts() {
    ?>
    <style type="text/css">
        @font-face {
            font-family: 'fleuron';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/FleuronRegular.woff') format('woff'),
                 url('<?php echo get_template_directory_uri(); ?>/assets/fonts/FleuronRegular.otf') format('opentype');
            font-display: swap;
        }
    </style>
    <?php
}
add_action('wp_head', 'custom_fonts'); */


/* Désactiver Gutenberg editor
function disable_gutenberg($use_block_editor, $post) {
    // Désactiver Gutenberg pour tous sauf les articles
    if ('post' !== $post->post_type) {
        return false;
    }
    return $use_block_editor;
}
add_filter('use_block_editor_for_post', 'disable_gutenberg', 10, 2); */


/* Cacher des pages dans le back-office
function hide_specific_pages_from_admin($query) {
    if (is_admin() && $query->is_main_query() && $query->get('post_type') === 'page') {

        // Liste des IDs de pages à cacher
        $pages_to_hide = [472, 80, 253, 75, 125, 83, 334, 81, 343, 298];

        $query->set('post__not_in', $pages_to_hide);
    }
}
add_action('pre_get_posts', 'hide_specific_pages_from_admin'); */


/* Créer un CPT
function register_realisation_post_type() {
	
    $labels = array(
        'name' => 'Réalisations',
        'all_items' => 'Toutes les réalisations',
        'singular_name' => 'Réalisation',
        'add_new_item' => 'Ajouter une réalisation',
        'edit_item' => 'Modifier la réalisation',
        'menu_name' => 'Réalisations'
    );

	$args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor','thumbnail' ),
        'menu_position' => 5, 
        'menu_icon' => 'dashicons-admin-customizer',
	);

	register_post_type( 'realisations', $args );
}
add_action( 'init', 'register_realisation_post_type' ); */


/* Créer des tags (étiquettes) pour le CPT
function create_tag_taxonomies() 
{
  $labels = array(
    'name' => _x( 'Étiquettes', 'taxonomy general name' ),
    'singular_name' => _x( 'Étiquette', 'taxonomy singular name' ),
    'search_items' =>  __( 'Trouver des étiquettes' ),
    'popular_items' => __( 'Étiquettes populaires' ),
    'all_items' => __( 'Toutes les étiquettes' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Modifier' ), 
    'update_item' => __( 'Mettre à jour' ),
    'add_new_item' => __( 'Ajouter' ),
    'new_item_name' => __( 'Nouveau nom' ),
    'separate_items_with_commas' => __( 'Séparer avec des virgules' ),
    'add_or_remove_items' => __( 'Ajouter ou supprimer' ),
    'choose_from_most_used' => __( 'Choisir parmi les plus utilisées' ),
    'menu_name' => __( 'Étiquettes' ),
  ); 

  register_taxonomy('tag','realisations',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tag' ),
  ));
}
add_action( 'init', 'create_tag_taxonomies', 0 ); */


// Changer prix produits automatiquement au clique sur "Mettre à jour"
add_action('acf/save_post', function($post_id) {

    if(get_post_type($post_id) !== 'product') return;

    // Récupérer le prix saisi via champ ACF 'prix'
    $price = get_field('prix', $post_id);
    if(!$price) return;

    $product = wc_get_product($post_id);

    // Produit variable, appliquer le prix à toutes les variations
    if($product && $product->is_type('variable')) {
        $variations = $product->get_children();
        foreach($variations as $variation_id){
            $variation = wc_get_product($variation_id);
            if($variation){
                $variation->set_regular_price($price);
                $variation->set_sale_price(''); // supprimer promo si existante
                $variation->save();
            }
        }
    } else {
        // Produit simple
        $product->set_regular_price($price);
        $product->save();
    }

}, 20);