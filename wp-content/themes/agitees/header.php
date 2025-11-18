<style>
/* Couleurs du site
:root {
    --color-blue: <?php // echo esc_attr(get_field('bleu', 'option')); ?>;
    --color-yellow: <?php // echo esc_attr(get_field('jaune', 'option')); ?>;
    --color-pink: <?php // echo esc_attr(get_field('rose', 'option')); ?>;
} */
</style>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- ************* HEADER ************* -->
    <header class="relative overflow-y-hidden">
        <!-- Overlay -->
        <div class="absolute top-0 w-full h-190 bg-black/35 z-20"></div>

        <!-- Image de fond + titre centré -->
        <div class="relative top-0 h-190 w-full">
            <!-- Image -->
            <?php 
            $images = get_field('photos-header', 126); 
            if( $images ):
                $count = count($images);
            ?>

            <style>
            @keyframes slide {
                <?php
                $percent = 0;
                for($i=0; $i<$count; $i++):
                    $start = $percent;
                    $end = $percent + (100 / $count) - (100 / ($count*5));
                ?>
                    <?= round($start,2) ?>% { transform: translateX(-<?= ($i * 100 / $count) ?>%); }
                    <?= round($end,2) ?>%   { transform: translateX(-<?= ($i * 100 / $count) ?>%); }
                <?php
                    $percent += 100 / $count;
                endfor;
                ?>
                100% { transform: translateX(0); }
            }

            .carousel {
                display: flex;
                width: <?= $count*100 ?>%;
                height: 100%;
                animation: slide <?= $count*5 ?>s infinite ease-in-out;
            }
            .slide {
                flex-shrink: 0;
                width: <?= 100/$count ?>%;
                height: 100%;
            }
            </style>

            <div class="relative h-screen w-full overflow-hidden z-10">
                <div class="carousel">
                    <?php foreach($images as $image): ?>
                        <div class="slide">
                            <img src="<?= esc_url($image['url']); ?>" 
                                alt="<?= esc_attr($image['alt']); ?>" 
                                class="w-full h-full object-cover" />
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php endif; ?>

            <!-- Titre centré -->
            <div class="absolute inset-0 flex flex-col items-center justify-center z-40">
                <h1 class="text-white text-4xl font-semibold text-center drop-shadow-lg w-120 max-xl:w-full leading-12">
                    Nouveautés disponibles dans notre catalogue
                </h1>
                <a href="#" class="mt-5 text-white border-2 border-white px-8 py-2 font-bolder hover:bg-white hover:text-black max-xl:text-2xl">Découvrir</a>
            </div>
        </div>

        <!-- Navbar -->
        <?php get_template_part('template_parts/navbar'); ?>

    </header>
    <!-- ************* FIN HEADER ************* -->