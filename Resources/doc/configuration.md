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

Assets injections
------------------

First, don't forget that the most of the available libraries here need jquery so you'll need to include it first.
To add libraries in your views, two ways are possible :

#### Classic way (recommended) (need `composer req symfony/asset`)

This is how embed libraries in your views without AsseticInjectorBundle :

- For **Toastr** :
```twig
{% block stylesheets %}
    <link rel="stylesheet" href="{{ asset('/bundles/troopersalertify/toastr/css/toastr.css') }}" type="text/css" />
{% endblock %}

{% block javascripts %}
    <script src="{{ asset('/bundles/troopersalertify/toastr/js/toastr.js') }}"></script>
{% endblock %}
```

- For **PushJs** :
```twig
{% block javascripts %}
    <script src="{{ asset('/bundles/troopersalertify/push.js/push.min.js') }}"></script>
{% endblock %}
```

- For **noty** :
```twig
{% block stylesheets %}
    <link rel="stylesheet" href="{{ asset('/bundles/troopersalertify/noty/css/jquery.noty.css') }}" type="text/css" />
{% endblock %}

{% block javascripts %}
    <script src="{{ asset('/bundles/troopersalertify/noty/js/jquery.noty.js') }}"></script>
{% endblock %}
```

- For **notie** :
```twig
{% block stylesheets %}
    <link rel="stylesheet" href="{{ asset('/bundles/troopersalertify/notie/notie.css') }}" type="text/css" />
{% endblock %}

{% block javascripts %}
    <script src="{{ asset('/bundles/troopersalertify/notie/notie.js') }}"></script>
{% endblock %}

```

- For **Codrops notification**
```twig
{% block stylesheets %}
    <link rel="stylesheet" href="{{ asset('/bundles/troopersalertify/codrops-notification/css/ns-default.css') }}" type="text/css" />
    //and according to the choosed theme :
    <link rel="stylesheet" href="{{ asset('/bundles/troopersalertify/codrops-notification/css/ns-style-bar.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/bundles/troopersalertify/codrops-notification/css/ns-style-attached.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/bundles/troopersalertify/codrops-notification/css/ns-style-growl.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/bundles/troopersalertify/codrops-notification/css/ns-style-other.cs') }}" type="text/css" />
{% endblock %}

{% block javascripts %}
    <script src="{{ asset('/bundles/troopersalertify/codrops-notification/js/classie.js') }}"></script>
    <script src="{{ asset('/bundles/troopersalertify/codrops-notification/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('/bundles/troopersalertify/codrops-notification/js/notificationFx.js') }}"></script>
{% endblock %}
```

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