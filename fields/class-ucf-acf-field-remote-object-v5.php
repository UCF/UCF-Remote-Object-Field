<?php

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'UCF_ACF_Field_Remote_Object' ) ) {
    class UCF_ACF_Field_Remote_Object extends acf_field {
        /**
         * This function sets up the field type data
         * @author Jim Barnes
         * @since 1.0.0
         */
        function __construct( $settings ) {
            // The field type name
            $this->name = 'remote-object';

            // The field type label
            $this->label = __( 'Remote Object', 'ucf_remote_object' );

            // The field category
            $this->category = 'relational';

            // Default values
            $this->defaults = array(
                'remote_list_url'   => '',
                'remote_search_url' => '',
                'value_field_name'  => 'ID',
                'text_field_name'   => 'title'
            );

            // Translatable array of string that can be used from the javascript frontend.
            $this->l10n = array();

            $this->settings = $settings;

            parent::__construct();
        }

        /**
         * Creates the additional settings for the field.
         * @author Jim Barnes
         * @since 1.0.0
         * @param $field array The $field being edited.
         */
        function render_field_settings( $field ) {

            // Render the remote_list_url field
            acf_render_field_setting( $field, array(
                'label'        => __( 'Remote List URL', 'ucf_remote_object' ),
                'instructions' => __( 'The remote URL to use when no search query is provided.', 'ucf_remote_object' ),
                'type'         => 'url',
                'name'         => 'remote_list_url'
            ) );

            // Render the remote_search_url field
            acf_render_field_setting( $field, array(
                'label'        => __( 'Remote Search URL', 'ucf_remote_object' ),
                'instructions' => __( 'The remote URL to use when a search query is provided. The search query should be indicated with a %s.', 'ucf_remote_object' ),
                'type'         => 'url',
                'name'         => 'remote_search_url'
            ) );

            // Render the value_field_name field
            acf_render_field_setting( $field, array(
                'label'        => __( 'Value Field Name', 'ucf_remote_object' ),
                'instructions' => __( 'The name of the field that holds the object\'s value. This is the value you will use in your code.', 'ucf_remote_object' ),
                'type'         => 'text',
                'name'         => 'value_field_name'
            ) );

            // Render the text_field_name field
            acf_render_field_setting( $field, array(
                'label'        => __( 'Text Field Name', 'ucf_remote_object' ),
                'instructions' => __( 'The name of the field that holds the object\'s text. This is the value that will be displayed to the user in the admin screen.', 'ucf_remote_object' ),
                'type'         => 'text',
                'name'         => 'text_field_name'
            ) );
        }

        /**
         * Creates the HTML interface for the field.
         * @author Jim Barnes
         * @since 1.0.0
         * @param array $field The field array
         */
        function render_field( $field ) {
            /**
             * Review the data of the field
             * This will show what data is available
             */
            ?>
            <div class="acf-hidden">
                <input type="hidden" id="<?php echo $field['name']; ?>" name="<?php echo $field['key']; ?>" value="">
            </div>
            <div class="selection acf-cf">
                <div class="choices">
                    <ul class="acf-bl list"></ul>
                </div>
                <div class="values">
                    <ul class="acf-bl list">
                    <?php $remote_objs = array(); ?>
                    <?php foreach( $remote_objs as $remote_obj ) : ?>
                        <li>
                            <input type="hidden" name="<?php echo $field['name']; ?>[]" value="<?php echo esc_attr( $remote_obj->id ); ?>">
                            <span data-id="<?php echo esc_attr( $remote_obj->id ); ?>" class="acf-rel-item">
                                <?php echo esc_html( $remote_obj->title ); ?>
                                <a href="#" class="acf-icon -minus small dark" data-name="remote_item"></a>
                            </span>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <input type="text" class="" id="<?php echo $field['key']; ?>" name="<?php echo $field['key']; ?>">
            <?php
        }

        /**
         * This action is called in the admin_enqueue_scripts action on the edit screen.
         * @author Jim Barnes
         * @since 1.0.0
         */
        function input_admin_enqueue_scripts() {
            $url = $this->settings['url'];
            $version = $this->settings['version'];

            wp_register_script( 'ucf_remote_object_js', "{$url}static/js/field-api-relationship.js", array( 'acf-input' ), $version, true );
            wp_enqueue_script( 'ucf_remote_object_js' );
        }
    }

    new UCF_ACF_Field_Remote_Object( $this->settings );
}