# Getting started

## Adding message

```
    $this->get('session')->getFlashBag()->add('success', 'ok');
    $this->get('session')->getFlashBag()->add('warning', array('body' => 'ok', 'context' => 'front', 'options' => ['option1' => 'custom value']);
```

## Rendering alert message

### Automatically on the `kernel.response` event

### In ajax or for another use, you can use either the `alertify` twig filter

```twig
    {{ app.session|alertify|raw }}
```