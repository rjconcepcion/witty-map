<div class="wrap">
<h1>Witty Map</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'witty-map-settings-group' ); ?>
    <?php do_settings_sections( 'witty-map-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Google Map Api Key</th>
        <td>
            <input type="text" name="new_option_name" value="<?php //echo esc_attr( get_option('new_option_name') ); ?>" class="regular-text" />
            <p class="description">This is required to render the map, you can get the api key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">here</a>.</p>
        </td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Map Center</th>
        <td>
            <input type="text" name="some_other_option" value="<?php //echo esc_attr( get_option('some_other_option') ); ?>" />
            <p class="description">Must me latitude and longitude, format sample <b>latitude,longitude(14.7662827,121.0122801).<b></p>
        </td>
        </tr>


        <tr valign="top">
        <th scope="row">Zoom Level</th>
        <td><input type="number" name="some_other_option" value="<?php //echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
    
        <tr valign="top">
        <th scope="row">Draggable</th>
        <td><input type="checkbox"></td>
        </tr>

        <tr valign="top">
        <th scope="row">Double click zoom</th>
        <td><input type="checkbox"></td>
        </tr>

        <tr valign="top">
        <th scope="row">Zoom control</th>
        <td><input type="checkbox"></td>
        </tr>

        <tr valign="top">
        <th scope="row">Scroll wheel</th>
        <td><input type="checkbox"></td>
        </tr>

        <tr valign="top">
        <th scope="row">Street view control</th>
        <td><input type="checkbox"></td>
        </tr>

    </table>
    
    <?php submit_button(); ?>

</form>
</div>