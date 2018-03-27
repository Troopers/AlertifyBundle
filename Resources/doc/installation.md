Installation
------------

First, require it thanks to composer:

    composer.phar require troopers/alertify-bundle:~3.0

Add it in your AppKernel.php:

```php
    public function registerBundles() {
        $bundles = [
            //...
            new Troopers\AlertifyBundle\TroopersAlertifyBundle(),
```
