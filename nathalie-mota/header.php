<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nathalie_mota
 */

 ?>
 <!doctype html>
 <html <?php language_attributes(); ?>>
 
 <head>
	 <meta charset="<?php bloginfo('charset'); ?>">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta name="description" content="Nathalie Mota - Site personnel pour la vente de mes photos en impression HD.">
	 <link rel="profile" href="https://gmpg.org/xfn/11">

 
	 <?php wp_head(); ?>
 </head>
 
 <body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'nathalie-mota'); ?></a>
		<header id="header" class="header flexrow">
			<div class="container-header flexrow">
				<a href="<?php echo home_url('/'); ?>" aria-label="Page d'accueil de Nathalie Mota">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png" alt="Logo <?php echo bloginfo('name'); ?>">
				</a>
				<nav id="navigation">
					<?php
					// Affichage du menu main déclaré dans functions.php
					wp_nav_menu(array('theme_location' => 'header'));
					?>
					<button id="modal__burger" class="btn-modal" aria-label="Menu pour la version portable">
						<span class="line"></span>
						<span class="line"></span>
						<span class="line"></span>
					</button>

					<div id="modal__content" class="modal__content">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'header',
							)
						);
						?>
					</div>
				</nav>
			</div>
		</header>