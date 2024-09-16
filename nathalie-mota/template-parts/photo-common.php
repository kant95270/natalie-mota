<?php

$current_post_id = get_the_ID(); // Obtient l'ID du post courant
$current_categories = get_the_terms($current_post_id, 'categorie'); // Utilisez 'categorie', votre taxonomie personnalisée

if (!empty($current_categories) && !is_wp_error($current_categories)) {
    // Prenez la première catégorie pour cet exemple
    $current_category = $current_categories[0];

    $args = array(
        'post_type' => 'photo', // Utilisez votre CPT 'photo'
        'posts_per_page' => 2, // Limite à 2 photos
        'post__not_in' => array($current_post_id), // Excluez la photo actuelle
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie', // Utilisez votre taxonomie personnalisée 'categorie'
                'field' => 'term_id',
                'terms' => $current_category->term_id,
            ),
        ),
    );

    $related_photos = new WP_Query($args);

    if ($related_photos->have_posts()) {
        while ($related_photos->have_posts()) {
            $related_photos->the_post();
?>
            <section class="publication">
                <div class="photo-grid-single-photo">
                    <div class="photo-item">
                        <h3 class="title-photo"><?php the_title(); ?></h3>
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'categorie');
                        $category_name = !empty($categories) ? esc_html($categories[0]->name) : '';
                        if (!empty($category_name)) {
                            echo '<h4 class="categorie-photo">' . $category_name . '</h4>';
                        }
                        the_post_thumbnail('large'); // Affiche l'image à la une
                        ?>
                        <a href="<?php the_permalink(); ?>" class="detail-photo-link">
                            <span class="detail-photo"></span>
                        </a>
                        <form>
                            <input type="hidden" name="postid" class="postid" value="<?php the_ID(); ?>">
                            <a href="<?php the_post_thumbnail_url('full'); ?>" class="openLightbox" title="Afficher la photo en plein écran" data-fancybox="gallery" data-caption="<?php echo esc_attr(get_the_title()) . (!empty($category_name) ? ' - ' . $category_name : ''); ?>" data-postid="<?php the_ID(); ?>" data-arrow="true">
                            </a>
                        </form>
                    </div>
                </div>
            </section>
<?php
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }
}