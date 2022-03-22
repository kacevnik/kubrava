<?php
class Custom_Empty_Widget extends WP_Widget {

    // Регистрация виджета используя основной класс
    function __construct() {
        parent::__construct(
            'custom_empty_widget',
            'Empty Widget',
            array( 'description' => 'Чистый виджет без тегов для вставки в код' )
        );
    }

    /**
     * Админ-часть виджета
     *
     * @param array $instance сохраненные данные из настроек
     */
    function form( $instance ) {

        $input = $instance['input'] ?: '';

        ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'input' ); ?>">Вставка</label>
                <textarea id="<?php echo $this->get_field_id( 'input' ); ?>" name="<?php echo $this->get_field_name( 'input' ); ?>" class="widefat" rows="8"><?php echo $input; ?></textarea>
            </p>
            
        <?php
    }

    /**
     * Вывод виджета во Фронт-энде
     *
     * @param array $args     аргументы виджета.
     * @param array $instance сохраненные данные из настроек
     */
    public function widget( $args, $instance ) {

        $input = $instance['input'] ?: '';

        echo $input;
    }
    
}

// регистрация виджета в WordPress
function register_ml_simple_related_widget() {
    register_widget( 'Custom_Empty_Widget' );
}
add_action( 'widgets_init', 'register_ml_simple_related_widget' );
?>