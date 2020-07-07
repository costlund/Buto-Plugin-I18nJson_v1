function plugin_i18n_json_v1(){
  this.data = {i18n: null, path: '/i18n/json'};
  this.setPath = function(path){
    PluginI18nJson_v1.data.path = path;
  }
  this.i18n = function(str, data, replace){
    /**
     * If data is provided we skip ajax call.
     */
    if(data){
      eval('if(data["'+str+'"]){str = data["'+str+'"];}else{}');
    }
    /**
     * If i18n not set we make an ajax call.
     */
    if(!data && !PluginI18nJson_v1.data.i18n){
      $.ajax({
          url : PluginI18nJson_v1.data.path,
          type : "get",
          async: false,
          success : function(data) {
            PluginI18nJson_v1.data.i18n = JSON.parse(data);
          },
          error: function() {
          }
       });      
    }
    /**
     * Trying to translate.
     */
    if(!data && PluginI18nJson_v1.data.i18n){
      for(i=0;i<PluginI18nJson_v1.data.i18n.length;i++){
        if(PluginI18nJson_v1.data.i18n[i]['key']==str){
          return PluginI18nJson_v1.data.i18n[i]['value'];
        }
      }
    }
    /**
     * Replace
     */
    if(replace){
      for(var i=0;i<replace.length;i++){
        str = str.replace(replace[i].key, replace[i].value);
      }
    }
    /**
     *
     */
    return str;
  }
}
var PluginI18nJson_v1 = new plugin_i18n_json_v1();
