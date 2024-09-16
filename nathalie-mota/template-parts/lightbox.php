<?php

/**
 * Modal lightbox
 *
 * @package WordPress
 * @subpackage nathalie-mota theme
 */

// Récupérer la taxonomie actuelle et le champs 
$terms_categorie = wp_get_post_terms(get_the_ID(), 'categorie');
$categorie = !empty($terms_categorie) ? esc_html($terms_categorie[0]->name) : 'Inconnue';

$terms_formats = wp_get_post_terms(get_the_ID(), 'formats');
$formats = !empty($terms_formats) ? esc_html($terms_formats[0]->name) : 'Inconnue';


?>
<?php the_post_thumbnail('lightbox'); ?>
<h2 class="photo-title-<?php the_id(); ?>"><?php the_title(); ?></h2>
<div class="lightbox__info flexrow">
    <p class="photo-category-<?php the_id(); ?>"><?php echo $categorie; ?></p>
    <p class="photo-year-<?php the_id(); ?>"><?php echo the_time('Y'); ?></p>
</div