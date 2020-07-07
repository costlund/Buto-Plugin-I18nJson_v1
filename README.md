# Buto-Plugin-I18nJson_v1
Handle translations in Javascript via Ajax call. First call will load json data from your server address /i18n/json. Calls after that only check in json object.

## Default file
Default translation file is /theme/(theme path)/i18n. To change this one has to set path for plugin i18n/translate_v1.
```
plugin:
  i18n:
    translate_v1:
      settings:
        path: /plugin/invoice/invoice_v1/i18n
```

## Page
```
plugin_modules:
  i18n:
    plugin: 'i18n/json_v1'
```
To add more paths.
```
plugin_modules:
  i18n:
    plugin: 'i18n/json_v1'
    settings:
      path:
        - /plugin/(any path)/i18n
```

## Include in head
In html head tag.
```
type: widget
data:
  plugin: i18n/json_v1
  method: include
```

## Javascript
How to translate word Close.
```
PluginI18nJson_v1.i18n('Close')
```
One could also translate with a object. Check plugin i18n/file_to_object how to create objects from translation files.
```
PluginI18nJson_v1.i18n('Close', {'Close': 'Stäng'})
```

## Replace
Add replace param.
```
alert(PluginI18nJson_v1.i18n("This file is to large (?file_size)", PluginUploadFile.i18n, [{'key': '?file_size', 'value': file.size}]));
```
