# Pro tips

## Use the `alertify` service to ease the alert creation :

```
    $this->container->get('alertify')->congrat('TEST', $options);
    $this->container->get('alertify')->warn('TEST', $options);
    $this->container->get('alertify')->inform('TEST', $options);
    $this->container->get('alertify')->scold('TEST', $options);
```

## Use the AlertifyControllerTrait to have simple methods in controller :

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

### Override methods to simplify exotic contextual alerts

If you have two contexts in your application (front and back for example), I spur you to override these functions in your controller in each side to pass automatic context like this :

```php
    class BaseFrontController
    {
        /**
         * congrat user through flashbag : all happened successfully
         * Will automatically inject context
         * @param string $content
         */
        public function alert($content, $type, $options)
        {
            $content = array('body' => $content, 'context' => 'front');
            $this->get('alertify')->alert($content, $type, $options);
        }
    }
```