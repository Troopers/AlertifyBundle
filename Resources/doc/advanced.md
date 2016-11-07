# Advanced features

## Modal

To call a modal box, just use a flash named 'modal':

    $this->get('session')->getFlashBag()->set("success", array('engine' => 'modal', 'title' => "Wow", 'button_class' => "btn btn-primary btn-large", "body"=> "<div>Some info</div>"));

as you see, you can pass some arguments tu customize the modal, availables ones are:

|option      |type  |required|default value |
|------------|------|--------|--------------|
|title       |string| true   |              |
|body        |string| true   |              |
|button-class|string| true   |              |
|hasHeader   |string| false  | true         |
|hasFooter   |string| false  | true         |
|deleteIcon  |string| false  |              |
|id          |string| false  |alertify-modal|


## Confirm Modal

After a link's clic or form's submission, we sometimes want to prompt the user to be sure he understood what he did.
The confirm modal will help you to accomplish this rough job :)

Please note that [FOSJsRoutingBundle](https://github.com/FriendsOfSymfony/FOSJsRoutingBundle/blob/master/Resources/doc/index.md#installation) 
is required so you need to [setup it properly before](https://github.com/FriendsOfSymfony/FOSJsRoutingBundle/blob/master/Resources/doc/index.md#installation) following next steps.

Add this to your routing.yml file:

```
    TroopersAlertifyBundle:
        resource: "@TroopersAlertifyBundle/Controller/"
        type:     annotation
        prefix:   /
```

Add this to your template:

    <script src="{{ asset('bundles/avalertify/js/confirm.js') }}"></script>

Then, add the following attributes to the link or form tag you want to protect:

- data-toggle="confirm"
- data-confirm-class="myModal"
- data-title="Are you sure ?"
- data-body="This is forever !"
- data-cancel-button-class="btn-cancel"
- data-confirm-button-class="btn-primary"

You can also add a callback like this:
 
- data-confirm-callback="someJavascriptFunctionToRunIfTheConfirmButtonIsClicked();"

In this cas, after confirm, the link won't be directly followed (or the form won't be submit).
Instead of that, the js we'll be ran.

## Example :

### Form :

    <form action="/your_url" data-toggle="confirm" data-confirm-class="myModal" data-title="Sure ?" data-body="Butterfly will die. Do you confirm ?" data-cancel-button-class="cancel" data-confirm-button-class="danger" method="post" {{ form_enctype(delete_form) }}>
       {{ form_errors(delete_form) }}
       {{ form_widget(delete_form) }}
        <input type="submit" class="btn btn-danger span4" style="width:100%" value="Kill Butterfly"/>
    </form>

### link :

```html
    <a href="/your_url" class="btn btn-mini btn-danger" data-toggle="confirm" data-title="Are you sure ?" data-body="Kittens will suffer ! Do you confirm ?" data-cancel-button-class="cancel" data-confirm-button-class="danger">Burn some cats</a>
```
