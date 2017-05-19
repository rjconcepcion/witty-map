<div class="wrap">
    <h1><?php echo _x('Witty Map Settings', 'witty_map' ); ?></h1>

    <form method="post" action="options.php">

        <?php 
        /**
         * witty_map_backend
         *
         * @hooked option_page_before_form
         */
        do_action( "witty_map_after_form" );

        $support = new witty_support;

        ?>
        <table class="form-table">

            <tr valign="top">
                <th scope="row">
                    <label for="googlemapapi-key"><?php echo _x('Google map api key','witty_map'); ?></label>
                </th>
                <td>
                    <?php 
                        $support->witty_template( 'inc', 'witty-field-text', [ 
                            'name'  => 'googlemapapi_key', 
                            'value' => $googlemap_api, 
                            'attrb' => [
                                'id'    =>  'googlemapapi-key',
                                'class' =>  'regular-text'
                            ],
                        ] );
                    ?>
                </td>
            </tr>
        
            <tr valign="top">
                <th scope="row">
                    <label for="wittymap-center"><?php echo _x('Map Center','witty_map'); ?></label>
                </th>
                <td>
                    <?php 
                        $support->witty_template( 'inc', 'witty-field-text', [ 
                            'name'  => 'wittymap_loc', 
                            'value' => $wittymap_loc, 
                            'attrb' => [
                                'id'    =>  'wittymap-center',
                                'class' =>  'regular-text'
                            ],
                        ] );
                    ?>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wittymap-center"><?php echo _x('Set Image as Marker','witty_map'); ?></label>
                </th>
                <td>
                    <img class="header_logo" src="<?php echo get_option('header_logo'); ?>" height="75" width="75"/>
                    <button>BROWSE IMAGE</button>
                </td>
            </tr>


            <tr valign="top">
                <th scope="row">
                    <label for="wittymap-center"><?php echo _x('Default Map Zoom','witty_map'); ?></label>
                </th>
                <td>
                    <?php 
                        $support->witty_template( 'inc', 'witty-field-num', [ 
                            'name'  => 'wittymap_def_zoom', 
                            'value' => $wittymap_def_zoom, 
                            'attrb' => [
                                'id'    =>  'wittymap-center',
                                'class' =>  'regular-text'
                            ],
                        ] );
                    ?>
                </td>
            </tr>

        </table>


        
        <?php submit_button(); ?>

    </form>
</div>