<?php 
// Logo 
$logo = get_field('logo', 'option');

class Tailwind_Walker_Mega_Menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        $has_children = in_array('menu-item-has-children', $item->classes);

        $output .= '<li class="relative ' . ($has_children ? 'group' : '') . '">';
        $output .= '<a href="' . esc_url($item->url) . '" class="px-2 py-1 inline-block ' .
            ($depth === 0 ? 'after:block after:h-0.5 after:bg-white after:absolute after:-bottom-0.5 after:left-0 after:w-0 group-hover:after:w-full after:transition-all after:duration-300' : '') .
            '">' . esc_html($item->title) . '</a>';
    }

    function start_lvl(&$output, $depth = 0, $args = []) {
        if ($depth === 0) {
            $output .= '<div class="absolute left-0 top-full mt-2 hidden group-hover:flex bg-white text-black shadow-lg p-6 w-[620px] justify-between z-50">';
            $output .= '<ul class="grid grid-cols-2 gap-6">';
        } else {
            $output .= '<ul class="absolute left-full top-0 hidden group-hover:block bg-white text-black rounded-lg shadow-lg w-48 p-3">';
        }
    }

    function end_lvl(&$output, $depth = 0, $args = []) {
        $output .= '</ul>';
        if ($depth === 0) {
            $output .= '</div>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = []) {
        $output .= '</li>';
    }
}
?>

<!-- ////////////////////// NAVBAR Desktop ////////////////////// -->
<nav class="absolute top-5 z-40 w-full">
    <div class="flex items-center justify-between px-12">
        <!-- Bloc gauche -->
        <div class="flex items-center justify-start w-1/3 ml-100">
            <i class="fa-solid fa-magnifying-glass text-white text-2xl"></i>
        </div>

        <!-- Logo centré -->
        <div class="flex justify-center w-1/3">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class="w-60 h-auto mx-auto">
            </a>
        </div>

        <!-- Bloc droit -->
        <div class="flex items-center justify-end space-x-4 w-1/3 text-white mr-100">
            <a href="#">Connexion</a>
            <i class="fa-solid fa-heart text-white text-2xl"></i>
            <i class="fa-solid fa-cart-shopping text-white text-2xl"></i>
        </div>
    </div>
    

    <!-- ************** MENU DE NAVIGATION ************** -->
    <div class="relative z-40 text-white uppercase flex justify-center mt-4">
        <?php 
        wp_nav_menu([
            'theme_location' => 'menu',
            'container'      => false,
            'menu_class'     => 'flex space-x-8 items-center',
            'walker'         => new Tailwind_Walker_Mega_Menu(),
        ]);
        ?>
    </div>
</nav>