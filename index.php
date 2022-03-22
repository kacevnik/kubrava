<?php get_header() ?>

<header class="main_header">
		<div class="container">
			<div class="row slogan">
				<?php dynamic_sidebar( 'header_slogan_sidebar' ); ?>

				<div class="videoblock">
				<?php dynamic_sidebar('header_vieo_btn_sidebar'); ?>
				</div>
				<div class="clear"></div>
			</div>

			<div class="row row_status mobile-only">

			 <!-- Узнаем количество квадратных метров -->
			 <?php global $wpdb2;

				$meta_key = 'project__space';
				$counter=$wpdb->get_var($wpdb->prepare("SELECT sum(meta_value) FROM $wpdb->postmeta WHERE meta_key = %s", $meta_key));
				$counter_count=$wpdb->get_var($wpdb->prepare("SELECT COUNT(distinct meta_value) FROM $wpdb->postmeta WHERE meta_key = %s", $meta_key));
				// echo 'Всего проектов: '. $counter_count; выводит количество записей
				?>
	 
				<p class="status"><span class="counter"><?php echo number_format((float)$counter, 1, '.', '') ; ?></span>м<sup>2</sup> <br><?php _e( 'реализованных специалистами проектов', 's-a-ricci' ); ?></p>
			</div>
		</div>
	</header>
<aside class="text_layer">
	<div class="container">
		<div class="row">
		<?php	dynamic_sidebar('menu_slogan'); ?>
		</div>
	</div>
</aside>
	<!-- NAVIGATION CONTENT HTML -->
	<nav class="owl-theme blocknavigation">

		<?php wp_nav_menu( 
		array( 
		'theme_location' => 'main_menu',
		'fallback_cb'=> 'category_menu',
		'container' => 'ul',
		'menu_id' => 'nav',
		'menu_class' => 'navigation') 
		);
		?>
	</nav>	


	<!-- MAIN CONTENT HTML -->
<section class="main_content">
	<div class="container">
		<div class="row row_status">

		 <!-- Узнаем количество квадратных метров -->
		 <?php global $wpdb2;

			$meta_key = 'project__space';
			$counter=$wpdb->get_var($wpdb->prepare("SELECT sum(meta_value) FROM $wpdb->postmeta WHERE meta_key = %s", $meta_key));
			$counter_count=$wpdb->get_var($wpdb->prepare("SELECT COUNT(distinct meta_value) FROM $wpdb->postmeta WHERE meta_key = %s", $meta_key));
			// echo 'Всего проектов: '. $counter_count; выводит количество записей
			?>
 
			<p class="status"><span class="counter"><?php echo number_format((float)$counter, 1, '.', '') ; ?></span>м<sup>2</sup> <br><?php _e( 'реализованных специалистами проектов', 's-a-ricci' ); ?></p>
			
			<?php	dynamic_sidebar('go_to_all_category'); ?>

		</div>

		<?php
			$categories = get_terms( [
				'taxonomy'     => 'category',
				'type'         => 'post',
				'child_of'     => 0,
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'meta_query'    => array(
					array(
						'key'   => 'cat_main',
						'value' => 1,

					)
				)
			] );

			$catString = array();

			// if(is_user_logged_in()) {				
			// 	echo '<pre>';
			// 	print_r($categories);
			// 	echo '</pre>';
			// }
		?>


		<div class="row">
			<h3 class="mobile-only">Проекты</h3>

			<ul class="tabs_project_list">
				<li><a title="<?php _e( 'Все проекты', 's-a-ricci' ); ?>"><?php _e( 'Все', 's-a-ricci' ); ?></a></li>
				<?php foreach ( $categories as $cat_item ) { ?>
					<li><a title="<?= $cat_item->name; ?>"><?= $cat_item->name; ?></a></li>
					<?php $catString[] = $cat_item->term_id; ?>
				<?php } ?>
			</ul>

		<?php for ( $counter = 1; $counter <= count ( $categories ) + 1; $counter++ ) { ?>
			<div id="T<?= $counter; ?>" class="tabs_global tab_item"> 	<!-- Код вкладки №<?= $counter; ?> -->

			<!-- вывод постов компонентом	 -->
			<?php
				// параметры по умолчанию
				$args = array(
					'numberposts' => -1,
					'category'    => $counter === 1 ? $catString : $categories[$counter - 2]->term_id, // берем из родительской категории
					'orderby'     => 'date',
					'order'       => 'DESC',
					'post_type'   => 'post',
					'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
				);

				$postsArr = get_posts( $args );
				foreach ( $postsArr as $postArr ) { setup_postdata( $postArr );
			?>
				<!-- card -->
					<div class="tabs_container__item">
						<a href="<?= get_permalink( $postArr->ID ) ?>" rel="bookmark">
							<?php 
								if ( function_exists( 'add_theme_support' ) )
								 echo get_the_post_thumbnail( $postArr->ID, array( '','370' ), array( 'class' => 'item__thumbnail' ) ); 
								?>
								<h4><?= $postArr->post_title; ?></h4>
								<span class="item_city"><?= get_field( "project__adres", $postArr->ID ); ?></span>
								<span class="overley"></span>
						</a>
					</div>	<!-- end card -->
					<?php } ?>
					<!-- вывод окончен	 -->
					<div class="point_enter mobile-hidden"></div>	<!--Этот DIV является меткой для вставки кнопки-->	
			</div><!--End tabs container-->
			<div class="point_enter mobile-hidden"></div>	<!--Этот DIV является меткой для вставки кнопки-->	
		<?php } ?>
					
		</div><!--End row-->
		<div class="clear"></div>
	</div> <!-- container off -->
</section>

<section class="reviews">
	<div class="container">
		<div class="row row_reviews">
			<?php dynamic_sidebar( 'tabs_owner' ); ?>
		</div>
		<div class="row row_reviews_content">
			<div class="text_tab">
				<?php dynamic_sidebar( 'tab_video' ); ?>
			</div>
			<div class="text_tab"> 
				<div class="wrapper">
					<?php dynamic_sidebar( 'tab_reviews' ); ?>
				</div>	
			</div>
		</div>
	</div>
</section>

<?php get_sidebar(); ?>  

<?php get_footer();  ?>


