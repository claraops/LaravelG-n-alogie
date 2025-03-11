# LaravelG-n-alogie
test technique pour un projet de genealogie

mes differentes Url pour faciliter: 
-liste personnes : http://127.0.0.1:8000
-creer une personne : http://127.0.0.1:8000/people/create
-voir information d'une personne : http://127.0.0.1:8000/people/1
-voir les utlisateur connecter : http://127.0.0.1:8000/dashboard
-tester le methode degrer : http://127.0.0.1:8000/test-degree


#pour acceder la fonction methode :

# Généalogie - Conception de Base de Données

## Schéma de Base de Données

Pour concevoir la structure de la base de données répondant aux problèmes mentionnés, nous avons défini les tables suivantes :

1. `users` : Contient les informations des utilisateurs inscrits.
2. `people` : Contient les informations des personnes représentées dans l'arbre généalogique.
3. `relationships` : Contient les relations familiales entre les personnes.
4. `modification_proposals` : Contient les propositions de modifications des fiches personnes ou de relations.
5. `modification_votes` : Contient les votes des utilisateurs sur les propositions de modifications.

Voici le lien vers le schéma de la base de données créé avec dbdiagram.io :
[Schéma de la Base de Données]) : https://dbdiagram.io/d/DbGenealogie-67d0513175d75cc844ae1e80

## Évolution des Données

#   Cas 1 : Ajout de Membres de la Famille
Insertion d'une fiche personne :
Un utilisateur crée une nouvelle fiche personne dans la table people.
Exemple : jean01 crée la fiche de sa fille Marie PERRET.

=>INSERT INTO people (first_name, last_name, birth_name, middle_names, date_of_birth, created_by)
VALUES ('Marie', 'PERRET', 'Marie DUPONT', 'Anne', '2000-01-01', 1);

Ajout d'une relation :
L'utilisateur ajoute une relation entre deux personnes dans la table relationships.
Exemple : jean01 ajoute une relation parent-enfant entre Jean PERRET et Marie PERRET.

=>INSERT INTO relationships (person_id, related_person_id, relationship_type, created_by)
VALUES (1, 2, 'parent', 1);

#  Cas 2 : Invitations
Création d'une fiche pour un invité :
Un utilisateur crée une fiche pour un membre de sa famille qui n'est pas encore inscrit.
Exemple : jean01 crée la fiche de sa fille Rose PERRET.

=>INSERT INTO people (first_name, last_name, birth_name, middle_names, date_of_birth, created_by)
VALUES ('Rose', 'PERRET', 'Rose DUPONT', 'Claire', '2005-01-01', 1);

Inscription de l'invité :
L'invité s'inscrit sur le site et acquiert la fiche créée pour lui.
Exemple : rose03 s'inscrit et acquiert la fiche Rose PERRET.

#  Cas 3 : Inscription sans Invitation
Création d'une fiche par un nouvel utilisateur :
Un utilisateur s'inscrit sans invitation et crée sa propre fiche.
Exemple : marc10 s'inscrit et crée sa fiche Marc DUPONT.

=>INSERT INTO people (first_name, last_name, birth_name, middle_names, date_of_birth, created_by)
VALUES ('Marc', 'DUPONT', 'Marc LEROY', 'Jean', '1990-01-01', 3);

#  Cas 4 : Propositions de Modifications
Proposition de modification :
Un utilisateur propose une modification pour une personne ou une relation.
Exemple : rose03 propose de modifier le prénom de Rose PERRET en Rosalie.

=>INSERT INTO modification_proposals (type, target_id, field_name, proposed_value, proposed_by, status)
VALUES ('person', 3, 'first_name', 'Rosalie', 3, 'pending');

Proposition d'ajout de relation :
Un utilisateur propose d'ajouter une nouvelle relation.
Exemple : rose03 propose d'ajouter une relation entre Rose PERRET et Jean PERRET.

=>INSERT INTO modification_proposals (type, target_id, field_name, proposed_value, proposed_by, status)
VALUES ('relationship', 2, 'relationship_type', 'parent', 3, 'pending');

#  Cas 5 : Validation des Modifications
Vote des utilisateurs :
Les utilisateurs votent pour accepter ou rejeter la proposition.
Exemple : jean01, marie02, et marc10 votent pour la proposition de rose03.

=>INSERT INTO modification_votes (proposal_id, user_id, vote)
VALUES (1, 1, 'accept'), (1, 2, 'accept'), (1, 3, 'accept');
Mise à jour du statut de la proposition :

Si 3 utilisateurs acceptent la proposition, elle est validée.
Exemple : La proposition de rose03 est acceptée.

=>UPDATE modification_proposals
SET status = 'accepted'
WHERE id = 1;

Application de la modification :
La modification est appliquée à la table concernée (people ou relationships).
Exemple : Le prénom de Rose PERRET est mis à jour.

=>UPDATE people
SET first_name = 'Rosalie'
WHERE id = 3;
Historique des modifications :

Les propositions et les votes sont conservés dans les tables modification_proposals et modification_votes pour garder une trace des modifications.

