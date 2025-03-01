# O'CD - Site de Généalogie

## Description du projet
Ce projet est une application web permettant de créer un arbre généalogique interactif en Laravel.

## Technologies utilisées
- **Langage :** PHP
- **Framework :** Laravel 8.x ou supérieur
- **Base de données :** MySQL

## Installation et configuration
1. **Clonez le projet**
   ```sh
   git clone https://github.com/nassimug/Stage_OCD
   cd votre-repo
   ```
2. **Installez les dépendances**
   ```sh
   composer install
   ```
3. **Créez et configurez le fichier `.env`**
   ```sh
   cp .env.example .env
   ```
   Configurez ensuite la connexion à la base de données dans le fichier `.env`.
4. **Générez la clé d'application**
   ```sh
   php artisan key:generate
   ```
5. **Créez la base de données et appliquez les migrations**
   ```sh
   php artisan migrate
   ```
6. **Importez les données de départ**
   Utilisez l'importation SQL via phpMyAdmin ou MySQL Workbench.

## Fonctionnalités principales
- Création et gestion des fiches de personnes (nom, prénom, date de naissance, etc.)
- Gestion des relations familiales (parents, enfants)
- Calcul du degré de parenté entre deux personnes
- Système d'authentification pour protéger la modification des données
- Proposition et validation communautaire des modifications

## Modèles et relations
- **People** : Représente une personne avec des champs tels que `first_name`, `last_name`, `date_of_birth`.
- **Relationships** : Gère les relations entre les personnes (parent/enfant).
- **Users** : Gère l'authentification et l'autorisation des utilisateurs.

## Routes et Contrôleurs
- **`GET /people`** : Affiche la liste des personnes
- **`GET /people/{id}`** : Affiche le détail d'une personne
- **`POST /people`** : Crée une nouvelle personne
- **`GET /degree-check`** : Calcule le degré de parenté

## Calcul du degré de parenté
La méthode `getDegreeWith($target_person_id)` permet de calculer le lien entre deux personnes avec une approche optimisée via MySQL.

Exemple d'exécution :
```php
DB::enableQueryLog();
$timestart = microtime(true);
$person = Person::findOrFail(84);
$degree = $person->getDegreeWith(1265);
var_dump(["degree"=>$degree, "time"=>microtime(true)-$timestart, "nb_queries"=>count(DB::getQueryLog())]);
```

## Gestion communautaire des modifications
Les utilisateurs peuvent proposer des modifications qui seront validées par vote communautaire.
- **3 validations** : La modification est acceptée.
- **3 refus** : La modification est définitivement rejetée.

## Évolution des données : Propositions de Modifications et Validation
### Insertion d'une proposition de modification
Lorsqu'un utilisateur propose une modification (ex. modification d'un nom, ajout d'une relation), les données sont insérées dans une table `modification_requests` avec les informations suivantes :
- `id`
- `user_id` (utilisateur ayant fait la demande)
- `person_id` (personne concernée par la modification)
- `field` (champ modifié, ex: `last_name`)
- `new_value`
- `status` ("en attente", "validé", "rejeté")
- `created_at` / `updated_at`

### Validation d'une modification
Lorsqu'une modification est proposée, chaque membre peut l'accepter ou la refuser. Ces votes sont enregistrés dans une table `modification_votes` :
- `id`
- `modification_request_id`
- `user_id` (utilisateur ayant voté)
- `vote` (1 = accepté, 0 = refusé)
- `created_at`

Une fois que **3 votes positifs** sont enregistrés, la modification est appliquée à la table `people`. Si **3 votes négatifs** sont enregistrés, la modification est rejetée.

### Mise à jour de la base de données
- Si la modification est acceptée, le champ concerné dans `people` est mis à jour avec `new_value`.
- Si la modification est rejetée, elle est archivée mais ne change pas les données de la personne.
- Les modifications validées ou refusées sont supprimées de la table `modification_requests`.

## Schéma de base de données
Le schéma de la base de données peut être consulté ici :
[Voir le schéma](https://dbdiagram.io/d/67c36ed7263d6cf9a0e7a63d)

## Contribuer
Les contributions sont les bienvenues ! Merci de consulter les [guidelines de contribution](https://laravel.com/docs/contributions) avant de proposer une modification.

## Licence
Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).


