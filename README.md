[![Troopers](https://cloud.githubusercontent.com/assets/618536/18787530/83cf424e-81a3-11e6-8f66-cde3ec5fa82a.png)](http://troopers.agency)

[![Build Status](https://travis-ci.org/Troopers/AlertifyBundle.svg)](https://travis-ci.org/Troopers/AlertifyBundle)
[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/Troopers/TroopersAlertifyBundle)
[![License](https://img.shields.io/packagist/l/troopers/alertify-bundle.svg)](https://packagist.org/packages/troopers/alertify-bundle)
[![Version](https://img.shields.io/packagist/v/troopers/alertify-bundle.svg)](https://packagist.org/packages/troopers/alertify-bundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4d741335-ad77-4308-9113-b1648c4be64e/mini.png)](https://insight.sensiolabs.com/projects/4d741335-ad77-4308-9113-b1648c4be64e)
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
* [Notie.js](https://github.com/jaredreich/notie.js)
* [Push.js](https://github.com/Nickersoft/push.js)

Installation
------------

First, require it thanks to composer:

    composer.phar require troopers/alertify-bundle:dev-master


Add it in your AppKernel.php:

    public function registerBundles() {
        $bundles = array(
            [...]
            new Troopers\AlertifyBundle\TroopersAlertifyBundle(),
            [...]

To include the library of your choice, you have these 2 methods :

### automatically with [https://github.com/Troopers/AsseticInjectorBundle](AsseticInjectorBundle) (*recommended*)

Just add the name of the resource tag (e.g alertify-toastr) in your regular assetic's block.

For example, this code ...

```twig
    {% javascripts injector="alertify-toastr"
        '@MyAcmeDemoBundle/Resources/public/js/loremipsumdolorsitamet.js'
     %}
    <script type="text/javascript" src="{{ asset_url }}"></script>
    {% endjavascripts %}
```
and the same way for stylesheets (if needded) and for each one of availables librairies (`alertify-notie`, `alertify-codrops-notification`, `alertify-pushjs`...).

### manually

If you want to do this  manually, you'll have to read the Resources/config/assetic_injector.json file and add them manually :

```twig
    {% javascripts
        '@TroopersAlertifyBundle/Resources/public/toastr/js/toastr.js'
     %}
    <script type="text/javascript" src="{{ asset_url }}"></script>
    {% endjavascripts %}
```
and the same way for stylesheets and other libraries.

Configuration ?
------------

To define the default configuration of your alerts, you can add the following lines in your config.yml :

```yml
troopers_alertify:
    contexts:
        front:
            engine: "toastr"              \#Could be noty, modal, toastr or your own
            layout: "top-right"           \#Is relative according to the selected engine
            translationDomain: "messages" \#Where do you want to store the translation strings
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
        context: app                \#default: front
        engine: noty                \#default: toastr
        layout: bottomLeft          \#default: top-right
        translationDomain: messages \#default: flash
    contexts:
    ...
```

How to ?
------------

    $this->get('session')->getFlashBag()->add('success', 'ok');
    $this->get('session')->getFlashBag()->add('warning', array('body' => 'ok', 'context' => 'front', 'options' => ['option1' => 'custom value']);

You can use the `alertify` service to ease the alert creation :

    $this->container->get('alertify')->congrat('TEST', $options);
    $this->container->get('alertify')->warn('TEST', $options);
    $this->container->get('alertify')->inform('TEST', $options);
    $this->container->get('alertify')->scold('TEST', $options);

You can also use the AlertifyControllerTrait to have simple methods in controller :

```php
use Troopers\AlertifyBundle\Controller\AlertifyControllerTrait;

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

TroopersAlertify comes with some librairies to ease use but it's free to you to use custom Library (feel free to make a Pull request, your library could interest community :).
You just have to follow these steps :

```yml
troopers_alertify:
    contexts:
        front:
            engine: "myOwnSystem"
            layout: "bottomRight" \#it's up to your library
            translationDomain: "messages"
```

Then just override app/Resources/TroopersAlertifyBundle/views/Modal/**myOwnSystem**.html.twig and add the alert initialization.

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
You can make it as a simply way by following the doc here : (https://github.com/Troopers/TroopersAlertifyBundle/blob/master/README_Confirm.md)
