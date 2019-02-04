<?php

// exit if directly accessed
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'UCF_ACF_Field_Remote_Object' ) ) {
    class UCF_ACF_Field_Remote_Object extends acf_field {
        // Class variables
        var $settings,
            $defaults;

        /**
         * Set the name and labels needed for actions/filters.
         * @author Jim Barnes
         * @since 1.0.0
         * @param array $settings The settings array.
         */
        function __construct( $settings ) {
            $this->name = 'remote_object';
            $this->label = 'Remote Object';
            $this->category = __( 'Remote', 'ucf_remote_object' );
            $this->defaults = array(

            );

            parent::construct();

            $this->settings = $settings;
        }

        /**
         * Creates extra options for the field.
         * @author Jim Barnes
         * @since 1.0.0
         * @param array $field The field array
         */
        function create_options( $field ) {
            // The key of the field is used for saving the data.
            $key = $field['name'];

        ?>
            <tr class="field_option field_option_<?php echo $this->name; ?>">
                <td class="label">
                    <label><?php _e( 'Remote List URL', 'ucf_remote_object' ); ?></label>
                    <p class="description"><?php _e( 'The URL to use when fetching results without a search string.' ); ?></p>
                </td>
                <td>
                    <?php
                        do_action( 'acf/create_field', array(
                            'type'    => 'text',
                            'name'    => 'fields[' . $key . .'][remote_list_url]',
                            'value'   => $field['remote_list_url']
                        ) );
                    ?>
                </td>
            </tr>
        <?php
        }
    }

    new UCF_ACF_Field_Remote_Object( $this->settings );
}