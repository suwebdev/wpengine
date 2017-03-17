<?php
// Redirect to webnus welcome page
if ( is_admin() ){
    include_once get_template_directory(). '/inc/webnus-admin-welcome/index.php';
    include_once get_template_directory(). '/inc/auto-update/envato.php';
}

// Include theme update functions
include_once get_template_directory() . '/inc/webnus-admin-welcome/webnus-update-functions.php';

if ( !class_exists( 'ReduxFramework' ) )
    include_once get_template_directory() . '/inc/theme-options/ReduxCore/framework.php';

if ( !isset( $michigan_webnus_options ) ) :
    include_once get_template_directory() . '/inc/theme-options/webnus-options/webnus-options.php';
    include_once get_template_directory() . '/inc/theme-options/extensions/wbc_importer/webnus-wbc-configs.php';
    include_once get_template_directory() . '/inc/theme-options/extensions/wbc_importer/webnus-prevent-duplicated-menus.php';
endif;

include_once get_template_directory() . '/inc/customizer/customizer.php';
include_once get_template_directory() . '/inc/editor/nc-sc.php';
include_once get_template_directory() . '/inc/widgets/widgets-init.php';
include_once get_template_directory() . '/inc/helpers/breadcrumbs.php';
include_once get_template_directory() . '/inc/helpers/cat-field.php';
include_once get_template_directory() . '/inc/helpers/live-search.php';
include_once get_template_directory() . '/inc/helpers/get-the-image.php';
include_once get_template_directory() . '/inc/helpers/show-ids.php';

include_once get_template_directory() . '/inc/plugins/woocommerce/index.php';
include_once get_template_directory() . '/inc/plugins/plugin-activator/init.php';
include_once get_template_directory() . '/inc/plugins/taxonomy-icons/taxonomy-icons.php';
include_once get_template_directory() . '/inc/plugins/sweet-custom-menu/sweet-custom-menu.php';

include_once get_template_directory() . '/inc/meta-box/meta-box.php';
include_once get_template_directory() . '/inc/meta-box/webnus-meta-box.php';