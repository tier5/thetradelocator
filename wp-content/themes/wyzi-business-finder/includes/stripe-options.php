<?php
//**********Theme Options Page*************//

add_action("admin_menu", "add_theme_menu_item");

function add_theme_menu_item()

{
add_submenu_page("themes.php","General Theme Options","Set Stripe Options","manage_options","stripe_theme_options_page","theme_options_page");
}

function theme_options_page(){

?>

<div class="wrap">

<h1>Set Stripe Options</h1>

<form method="post" action="options.php" enctype="multipart/form-data">

<?php

settings_fields("section"); //settings_fields("$option_group");

do_settings_sections("theme-options"); //do_settings_sections( $page );

submit_button();

?>

</form>

</div>

<?php

}

//Activating Hook

add_action("admin_init", "display_theme_panel_fields");

function display_theme_panel_fields()

{

//add_settings_section( $id, $title, $callback, $page );

add_settings_section("section", "General Settings", null, "theme-options");

//register_setting( $option_group, $option_name, $sanitize_callback );
register_setting("section", "edit_check_mode");
register_setting("section", "edit_test_api_key");
register_setting("section", "edit_test_secret_key");
register_setting("section", "edit_live_api_key");
register_setting("section", "edit_live_secret_key");



//add_settings_field( $id, $title, $callback, $page, $section, $args );
add_settings_field("edit_check_mode", "Stripe Mode", "display_check_mode_element", "theme-options", "section");
add_settings_field("edit_test_api_key", "Stripe test key", "display_test_key_element", "theme-options", "section");
add_settings_field("edit_test_secret_key", "Stripe test secret key", "display_test_secret_key_element", "theme-options", "section");
add_settings_field("edit_live_api_key", "Stripe live key", "display_live_key_element", "theme-options", "section");
add_settings_field("edit_live_secret_key", "Stripe test secret key", "display_live_secret_key_element", "theme-options", "section");

}


//Functions to handle HTML

function display_check_mode_element()
{
?>
    <select name="edit_check_mode" id="edit_check_mode">

    	<option value="Test" <?php echo get_option("edit_check_mode") =="Test"? "selected":"";?>>Test</option>
    	<option value="Live" <?php echo get_option("edit_check_mode") =="Live"? "selected":""; ?>>Live</option>
    </select>
    
<?php
}

function display_test_key_element()
{
?>
    <input type="text" name="edit_test_api_key" style="width:600px;" id="edit_test_api_key" value="<?php echo get_option('edit_test_api_key'); ?> " />
    

<?php
}
function display_test_secret_key_element()
{
?>
    <input type="text" name="edit_test_secret_key" style="width:600px;" id="edit_test_secret_key" value="<?php echo get_option('edit_test_secret_key'); ?> " />
    

<?php
}
function display_live_key_element()
{
?>
    <input type="text" name="edit_live_api_key" style="width:600px;" id="edit_live_api_key" value="<?php echo get_option('edit_live_api_key'); ?> " />
    

<?php
}
function display_live_secret_key_element()
{
?>
    <input type="text" name="edit_live_secret_key" style="width:600px;" id="edit_live_secret_key" value="<?php echo get_option('edit_live_secret_key'); ?> " />
    

<?php
}
?>