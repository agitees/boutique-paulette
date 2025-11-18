<?php get_header(); ?>

    <!-- ////////////////////// NOUVEAUTES ////////////////////// -->
    <section id="first" class="my-20 flex flex-col items-center text-center">
        <h2 class="font-semibold text-4xl">Nouveaux arrivages</h2>

        <?php 
        // Query pour récupérer les 2 derniers produits
        $args = [
            'post_type' => 'product',
            'posts_per_page' => 2,
            'orderby' => 'date',
            'order' => 'DESC',
        ];
        $latest_products = new WP_Query($args);
        ?>

        <div class="flex max-xl:block max-xl:space-y-10 space-x-10 justify-center my-10">
            <?php if ( $latest_products->have_posts() ) : ?>
                <?php while ( $latest_products->have_posts() ) : $latest_products->the_post(); global $product; ?>
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>" 
                            alt="<?php the_title(); ?>" 
                            class="w-150 h-70 object-cover" />
                    </a>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <p>Aucun produit disponible pour le moment.</p>
            <?php endif; ?>
        </div>

        <p class="text-xl w-200 max-xl:w-full max-xl:px-5 text-center">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam.
        </p>

        <!-- Bouton centré et largeur auto -->
        <a href="<?php echo wc_get_page_permalink('shop'); ?>" 
        class="mt-5 inline-block text-black border-2 border-black px-8 py-2 font-semibold hover:bg-black hover:text-white max-xl:text-2xl">
            Voir les produits
        </a>
    </section>


    <!-- ////////////////////// CATALOGUE ////////////////////// -->
    <section id="second" class="my-20 flex flex-col items-center text-center">
        <h2 class="font-semibold text-4xl mb-10">Nos produits</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <?php 
            $args = [
                'post_type' => 'product',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
            ];
            $products = new WP_Query($args);

            if($products->have_posts()):
                while($products->have_posts()): $products->the_post();
                    global $product;

                    $all_sizes = [];
                    $colors_data = [];

                    if($product->is_type('variable')){
                        foreach($product->get_available_variations() as $v){
                            $variation_obj = wc_get_product($v['variation_id']);
                            $color_slug = $v['attributes']['attribute_pa_couleur'] ?? '';
                            $size       = $v['attributes']['attribute_pa_taille'] ?? '';

                            if($size){
                                $all_sizes[] = strtoupper($size);
                            }

                            // Récupérer le code hex via ACF
                            if ($color_slug && !isset($colors_data[$color_slug])) {
                                // Récupère l'objet terme
                                $term = get_term_by('slug', $color_slug, 'pa_couleur');
                                if ($term) {
                                    $hex = get_field('couleur', 'term_'.$term->term_id);
                                    $colors_data[$color_slug] = [
                                        'hex'  => $hex ?: '#000000',
                                        'link' => $product->get_permalink()
                                    ];
                                }
                            }
                        }
                        $all_sizes = array_unique($all_sizes);
                    }

                    $default_image = get_the_post_thumbnail_url($product->get_id(), 'medium');
            ?>

            <div class="group relative flex flex-col items-center">
                <div class="relative w-65 h-90 overflow-hidden">
                    <a href="<?= get_the_permalink(); ?>">
                        <img src="<?= esc_url($default_image) ?>" 
                            alt="<?= esc_attr(get_the_title()) ?>" 
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </a>

                    <?php if(!empty($colors_data)): ?>
                        <div class="absolute inset-0 bg-white/80 opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-4 z-10">
                            
                            <!-- Tailles -->
                            <?php if(!empty($all_sizes)): ?>
                            <div class="mb-3">
                                <h3 class="text-black font-semibold mb-2 uppercase">Tailles</h3>
                                <div class="flex justify-center space-x-2">
                                    <?php foreach($all_sizes as $size): ?>
                                        <a href="<?= get_the_permalink(); ?>" class="cursor-pointer border border-gray-400 px-3 py-1 text-sm hover:bg-black hover:text-white rounded"><?= esc_html($size) ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Couleurs -->
                            <div class="mb-3">
                                <h3 class="text-black font-semibold mb-2 uppercase">Couleurs</h3>
                                <div class="flex justify-center space-x-2">
                                    <?php foreach($colors_data as $color_name => $data): ?>
                                        <a href="<?= esc_url($data['link']); ?>" title="<?= esc_attr($color_name); ?>">
                                            <span class="w-10 h-10 rounded-full border border-gray-300 cursor-pointer hover:ring-2 hover:ring-black" 
                                                style="display:inline-block; background-color: <?= esc_attr($data['hex']); ?>;"></span>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>
                </div>

                <a href="<?= get_the_permalink(); ?>" class="mt-4 text-lg font-semibold"><?= get_the_title() ?></a>
                <p class="text-gray-600 mb-3"><?= $product->get_price_html() ?></p>

                <div class="flex items-center space-x-3">
                    <input type="number" min="1" value="1" class="w-16 border border-gray-300 rounded text-center py-2">
                    <a href="<?= esc_url($product->add_to_cart_url()); ?>" class="cursor-pointer border border-black bg-black text-white px-4 py-2 rounded hover:bg-white transition hover:text-black">Ajouter au panier</a>
                </div>
            </div>

            <?php 
                endwhile; 
                wp_reset_postdata();
            else: 
            ?>
                <p>Aucun produit disponible.</p>
            <?php endif; ?>
        </div>
    </section>

<?php get_footer(); ?>