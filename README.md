IDÉE DU JOUR : 

UtilisateurAUCUN ROLE
Lire l’article

Utilisateur  --> ROLE_USER
Commenter l’article
Mettre un Like

Utilisateur --> [« ROLE_AUTHOR »]
Créer un article
Modifier un article(si c’est le sien)

Modérateur  [« ROLE_MODERATOR »]
Publier un article
Supprimer un commentaire

Administrateur ->[« ROLE_ADMIN »]
Accès à tous les utilisateurs. 
L’identité
Peut tout faire dans le site
Donner le Role : ROLE_MODERATOR

Entity POST :
->title
->content
->urlImage
->createdAt
->author (User)
----------------------------------
Entity Comments
->content
->author(User) ->ManyToOne
->post(Post) ->ManyToOne
->createdAt




----------------
DIDACTITIEL
----------------
1. composer install

2. Configurer votre bdd 

3. php bin/console d:d:c

4. php bin/console d:d:m --no-interaction

4. reinstaller CKeditor

-> composer require friendsofsymfony/ckeditor-bundle

-> php bin/console ckeditor:install

-> php bin/console assets:install public



