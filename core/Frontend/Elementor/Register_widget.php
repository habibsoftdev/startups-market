<?php 

namespace Startups\Market\Frontend\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

Class Register_widget extends Widget_Base{

    public function get_name() {
        return 'Register Form';
    }

    public function get_title() {
        return __('STM Registration Form', 'startups-market');
    }

    public function get_icon() {
        return 'fa fa-code';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        // Define the widget controls (e.g., form fields)
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'your-plugin'),
            ]
        );

        $this->add_control(
            'first_name',
            [
                'label' => __('First Name', 'your-plugin'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'last_name',
            [
                'label' => __('Last Name', 'your-plugin'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => __('Email', 'your-plugin'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => __('Phone Number', 'your-plugin'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        // Output the content of the widget (registration form)
        $settings = $this->get_settings_for_display();

        echo '<form>';
        echo '<div class="input-group">';
        echo '<div class="input-field" id="nameField">';
        echo '<input type="text" placeholder="First Name" value="' . esc_html($settings['first_name']) . '" required>';
        echo '</div>';
        echo '<div class="input-field">';
        echo '<input type="text" placeholder="Last Name" value="' . esc_html($settings['last_name']) . '" required>';
        echo '</div>';
        echo '<div class="input-field">';
        echo '<input type="email" placeholder="Email" value="' . esc_html($settings['email']) . '" required>';
        echo '</div>';
        echo '<div class="input-field">';
        echo '<input type="number" placeholder="Phone Number" value="' . esc_html($settings['phone_number']) . '" required>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
    }



}