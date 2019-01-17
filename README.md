# Buto-Plugin-I18nJson_v1
Handle translations in Javascript via Ajax call.

First call will load json data from your server address /i18n/json. Calls after that only check in json object.

In theme settings.yml.
```
plugin_modules:
  i18n:
    plugin: 'i18n/json_v1'
```

```
plugin:
  i18n:
    json_v1:
      enabled: true
```


In html head tag.
```
-
  type: widget
  data:
    plugin: i18n/json_v1
    method: include
```

Javascript to translate.
```
PluginI18nJson_v1.i18n('Close')
```
