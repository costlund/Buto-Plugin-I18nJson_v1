<?php
/**
 * Get json from yml language file.
 * An ajax request will be fired on first translation request only. There after it will only check in json object. 
 * Include widget in layout head section.
 * Settings:
    plugin_modules:
      i18n:
        plugin: 'i18n/json_v1'
    plugin:
      i18n:
        json_v1:
          enabled: true
 * Javascript:
    alert(PluginI18nJson_v1.i18n('Text to translate'))
 */
class PluginI18nJson_v1{
  /**
   * Include javascript library. 
   */
  public static function widget_include(){
    $element = array();
    wfPlugin::enable('include/js');
    $element[] = wfDocument::createWidget('include/js', 'include', array('src' => '/plugin/i18n/json_v1/PluginI18nJson_v1.js'));    
    wfDocument::renderElement($element);
  }
  /**
   * Json to load from javascript.
   */
  public static function page_json(){
    /**
     * Path to translations files.
     */
    $path = '/theme/[theme]/i18n';
    /**
     * Check if path is changed via theme settings file.
     */
    $settings = wfPlugin::getPluginSettings('i18n/translate_v1', true);
    if($settings && $settings->get('settings/path')){
      $path = $settings->get('settings/path');
    }
    /**
     * Retreive language.
     */
    $language = wfI18n::getLanguage();
    $json = array();
    if($language){
      /**
       * Check from theme.
       */
      $filename = $path.'/'.$language.'.yml';
      if(wfFilesystem::fileExist(wfArray::get($GLOBALS, 'sys/app_dir').$filename)){
        $data = wfSettings::getSettings($filename);
        foreach ($data as $key => $value) {
          $json[] = array('key' => $key, 'value' => $value);
        }
      }
      /**
       * More paths.
       */
      $more_paths = wfPlugin::getModuleSettings(null, true);
      if($more_paths && $more_paths->get('path')){
        foreach ($more_paths->get('path') as $key => $value) {
          $filename = $value.'/'.$language.'.yml';
          if(wfFilesystem::fileExist(wfArray::get($GLOBALS, 'sys/app_dir').$filename)){
            $data = wfSettings::getSettings($filename);
            foreach ($data as $key => $value) {
              $json[] = array('key' => $key, 'value' => $value);
            }
          }
        }
      }
    }
    /**
     * 
     */
    $json = json_encode($json);
    exit($json);
  }
}