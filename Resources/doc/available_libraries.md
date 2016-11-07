* [Toastr](https://github.com/CodeSeven/toastr)
* [TwitterBootstrap](http://twitter.github.com/bootstrap/javascript.html#modals)
* [Noty](http://needim.github.com/noty/)
* [Codrops notifications](http://tympanus.net/Development/NotificationStyles)
* [Notie.js](https://github.com/jaredreich/notie.js)
* [Push.js](https://github.com/Nickersoft/push.js)


Display alerts with a custom library
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