<?php
// Incluez les fichiers nécessaires de WordPress pour utiliser WP_Query
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

$selected_category = $_POST['categorie'];

$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8
);

if (!empty($selected_category)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'categorie',
            'field'    => 'term_id',
            'terms'    => $selected_category,
        ),
    );
}

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();
    // Générez ici le HTML pour chaque photo
    endwhile;
    wp_reset_postdata();
else :
    echo 'Aucune photo trouvée.';
endif;

die(); // Important pour terminer correctement une requête AJAX dans WordPress