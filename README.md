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
