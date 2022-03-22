<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package S.A.Ricci
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php bloginfo('name'); ?> - <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
	<!-- <base href="/"> -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- Custom Browsers Color Start -->
	<meta name="theme-color" content="#2e3740">
<!-- Подключение стилей css вынесено в functions.php-->
	<?php wp_head(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body <?php body_class(); ?>>

	<?php if ( is_active_sidebar( 'top-message' ) ) { ?>
		<div class="site_message">
			<div class="container">
				<div class="site_message__wrap">
					<?php dynamic_sidebar( 'top-message' ); ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="mobile-only mobile-menu">
		<div class="mobile-menu_close"><img src="/doc/cancel.png" style="width:32px;" alt title></div>

		<a class="call_to_phone" href="tel:+7(495)241-22-71">+7 (495) 241-22-71</a>

		<?php
			wp_nav_menu( array(
				'theme_location' => 'main-menu',
			)
		);
		?>

		<div class="social_links">
            <?php	dynamic_sidebar('social_form_widget'); ?>
		</div>
		<a class="topmail" href="mailto:info@kubrava.com"><img src="/wp-content/themes/s-a-ricci/img/mail_mobi.svg" alt="mailsvg"></a>
	</div>

	<!-- HeaderHTML -->
	<div class="header_top">
		<div class="container">
			<div class="logo">
				<a href="<?= get_home_url(); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
					<img src="<?= get_template_directory_uri(); ?>/img/logo-kubrava.png" alt="<?php bloginfo( 'name' ); ?>">
				</a>
			</div>
			<nav class="main_navigation">

			<?php
				wp_nav_menu( array(
					'theme_location' => 'main-menu',
				)
			);
			?>
			</nav>
			<div class="row row_buttons">
				<!-- вывод виджета кнопок -->
				<?php dynamic_sidebar('header_buttons_sidebar'); ?>
			</div>

			<div class="hamburger mobile-only">
				<img src="/doc/button_burger.png" style="width:58px;" alt title>
			</div>
		</div>
	</div>
