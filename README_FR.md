# Vehicle Sales Management AR

Projet backend orienté recruteur développé avec **Symfony**
afin de démontrer une architecture propre, des workflows
d’administration et un domaine métier réaliste de gestion
de catalogue de véhicules.

L’application permet à un administrateur de gérer des véhicules,
des données de référence, des demandes de réservation
et d’afficher des modèles en **3D / Réalité Augmentée**.

---

## Objectif du projet

Ce projet a été réalisé comme **projet portfolio technique**
afin de présenter des compétences concrètes en développement
backend Symfony sur un cas proche d’une application réelle.

Il met en avant :

- Architecture Symfony MVC claire
- Modélisation métier avec Doctrine ORM
- Pattern Service Layer
- Workflows d’administration sécurisés
- Actions asynchrones via AJAX
- Tableau de bord dynamique
- Code maintenable et typé

---

## Architecture

L’application repose sur une architecture **Symfony MVC**
complétée par une couche de services métier.

### Composants principaux

- Controllers — gestion des workflows admin
- Entities — modèle métier Doctrine
- Repositories — accès aux données
- Services — logique applicative
- Symfony Forms — formulaires liés aux entités
- Twig — interface d’administration
- Endpoints JSON — actions asynchrones (AJAX)

Les contrôleurs restent légers,
la logique métier étant centralisée dans les services.

---

## Qualité du code

- Analyse statique avec **PHPStan (niveau 6)**
- Typage strict et cohérence des valeurs nullables
- Repositories et services fortement typés
- Architecture basée sur une couche de services
- Code maintenable et lisible

✅ Analyse PHPStan sans erreur

---

## Fonctionnalités principales

- Gestion du catalogue véhicules
- Gestion des données de référence  
  (Marque, Catégorie, Carburant, Transmission, Statut)
- Gestion des demandes de réservation
- Dashboard administrateur avec KPI
- Suppression sécurisée via AJAX
- Mise à jour dynamique sans rechargement
- Upload d’images véhicules
- Prévisualisation 3D / AR
- Gestion des rôles utilisateurs

---

## Modèle métier

Entités principales :

- Vehicle
- Brand
- Category
- Fuel
- VehicleTransmission
- VehicleStatus
- VehicleImage
- ReservationRequest
- User

Relations Doctrine correctement définies
avec contraintes et associations.

---

## Sécurité

- Composant Symfony Security
- Gestion des rôles (ROLE_ADMIN / ROLE_USER)
- Routes admin protégées
- Protection CSRF
- Vérification sécurisée des actions sensibles

---

## Génération PDF

Intégration de **Gotenberg**
comme microservice Docker pour générer des PDF.

Processus :

- rendu Twig
- envoi HTML vers Gotenberg
- génération via Chromium
- téléchargement navigateur

---

## Stack technique

- PHP 8.3
- Symfony
- Doctrine ORM
- MySQL
- Docker (Gotenberg)
- Twig
- Symfony Forms
- Symfony Security
- Tailwind CSS
- JavaScript natif (AJAX / fetch)

---

## Installation

```bash
git clone https://github.com/StephMPLA/vehicle-sales-management-ar.git
cd vehicle-sales-management-ar

composer install

cp .env .env.local

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

docker compose up -d

symfony serve
