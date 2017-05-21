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
                        $support->witty_template( 'inc', 'witty-field-common', [ 
                            'type'  =>  'text',
                            'name'  =>  'googlemapapi_key',
                            'value' =>  $googlemap_api, 
                            'attrb' =>  [
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
                        $support->witty_template( 'inc', 'witty-field-common', [ 
                            'type'  =>  'text',  
                            'name'  =>  'wittymap_loc',
                            'value' =>  $wittymap_loc, 
                            'attrb' =>  [
                                'id'    =>  'wittymap-center',
                                'class' =>  'regular-text'
                            ],
                        ] );
                    ?>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wittymap-center"><?php echo _x('Default Map Zoom','witty_map'); ?></label>
                </th>
                <td>
                    <?php 
                        $support->witty_template( 'inc', 'witty-field-common', [ 
                            'type'  =>  'number',
                            'name'  =>  'wittymap_def_zoom',
                            'value' =>  $wittymap_def_zoom, 
                            'attrb' =>  [
                                'id'    =>  'wittymap-center',
                                'class' =>  'regular-text'
                            ],
                        ] );
                    ?>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wittymap-center"><?php echo _x('Map Pointer','witty_map'); ?></label>
                </th>
                <td>
                    <div id="witty-pointer-wrap">
                        <img src="<?php echo $wittymap_marker; ?>">
                        <button data-what='set-marker'>SELECT IMAGE</button>
                        <?php 

                        $support->witty_template( 'inc', 'witty-field-common', [ 
                            'type'  =>  'hidden',
                            'name'  =>  'wittymap_marker',
                            'value' =>  $wittymap_marker
                        ] );

                        ?>
                        <a href="#" class="litle-close" data-what='remove-marker'>x</a>                   
                    </div>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wittymap-center"><?php echo _x('Draggable','witty_map'); ?></label>
                </th>
                <td>
                    <?php 

                    $support->witty_template( 'inc', 'witty-field-checkbox', [ 
                        'name'  =>  'wittymap_draggable',
                        'value' =>  $wittymap_draggable
                    ] );

                    ?> 
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wittymap-center"><?php echo _x('Double click will zoom','witty_map'); ?></label>
                </th>
                <td>
                    <?php 

                    $support->witty_template( 'inc', 'witty-field-checkbox', [ 
                        'name'  =>  'wittymap_doubleClickZoom',
                        'value' =>  $wittymap_doubleClickZoom
                    ] );

                    ?> 
                </td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <label for="wittymap-center"><?php echo _x('Zoom Control','witty_map'); ?></label>
                </th>
                <td>
                    <?php 

                    $support->witty_template( 'inc', 'witty-field-checkbox', [ 
                        'name'  =>  'wittymap_zoomControl',
                        'value' =>  $wittymap_zoomControl
                    ] );

                    ?> 
                </td>
            </tr>


        </table>


        
        <?php submit_button(); ?>

    </form>
</div>