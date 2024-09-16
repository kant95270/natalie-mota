<?php

// Récupérer la taxonomie actuelle
$terms_categorie = wp_get_post_terms(get_the_ID(), 'categorie');
$categorie = !empty($terms_categorie) ? esc_html($terms_categorie[0]->name) : 'Inconnue';

$terms_formats = wp_get_post_terms(get_the_ID(), 'formats');
$formats = !empty($terms_formats) ? esc_html($terms_formats[0]->name) : 'Inconnu';

$reference = get_field('reference');
$type = get_field('type');
$annee = get_field('annee');
?>

<article class="container__photo flexcolumn">
    <div class="photo__info flexrow">
        <div class="photo__info--description flexcolumn">
            <h2 class="title-single-photo"><?php the_title(); ?></h2>
            <ul class="flexcolumn">
                <!-- Affiche les données ACF -->
                <li>Référence :
                    <?php
                    if ($reference) {
                        echo $reference;
                    } else {
                        echo ('Inconnue');
                    }
                    ?>
                </li>
                <li>Catégorie :
                    <?php
                    if ($categorie) {
                        echo $categorie;
                    } else {
                        echo ('Inconnue');
                    }
                    ?>
                </li>
                <li>Formats :
                    <?php
                    if ($formats) {
                        echo $formats;
                    } else {
                        echo ('Inconnue');
                    }
                    ?>
                </li>
                <li>Type :
                    <?php
                    if ($type) {
                        echo $type;
                    } else {
                        echo ('Inconnue');
                    }
                    ?>
                </li>
                <li>Année :
                    <?php echo the_time('Y'); ?>
                </li>
            </ul>
        </div>
        <div class="photo__info--image flexcolumn">
            <div class="container--image brightness">
                <?php the_post_thumbnail('medium_large'); ?>
                <span class="openLightbox"></span>
            </div>
        </div>
    </div>
</article>