# LaravelG-n-alogie
test technique pour un projet de genealogie

mes differentes Url pour faciliter: 
-liste personnes : http://127.0.0.1:8000/
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

### Propositions de Modifications

Lorsqu'un utilisateur propose une modification (par exemple, ajouter une nouvelle relation), les informations suivantes sont insérées dans la table `modification_proposals` :

- `id` : Identifiant unique de la proposition.
- `user_id` : Identifiant de l'utilisateur ayant proposé la modification.
- `type` : Type de modification (ajout de relation, modification de fiche, etc.).
- `data` : Données spécifiques à la modification proposée (par exemple, les identifiants des personnes pour une relation).
- `status` : Statut de la proposition (`pending`, `validated`, `rejected`).

### Validation des Modifications

Les utilisateurs peuvent voter pour ou contre une proposition. Chaque vote est enregistré dans la table `modification_votes` :

- `id` : Identifiant unique du vote.
- `proposal_id` : Identifiant de la proposition de modification.
- `user_id` : Identifiant de l'utilisateur ayant voté.
- `vote` : Vote de l'utilisateur (`accept` ou `reject`).

Le statut de la proposition dans `modification_proposals` est mis à jour en fonction des votes :

- Si au moins 3 utilisateurs acceptent la proposition, le statut passe à `validated`.
- Si au moins 3 utilisateurs rejettent la proposition, le statut passe à `rejected`.

Une fois qu'une proposition est validée, les modifications sont appliquées aux tables concernées (`people` ou `relationships`). Si une proposition est rejetée, aucune modification n'est appliquée.

### Exemple de Scénario

1. `rose03` propose d'ajouter une relation entre `Rose PERRET` et `Jean PERRET`.
   - Insertion dans `modification_proposals` :
     ```
     INSERT INTO modification_proposals (user_id, type, data, status)
     VALUES (3, 'add_relationship', '{ "person1_id": 4, "person2_id": 1, "relationship_type": "father" }', 'pending');
     ```

2. Les utilisateurs `jean01`, `marie02`, et `marc10` acceptent la proposition.
   - Insertion dans `modification_votes` :
     ```
     INSERT INTO modification_votes (proposal_id, user_id, vote)
     VALUES (1, 1, 'accept'), (1, 2, 'accept'), (1, 5, 'accept');
     ```

3. Le statut de la proposition passe à `validated` et la relation est ajoutée dans `relationships`.
   - Mise à jour de `modification_proposals` :
     ```
     UPDATE modification_proposals
     SET status = 'validated'
     WHERE id = 1;
     ```

   - Insertion dans `relationships` :
     ```
     INSERT INTO relationships (person1_id, person2_id, relationship_type)
     VALUES (4, 1, 'father');
     ```

En suivant ce processus, la structure de la base de données permet de gérer les propositions de modifications et leur validation par la communauté, assurant ainsi l'intégrité des informations généalogiques.
