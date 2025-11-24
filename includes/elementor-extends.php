<?php
class Reading_Time extends \Elementor\Core\DynamicTags\Tag {
    public function get_name() {
        return 'frz_reading_time';
    }

    public function get_title() {
        return __('Reading Time', 'forazitech');
    }

    public function get_group() {
        return 'post';
    }

    public function get_categories() {
        return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
    }

    protected function register_controls() {
        $this->add_control(
            'words_per_minute',
            [
                'label' => __( 'Words Per Minute', 'forazitech' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 200,
            ]
        );
    }

    public function render() {
        $words_per_minute = $this->get_settings( 'words_per_minute' );
        $post_content = get_post_field( 'post_content', get_the_ID() );
        $word_count = str_word_count(strip_tags( $post_content ));
        echo ceil( $word_count / $words_per_minute );
    }
}
