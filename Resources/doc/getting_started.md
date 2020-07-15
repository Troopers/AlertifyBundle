# Getting started

## Adding message

### In your controller

#### Classic way :

```php
    $this->get('session')->getFlashBag()->add('success', 'ok');
    $this->get('session')->getFlashBag()->add('warning', array('body' => 'ok', 'context' => 'front', 'options' => ['option1' => 'custom value']);
```

#### Using the autowire and the helper :

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use use Troopers\AlertifyBundle\Helper\AlertifyHelper;

class GrumpyGnomeController extends AbstractController
{
    /**
     * @Route("/grumpy/gnome", name="grumpy_gnome")
     */
    public function index(AlertifyHelper $alertify)
    {
        $alertify->congrat('Congratulation !');
        $alertify->scold('WTF are you kidding !');
        $alertify->inform('Did you know ?');
        $alertify->warn('Come on, be careful kid !');

        return $this->render('grumpy_gnome/index.html.twig');
    }
}
```

## Rendering alert message

### This is automatically done on the `kernel.response` event

The flash messages are handled in the `kernel.response` thanks to the `Troopers/AlertifyBundle/EventListener/AlertifyListener` class.

If it doesn't display messages, you need to check 2 things :
- do you have a previous session ? If not, you'll have to create one first or force the injection. You have two way to do this, adding the alertify filter (read below) or adding the `'X-Inject-Alertify' => true` header to your response [Advanced](https://github.com/Troopers/TroopersAlertifyBundle/blob/master/Resources/doc/advanced.md)
- are the assets correctly loaded ? [Configuration](https://github.com/Troopers/TroopersAlertifyBundle/blob/master/Resources/doc/configuration.md)

### To force flash display (ajax, no session mode...), you can use either the `alertify` twig filter in your templates :

```twig
    {{ app.session|alertify|raw }}
```