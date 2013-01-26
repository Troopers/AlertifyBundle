Boite de dialogue Modal :
=========

AlertifyBundle permet de générer des boites de dialogues de confirmation lorsque vous voulez protéger un formulaire ou un lien.

Installation:

Déclarez les routes du controleur AlertifyController en ajoutant ceci dans votre fichier routing.yml :

	AvAwesomeAlertifyBundle:
	    resource: "@AvAwesomeAlertifyBundle/Controller/"
	    type:     annotation
	    prefix:   /

Le formulaire, ou le lien en question doit avoir les attributs ci dessous :

- class="confirm"
- data-title="Êtes vous sur ?"
- data-body="Cette action irreversible ! Souhaitez vous confirmer ?"

Voici un exemple : 

	<form action="/your_url" data-title="Êtes vous sur ?" data-body="Cette action irreversible ! Souhaitez vous confirmer ?" class="confirm" method="post" {{ form_enctype(delete_form) }}>
		{{ form_errors(delete_form) }}  
		{{ form_widget(delete_form) }}
        <input type="submit" class="btn btn-danger span4" style="width:100%" value="Supprimer définitvement"/>
    </form>

ou pour un lien : 

<a href="/your_url" class="btn btn-mini btn-danger confirm" data-title="Êtes vous sur de vouloir faire ca&nbsp;?" data-body="BLABLA">Dépublier</a>

Ajoutez le fichier javascript dans votre template en spécifiant la variable confirmUrl comme ceci :

    <script type="text/javascript">var confirmUrl = "{{ path('Alertify_Confirm') }}";</script>
    <script src="{{ asset('bundles/avawesomealertify/js/confirm.js') }}"></script>