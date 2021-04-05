
	</div><!-- #main -->
	
	
	<?php if(! wp_is_mobile()): ?>
	
		<div id="toTop" class="wrap fixed"><a href="#masthead"><i class="fa fa-chevron-circle-up"></i></a></div>
	
	<?php endif; ?>
	
	<footer id="colophon" role="contentinfo">
	
		<nav id="site-info" class="footer-navigation">
			<?php
				$page_c	=	get_page_by_path('usces-cart');
				$page_m	=	get_page_by_path('usces-member');
				$pages	=	"{$page_c->ID},{$page_m->ID}";
				wp_nav_menu(array( 'theme_location' => 'footer', 'exclude' => $pages , 'menu_class' => 'footer-menu cf' )); 
			?>
		</nav>	
		
		<p class="copyright"><?php usces_copyright(); ?></p>
	
	</footer><!-- #colophon -->
	
	<?php wp_footer(); ?>
	</body>
</html>
