<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nathalie_mota
 */

 ?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<ul class="footer">
			<div class="footer-container">
				<li class="item-footer">
					<a href="http://localhost:8888/nathalie-mota/mentions-legales/">Mentions légales</a>
				</li>
				<li class="item-footer">
					<a href="http://localhost:8888/nathalie-mota/vie-privee/">Vie privée</a>
				</li>
				<li class="item-footer">
					<span>Tous droits réservés</span>
				</li>
			</div>

		</ul>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<?php get_template_part('template-parts/modale-contact'); ?>
<?php wp_footer(); ?>

</body>

</html>