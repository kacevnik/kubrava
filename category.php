<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package S.A.Ricci
 */

get_header();
?>

	<!-- Breadcrumbs HTML -->
	<aside class="breadcrumbs">
	<div class="container">
		<div class="row">
		<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		</div>
	</div>
	<div class="clear"></div>
</aside>

<!-- MAIN CONTENT HTML -->
<section class="main_content">
	<div class="container">
		<div class="row row_status">
			<h1 class="topic"><?php _e( 'Реализованные проекты', 's-a-ricci' ); ?></h1>
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

		?>
		<div class="row">
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
				<div class="point_enter"></div>	<!--Этот DIV является меткой для вставки кнопки-->	
			</div><!--End tabs container-->
		<?php } ?>
					
		</div><!--End row-->
		<div class="clear"></div>
	</div> <!-- container off -->
</section>
 
<?php
get_footer();

