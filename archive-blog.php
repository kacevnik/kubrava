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
	<h1><? _e( 'Блог', 's-a-ricci' ); ?></h1>
		<div class="blog_description">
		<?php dynamic_sidebar('blog_description_area'); ?>
		</div>
		<?php
			$categories = get_terms( [
				'taxonomy'     => 'blogcat',
				'type'         => 'blog',
				'child_of'     => 0,
				'hide_empty'   => 1,
				'hierarchical' => 1,
			] );

		?>
		<div class="row">
			<ul class="tabs_project_list">
				<li><a title="<?php _e( 'Все', 's-a-ricci' ); ?>"><?php _e( 'Все', 's-a-ricci' ); ?></a></li>
				<?php foreach ( $categories as $cat_item ) { ?>
					<li><a title="<?= $cat_item->name; ?>"><?= $cat_item->name; ?></a></li>
				<?php } ?>
			</ul>

		<?php for ( $counter = 1; $counter <= count ( $categories ) + 1; $counter++ ) { ?>
			<div id="T<?= $counter; ?>" class="tabs_global tab_item"> 	<!-- Код вкладки №<?= $counter; ?> -->

			<!-- вывод постов компонентом	 -->
			<?php
				// параметры по умолчанию
				$args = array(
					'numberposts' => -1,
					'orderby'     => 'date',
					'order'       => 'DESC',
					'post_type'   => 'blog',
					'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
				);

				if ( $counter !== 1 ) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'blogcat',
							'field'    => 'id',
							'terms'    => $categories[$counter - 2]->term_id,
						)
					);
				}

				$postsArr = get_posts( $args );
				foreach ( $postsArr as $postArr ) { setup_postdata( $postArr );
			?>
				<!-- card -->
					<div class="tabs_container__item" style="display: block;">
						<a href="<?= get_permalink( $postArr->ID ) ?>" rel="bookmark">
							<?php 
								if ( function_exists( 'add_theme_support' ) )
								 echo get_the_post_thumbnail( $postArr->ID, array( '','370' ), array( 'class' => 'item__thumbnail' ) ); 
								?>
								<h4><?= $postArr->post_title; ?></h4>
								<span class="item_city"><?php the_field( "project__adres" ); ?></span>
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
get_sidebar();
get_footer();

