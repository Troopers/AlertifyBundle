Configuration
-------------

To define the default configuration of your alerts, you can add the following lines in your config.yml :

```yml
troopers_alertify:
    contexts:
        front:
            engine: "toastr"
            layout: "top-right"
            translationDomain: "messages"
        admin:
            engine: "myOwnSystem"
            layout: "bottomRight"
            translationDomain: "messages"
            options:
                background: rgb(99, 176, 205)
                anyOptionName: anyValue
```

By default, even if you do not declare any context, Alertify setup default values. You can override these settings easily like this:

 ```yml
troopers_alertify:
    default:
        context: app
        engine: noty
        layout: bottomLeft
        translationDomain: messages
    contexts:
    ...
```