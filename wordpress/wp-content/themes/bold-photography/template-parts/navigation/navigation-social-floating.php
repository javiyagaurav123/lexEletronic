<?php if ( has_nav_menu( 'social-floating' ) ) :  ?>
		<div class="social-floating-navigation">
			<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Floating Social Menu', 'bold-photography' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location'  => 'social-floating',
						'menu_class'      => 'social-links-menu',
						'container'       => 'div',
						'container_class' => 'menu-social-container',
						'depth'           => 1,
						'link_before'     =>  bold_photography_get_svg( array( 'icon' => 'chain' ) ) . '<span>',
						'link_after'      => '</span>',
					) );
				?>
			</nav><!-- .social-navigation -->
		</div>	
<?php endif; ?>
