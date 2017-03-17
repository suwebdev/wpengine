<?php
/** Add Colorpicker Field to "Add New Category" Form **/
function michigan_webnus_category_form_custom_field_add( $taxonomy ) {
?>

<div class="form-field">
    <label for="category_custom_color"><?php esc_html_e('Category Name Color','michigan'); ?></label>
    <input name="cat_meta[catBG]" class="my-color-field" type="text" value="" />
    <p class="description"><?php esc_html_e('Pick a Category Color','michigan'); ?></p>
</div>
<?php
}
add_action('category_add_form_fields', 'michigan_webnus_category_form_custom_field_add', 10 );

/** Add New Field To Category **/
function michigan_webnus_extra_category_fields( $tag ) {
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id" );	
?>
<tr class="form-field">
    <th scope="row" valign="top"><label for="meta-color"><?php esc_html_e('Category Name Color','michigan'); ?></label></th>
    <td>
        <div id="colorpicker">
            <input type="text" name="cat_meta[catBG]" class="my-color-field" value="<?php echo (isset($cat_meta['catBG'])) ? $cat_meta['catBG'] : '#fff'; ?>" />
        </div>
            <br />
        </td>
</tr>


<?php
}
add_action('category_edit_form_fields','michigan_webnus_extra_category_fields');

/** Save Category Meta **/
function michigan_webnus_save_extra_category_fileds( $term_id ) {

    if ( isset( $_POST['cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['cat_meta'][$key])){
                $cat_meta[$key] = $_POST['cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}
add_action ('edited_category', 'michigan_webnus_save_extra_category_fileds');
add_action('created_category', 'michigan_webnus_save_extra_category_fileds', 11, 1);


