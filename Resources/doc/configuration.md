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

Assetic injections
------------------

To add libraries in your views, two ways are possible :

#### Use [AsseticInjectorBundle](https://github.com/Troopers/AsseticInjectorBundle)

Add AsseticInjectorBundle in your `composer.json`, and enable it in your `AppKernel.php`.

Then, add injector tag in your javascripts and stylesheets declaration :

```twig
{% stylesheets injector="alertify-library"
    '@AppBundle/Resources/public/css/custom.css'
%}
    <link rel="stylesheet" href="{{ asset_url }}" type="text/css" />
{% endstylesheets %}

{% javascripts injector="alertify-library"
    '@AppBundle/Resources/public/js/custom.js'
%}
    <script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

Replace `alertify-library` by the library you want to use.

This is the list of available injections :
- `alertify-toastr`
- `alertify-noty`
- `alertify-notie`
- `alertify-codrops-notification`
- `alertify-pushjs` - *only for javascripts injection*
- `foot` : Add confirm.js and alertify.js - *only for javascripts injection*

#### Add the library yourself

This is how embed libraries in your views without AsseticInjectorBundle :

- For **Toastr** :
```twig
{% stylesheets
    '@TroopersAlertifyBundle/Resources/public/toastr/css/toastr.css'
%}
    <link rel="stylesheet" href="{{ asset_url }}" type="text/css" />
{% endstylesheets %}

{% javascripts
    '@TroopersAlertifyBundle/Resources/public/toastr/js/toastr.js'
%}
    <script src="{{ asset_url }}"></script>
{% endjavascripts %}

```

- For **PushJs** :
```twig
{% javascripts
    '@TroopersAlertifyBundle/Resources/public/push.js/push.min.js'
%}
    <script src="{{ asset_url }}"></script>
{% endjavascripts %}

```

- For **noty** :
```twig
{% stylesheets
    '@TroopersAlertifyBundle/Resources/public/noty/css/jquery.noty.css'
%}
    <link rel="stylesheet" href="{{ asset_url }}" type="text/css" />
{% endstylesheets %}

{% javascripts
    '@TroopersAlertifyBundle/Resources/public/noty/js/jquery.noty.js'
%}
    <script src="{{ asset_url }}"></script>
{% endjavascripts %}

```

- For **notie** :
```twig
{% stylesheets
    '@TroopersAlertifyBundle/Resources/public/notie/notie.css'
%}
    <link rel="stylesheet" href="{{ asset_url }}" type="text/css" />
{% endstylesheets %}

{% javascripts
    '@TroopersAlertifyBundle/Resources/public/notie/notie.js'
%}
    <script src="{{ asset_url }}"></script>
{% endjavascripts %}

```

- For **Codrops notification**
```twig
{% stylesheets
    "@TroopersAlertifyBundle/Resources/public/codrops-notification/css/ns-default.css",
    "@TroopersAlertifyBundle/Resources/public/codrops-notification/css/ns-style-bar.css",
    "@TroopersAlertifyBundle/Resources/public/codrops-notification/css/ns-style-attached.css",
    "@TroopersAlertifyBundle/Resources/public/codrops-notification/css/ns-style-growl.css",
    "@TroopersAlertifyBundle/Resources/public/codrops-notification/css/ns-style-other.css"
%}
    <link rel="stylesheet" href="{{ asset_url }}" type="text/css" />
{% endstylesheets %}

{% javascripts
    "@TroopersAlertifyBundle/Resources/public/codrops-notification/js/classie.js",
    "@TroopersAlertifyBundle/Resources/public/codrops-notification/js/modernizr.custom.js",
    "@TroopersAlertifyBundle/Resources/public/codrops-notification/js/notificationFx.js"
%}
    <script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

