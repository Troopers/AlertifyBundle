AvAlertifyBundle
=============

Go here to read more about this plugin : (http://appventus.com/blog/les-notifications-ou-comment-ameliorer-la-user-experience-grace-a-noty-et-aux-modals-en-2-minutes)

What is the point ?
-------


This bundle allow you to easily turn your poor lonely sad notifications into modals from 
* TwitterBootstrap (http://twitter.github.com/bootstrap/javascript.html#modals) or
* Noty (http://needim.github.com/noty/) or
* Toastr (https://github.com/CodeSeven/toastr)


Installation
------------

First, add these in your deps:

    [AvAlertifyBundle]
        git=https://github.com/AppVentus/AvAlertifyBundle.git
        target=bundles/AppVentus/Awesome/AvAlertifyBundle

And never forget to declare it in your AppKernel.php:
    
    public function registerBundles() {
        $bundles = array(
            [...]
            new AppVentus\Awesome\AlertifyBundle\AvAwesomeAlertifyBundle(),
            [...]

And in your autoload.php
    
    $loader->registerNamespaces(array(
        [...]
        'AppVentus' => __DIR__ . '/../vendor',
        [..]

Then, just publish your assets, annnnnnd it's done !

How to ?
------------


It's amazingly easy to use, just follow the following:

Add this block at the end of your twig layout:

     {% block alertify %}
        {{ app.session | alertify|raw }}
     {% endblock %}

Now, anywhere in your controllers you can put your alert in the flash session and enjoy.



Options
------------

### Noty (For toastr, just replace noty by toastr)

To call a noty alert, just use a flash named 'noty':

    $this->get('session')->setFlash('noty',array('type'=>'success', 'layout'=>'bottom' ,'body'=>"<div>OMG, that's amazing !</div>"));

as you see, you can pass some arguments tu customize the noty, availables ones are:

    type:
      success
      error
      warning
      information
    layout:
      Bottom[Left|Center|Right]
      Top[Left|Center|Right]
      Center[Left|Right]
    body:
      some html content you want to see in the noty 

### Modal

To call a modal box, just use a flash named 'modal':

    $this->get('session')->setFlash("modal", array('title'=>"Wow",'button_class'=>"btn btn-primary btn-large", "body"=> "<div>Some info</div>"));

as you see, you can pass some arguments tu customize the modal, availables ones are:

    title:
      just a string
    button-class:
      you con specify classes to customize your button  
    body:
      html string



Callback type
------------

There is a final type of Alert you can call, the callback
Callbach allow you to call any action in you project, thats awesome if you want put dynamic content in your alery.
To work, the called action have to render a view. It's very usefull to include a form in a modal for exemple.

    $this->get('session')->setFlash('callback', array('type'=>'modal','title' => 'Wow', 'action'=>'AcmeBundle:Default:hello', 'button_class'=>'btn btn-primary btn-large', 'body'=>'<p>Yeah that's crazy !</p>'));  
       
This type is very simple to use, just call the callback alery, and in the options define "type" with the final alert you want, the action with the action you want call, and other options specific to the alery you choose.


Confirm modal
------------

After a link's clic or form's submission, we sometimes want to prompt the user to be sure he understood what he did.
You can make it as a simply way by following the doc here : (https://github.com/AppVentus/AvAlertifyBundle/blob/master/README_Confirm.md)


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/AppVentus/avalertifybundle/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

