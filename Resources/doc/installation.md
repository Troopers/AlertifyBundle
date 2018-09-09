Installation
------------

First, require it thanks to composer:

    composer.phar require troopers/alertify-bundle:~3.0

Add it in your AppKernel.php (pass to next step with Flex 💪):

```php
    public function registerBundles() {
        $bundles = [
            //...
            new Troopers\AlertifyBundle\TroopersAlertifyBundle(),
```

Warning: make sure the twig engine is turned on in framework.yaml

  - If not, add the following to `config/packages/framework.yaml` (or `config/config.yml` for symfony <4 versions):

framework:
    # ...
    templating:
        engines: ['twig']
