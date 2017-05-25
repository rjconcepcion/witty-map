<?php 
/**
 * Main View of witty map settings
 *
 * @version 1
 * @author Robert John Conepcion
 */
 $support = new witty_support;
?>
<div class="wrap">
    <h1>Witty Map Settings</h1>
    <form method="post" action="options.php">
        <?php 
        /**
         * witty_map_backend
         *
         * @hooked option_page_before_form
         */
        do_action( "witty_map_after_form" );
        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label>Short code</label>
                </th>
                <td>
                    <code>[witty-map]</code>
                     <p class="description">Use <code>[witty-map]</code> in content area and <code>echo do_shortcode("[witty-map]");</code> in your code.</p>
                </td>

            </tr>        
            <?php 
                foreach ($opt_arr as $key => $opt_val):
                    $support->witty_template( 'admin', 'witty-map-option-fields', [
                        'name'      =>  $key,            
                        'type'      =>  $opt_val['type'],
                        'value'     =>  $opt_val['value'],
                        'attrb'     =>  $opt_val['attrb'],
                        'template'  =>  $opt_val['template_name'],
                        'label'     =>  _x( $opt_val['label'] ,'witty_map'),
                        'desc'      =>  $opt_val['desc']             
                    ] );
                endforeach;
            ?>
        </table>
        <?php submit_button(); ?>
    </form>
</div>