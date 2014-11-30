Confirm Modal :
=========

AlertifyBundle eases the confirm dialog you may use when protecting link or form.

## Installation:

Please note that [FOSJsRoutingBundle](https://github.com/FriendsOfSymfony/FOSJsRoutingBundle/blob/master/Resources/doc/index.md#installation) is required so you need to [setup it properly before](https://github.com/FriendsOfSymfony/FOSJsRoutingBundle/blob/master/Resources/doc/index.md#installation) following next steps.

Add this to your routing.yml file:

	AvAwesomeAlertifyBundle:
	    resource: "@AvAwesomeAlertifyBundle/Controller/"
	    type:     annotation
	    prefix:   /

Add this to your template:

    <script src="{{ asset('bundles/avawesomealertify/js/confirm.js') }}"></script>

## Use

Add the following attributes to your link|form tag :

- class="confirm"
- data-title="Are you sure ?"
- data-body="This is forever !"
- data-cancel-button-class="btn-cancel"
- data-confirm-button-class="btn-primary"

You can also add a callback like this:
 
- data-confirm-callback="someFunctionToRunIfTheConfirmButtonIsClicked();"

In this cas, after confirm, the link won't be directly followed (or the form won't be submit).
Instead of that, the js we'll be ran.

## Example :

### Form :

	<form action="/your_url" class="confirm" data-title="Sur ?" data-body="Butterfly will die. Do you confirm ?" data-cancel-button-class="cancel" data-confirm-button-class="danger" method="post" {{ form_enctype(delete_form) }}>
		{{ form_errors(delete_form) }}
		{{ form_widget(delete_form) }}
        <input type="submit" class="btn btn-danger span4" style="width:100%" value="Kill Butterfly"/>
    </form>

### link :

```html
<a href="/your_url" class="btn btn-mini btn-danger confirm" data-title="Are you sure ?" data-body="Kittens will suffer ! Do you confirm ?" data-cancel-button-class="cancel" data-confirm-button-class="danger">Burn some cats</a>
```
