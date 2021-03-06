<?php defined("ABSPATH") or die;

add_action('admin_menu',function(){
  add_submenu_page(
    'modularity',
    'Localized Strings',
    'Localized Strings',
    'manage_options',
    'localized-strings',
    'config_localized_strings_admin_page_callback'
  );
});

function config_localized_strings_admin_page_callback() {
  if(isset($_POST['localized-strings'])){
    update_option('localized-strings', json_encode($_POST['localized-strings']));
  }
  include 'feature-localized-strings.template.php';
}

function __ls($string,$locale = NULL){
  global $localized_strings;
  $locale = $locale ?: get_locale();
  if(!$localized_strings) {
    $localized_strings = json_decode(get_option('localized-strings'),true);
  }
  if(array_key_exists($string,$localized_strings) && array_key_exists($locale,$localized_strings[$string])){
    return $localized_strings[$string][$locale];
  } else {
    return $string;
  }
}
