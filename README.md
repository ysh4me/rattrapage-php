# Projet de Rattrapage PHP8 MVC From Scratch

Ce projet est une application PHP développée en respectant l'architecture MVC (Modèle-Vue-Contrôleur). L'objectif est de créer une application permettant d'enregistrer des véhicules, de valider les données, et d'afficher des messages de succès ou d'erreur en fonction du traitement.

---

## 📝 Fonctionnalités
1. **Formulaire d'enregistrement des véhicules** : 
   - Informations collectées : marque, modèle, année, motorisation, photo, véhicule de collection.
  
2. **Validation des données** :
   - Vérification des champs obligatoires, des formats (fichiers, chaînes, etc.), et des contraintes (tailles, valeurs minimales/maximales).
  
3. **Messages de retour** :
   - Affichage des erreurs directement sous les champs en cas d'échec.
   - Redirection vers une page de succès après un enregistrement réussi.
  
4. **Migration de base de données** :
   - Script pour exécuter toutes les migrations ou une migration spécifique.

---

## 🛠️ Architecture du Projet
```
.
├── app
│   ├── Controllers/        # Gère la logique métier (VehiculeController)
│   ├── Core/               # Contient les outils principaux (Router, Validator, etc.)
│   ├── Models/             # Gestion de la base de données (Vehicule.php)
│   ├── Views/              # Pages HTML affichées à l'utilisateur
│   └── routes.php          # Définition des routes
├── database/
│   └── migrations/         # Scripts SQL pour créer les tables
├── docker/                 # Configuration Docker
├── public/                 # Fichiers publics accessibles (index.php, uploads, CSS, JS)
├── scripts/                # Scripts utilitaires (migrate.php)
└── vendor/                 # Dépendances gérées par Composer
```

---

## 🚀 Installation et Configuration

### Prérequis
- Docker & Docker Compose
- PHP 8.2 ou supérieur
- Composer

### Étapes d'installation
1. **Cloner le projet** :
   ```bash
   git clone git@github.com:ysh4me/rattrapage-php.git
   cd rattrapage-php
   ```

2. **Installer les dépendances** :
   ```bash
   composer install
   ```

3. **Configurer les variables d'environnement** :
   - Copier le ficher `.env.exemple` à la racine du projet et le renommer `.env` :
    ```
    MYSQL_DATABASE=databasename
    MYSQL_ROOT_PASSWORD=password
    MYSQL_USER=username
    MYSQL_PASSWORD=password
    DB_HOST=dbhost
    DB_NAME=databasename
    ```

4. **Lancer les conteneurs Docker** :
   ```bash
   docker compose up --build
   ```

5. **Exécuter les migrations** :
   - Pour toutes les migrations :
     ```bash
     docker compose exec app php /var/www/html/scripts/migrate.php
     ```
   - Pour une migration spécifique :
     ```bash
     docker compose exec app php /var/www/html/scripts/migrate.php 0001_vehicules.sql
     ```

---

## ⚙️ Fonctionnement des Routes

| Méthode | URL                  | Action                        | Description                                 |
|---------|----------------------|-------------------------------|---------------------------------------------|
| GET     | `/vehicule/add`      | VehiculeController@create     | Affiche le formulaire d'enregistrement      |
| POST    | `/vehicule/store`    | VehiculeController@store      | Traite les données du formulaire            |
| GET     | `/vehicule/success`  | VehiculeController@success    | Affiche un message de succès                |

---

## 📂 Base de Données

### Structure de la table `vehicules`
```sql
CREATE TABLE IF NOT EXISTS vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(30) NOT NULL,
    model VARCHAR(30) NOT NULL,
    year INT NOT NULL,
    engine ENUM('diesel', 'unleaded', 'electric') NOT NULL,
    photo VARCHAR(255) NOT NULL,
    collection BOOLEAN NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 🛠️ Développement

### Validation des données
La validation des données est effectuée via la classe `Validator` :
- **Champs obligatoires** : `required`
- **Longueur minimale/maximale** : `min:3|max:30`
- **Valeurs numériques** : `integer|min_value|max_value`
- **Fichiers** : `file|type:image/jpeg,image/png|max_size:10`
- **Valeurs spécifiques** : `in:diesel,unleaded,electric`

---
