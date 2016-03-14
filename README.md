[![AppVentus](https://github.com/AppVentus/AvAlertifyBundle/blob/master/Media/appventus.png)](http://appventus.com)

[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/AppVentus/AvAlertifyBundle)
[![License](https://img.shields.io/packagist/l/appventus/alertify-bundle.svg)](https://packagist.org/packages/appventus/alertify-bundle)
[![Version](https://img.shields.io/packagist/v/appventus/alertify-bundle.svg)](https://packagist.org/packages/appventus/alertify-bundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4d741335-ad77-4308-9113-b1648c4be64e/mini.png)](https://insight.sensiolabs.com/projects/4d741335-ad77-4308-9113-b1648c4be64e)
[![Dependency Status](https://www.versioneye.com/php/appventus:alertify-bundle/dev-master/badge.svg)](https://www.versioneye.com/php/appventus:alertify-bundle/dev-master)
=============

Alertify Bundle
===============

What is the point ?
-------

This bundle allows you to easily harmonize alerts and others notifications.
Declare in the config (or just use the default configuration) and dispatch alerts with the following libraries ([or your own](#use-my-own-alert-system)):

* [Toastr](https://github.com/CodeSeven/toastr)
* [TwitterBootstrap](http://twitter.github.com/bootstrap/javascript.html#modals)
* [Noty](http://needim.github.com/noty/)
* [Codrops notifications](http://tympanus.net/Development/NotificationStyles)
* [Notie.js](https://github.com/jaredreich/notie.js) `new`

Installation
------------

First, require it thanks to composer:

    composer.phar require appventus/alertify-bundle:dev-master


Add it in your AppKernel.php:

    public function registerBundles() {
        $bundles = array(
            [...]
            new AppVentus\AlertifyBundle\AvAlertifyBundle(),
            [...]

To include the library of your choice, you have these 2 methods :

### automatically with [https://github.com/AppVentus/AsseticInjectorBundle](AsseticInjectorBundle) (*recommended*)

Just add the name of the resource tag (e.g alertify-toastr) in your regular assetic's block.

For example, this code ...

```twig
    {% javascripts injector="alertify-toastr"
        '@MyAcmeDemoBundle/Resources/public/js/loremipsumdolorsitamet.js'
     %}
    <script type="text/javascript" src="{{ asset_url }}"></script>
    {% endjavascripts %}
```
and the same way for stylesheets (if needded) and for each one of availables librairies (`alertify-notie`, `alertify-codrops-notification`...).

### manually

If you want to do this  manually, you'll have to read the Resources/config/assetic_injector.json file and add them manually :

```twig
    {% javascripts
        '@AvAlertifyBundle/Resources/public/toastr/js/toastr.js'
     %}
    <script type="text/javascript" src="{{ asset_url }}"></script>
    {% endjavascripts %}
```
and the same way for stylesheets.

Configuration ?
------------

To define the default configuration of your alerts, you can add the following lines in your config.yml :

```yml
av_alertify:
    contexts:
        front:
            engine: "toastr"              \#Could be noty, modal, toastr or your own
            layout: "top-right"           \#Is relative according to the selected engine
            translationDomain: "messages" \#Where do you want to store the translation strings
        admin:
            engine: "myOwnSystem"
            layout: "bottomRight"
            translationDomain: "messages"
```

By default, even if you do not declare any context, Alertify setup default values. You can override these settings easily like this:

 ```yml
av_alertify:
    default:
        context: app                \#default: front
        engine: noty                \#default: toastr
        layout: bottomLeft          \#default: top-right
        translationDomain: messages \#default: flash
    contexts:
    ...
```

How to ?
------------

It's easy to use, just follow the following:

Add this block at the end of your twig layout:

     {% block alertify %}
        {{ app.session|alertify|raw }}
     {% endblock %}

Now, anywhere, you can put your alert in the flash session and enjoy.

    $this->get('session')->getFlashBag()->add('success', 'ok');
    $this->get('session')->getFlashBag()->add('warning', array('body' => 'ok');
    $this->get('session')->getFlashBag()->add('warning', array('body' => 'ok', 'context' => 'front');

You can use the `appventus_alertifybundle.helper.alertifyhelper` service to ease the alert creation :

    $this->container->get('appventus_alertifybundle.helper.alertifyhelper')->congrat('TEST');
    $this->container->get('appventus_alertifybundle.helper.alertifyhelper')->warn('TEST');
    $this->container->get('appventus_alertifybundle.helper.alertifyhelper')->inform('TEST');
    $this->container->get('appventus_alertifybundle.helper.alertifyhelper')->scold('TEST');

You can also use the AlertifyControllerTrait to have simple methods in controller :

```php
use AppVentus\AlertifyBundle\Controller\AlertifyControllerTrait;

class MyController extends ...
{
    use AlertifyControllerTrait;

    /* You can use then all methods :
     * $this->alert("hello", $type = 'success');
     * $this->congrat("Congratulation");
     * $this->warn("Warning !");
     * $this->inform("Did you know ?");
     * $this->scold("What's wrong with you !");
     */
}
```

If you have two contexts in your application (front and back for example), I spur you to override these functions in your controller in each side to pass automatic context like this :

```php
    class BaseFrontController
    {
        /**
         * congrat user through flashbag : all happened successfully
         * Will automatically inject context
         * @param string $content
         */
        public function congrat($content)
        {
            $content = array('body' => $content, 'context' => 'front');
            $this->get('av.shortcuts')->congrat($content);
        }
    }
```


<a name="use-my-own-alert-system"></a>Display alerts with a custom library
------------

AvAlertify comes with some librairies to ease use but it's free to you to use custom Library (feel free to make a Pull request, your library could interest community :).
You just have to follow these steps :

```yml
av_alertify:
    contexts:
        front:
            engine: "myOwnSystem"
            layout: "bottomRight" \#it's up to your library
            translationDomain: "messages"
```

Then just override app/Resources/AvAlertifyBundle/views/Modal/**myOwnSystem**.html.twig and add the alert initialization.

Options
------------

### Modal

To call a modal box, just use a flash named 'modal':

    $this->get('session')->getFlashBag()->set("success", array('engine' => 'modal', 'title' => "Wow", 'button_class' => "btn btn-primary btn-large", "body"=> "<div>Some info</div>"));

as you see, you can pass some arguments tu customize the modal, availables ones are:

    title:
      (html) string
    button-class:
      you con specify classes to customize your button
    body:
      html string
    hasHeader:
      boolean (default = true)
    hasFooter:
      boolean (default = true)
    deleteIcon:
      string : icon-class (for example: "fa fa-times")
    id:
      string : (default: "alertify-modal")


Callback type
------------

There is a final type of Alert you can call, the callback
Callbach allow you to call any action in you project, thats awesome if you want put dynamic content in your alery.
To work, the called action have to render a view. It's very usefull to include a form in a modal for exemple.

    $this->get('session')
      ->getFlashBag()
      ->set('callback', array(
          'engine' => 'modal',
          'title' => 'Wow',
          'action' => 'AcmeBundle:Default:hello',
          'button_class' => 'btn btn-primary btn-large',
          'body' => '<p>Yeah that's crazy !</p>'
        )
    );

This type is very simple to use, just call the callback alery, and in the options define "type" with the final alert you want, the action with the action you want call, and other options specific to the alery you choose.

Ajax mode
-----------

We told you to add the alertify filter in your layout. This is great but what if you want to use ajax in your application ?

Actually, this library is not really made for it but you can simply add this part of code to trigger alerts in your new ajax content :


    {% if app.request.isXmlHttpRequest %}
        {{ app.session|alertify|raw }}
    {% endif %}


Confirm modal
-------------

After a link's clic or form's submission, we sometimes want to prompt the user to be sure he understood what he did.
You can make it as a simply way by following the doc here : (https://github.com/AppVentus/AvAlertifyBundle/blob/master/README_Confirm.md)

Relations
------------

You can use the [AvAwesomeShortcutsBundle](https://github.com/AppVentus/AvAwesomeShortcutsBundle) which allows you to easily add and use shortcuts for your dev apps
