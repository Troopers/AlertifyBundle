Installation
------------

First, require it thanks to composer:

    composer.phar require troopers/alertify-bundle:~3.0

Add it in your AppKernel.php:

```
    public function registerBundles() {
        $bundles = array(
            [...]
            new Troopers\AlertifyBundle\TroopersAlertifyBundle(),
            [...]
```