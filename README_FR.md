# Vehicle Sales Management AR

Application backend orientée recruteur développée avec **Symfony**,
mettant en avant une architecture propre, des workflows d’administration
sécurisés et un domaine métier réaliste de gestion de catalogue de véhicules.

L’application permet aux administrateurs de gérer des véhicules,
les données de référence associées, les demandes de réservation,
et d’afficher des véhicules avec prévisualisation **3D / Réalité Augmentée**.

---

## Objectif du projet

Ce projet a été conçu comme une **application portfolio technique**
afin de démontrer des compétences concrètes en développement backend Symfony
dans un contexte proche d’une application métier réelle.

Il met en avant :

- Architecture Symfony MVC propre
- Modélisation métier avec Doctrine ORM
- Séparation des responsabilités
- Couche de services dédiée
- Workflows administrateur sécurisés
- Opérations asynchrones via AJAX
- Mise à jour dynamique de l’interface
- Code maintenable, typé et structuré

---

## Architecture

L’application repose sur une architecture **Symfony MVC**
complétée par une **couche de services métier**.

### Composants principaux

- Controllers — gestion des workflows
- Entities — modèle de domaine Doctrine
- Repositories — accès aux données
- Services — logique métier
- Symfony Forms — gestion des formulaires
- Twig — interface d’administration
- API Platform — exposition REST des ressources
- JavaScript (Fetch API) — rendu dynamique côté frontend

Les contrôleurs restent légers tandis que la logique métier
est centralisée dans les services.

---

## Qualité du code

- Analyse statique avec **PHPStan (niveau 6)**
- Typage strict PHP
- Gestion cohérente des valeurs nullables
- Repositories et services typés
- Code lisible et maintenable

✅ PHPStan : 0 erreur

---

## Fonctionnalités principales

- Administration du catalogue de véhicules
- Gestion des données de référence  
  (Marque, Catégorie, Carburant, Transmission, Statut)
- Workflow de demandes de réservation
- Tableau de bord administrateur avec KPI
- Suppressions sécurisées via AJAX
- Mise à jour dynamique sans rechargement
- Upload et gestion d’images véhicules
- Prévisualisation modèles 3D / AR
- Gestion des rôles utilisateurs
- API REST publique via API Platform
- Pagination automatique des véhicules
- Chargement dynamique des données côté frontend
- Tri et filtrage côté serveur

---

## Modèle de domaine

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

Les relations Doctrine sont correctement définies
avec contraintes et associations métier.

---

## Sécurité

- Composant Symfony Security
- Gestion des rôles (ROLE_ADMIN / ROLE_USER)
- Protection des routes administrateur
- Protection CSRF (formulaires & actions API)
- Redirection automatique selon le rôle utilisateur

---

## Génération PDF

L’application intègre **Gotenberg**
comme microservice Docker pour la génération de PDF.

### Fonctionnement

- Rendu Twig HTML
- Envoi vers Gotenberg
- Génération PDF via Chromium
- Streaming du fichier vers le navigateur

---

## Stack technique

- PHP 8.3
- Symfony
- API Platform
- Doctrine ORM
- MySQL
- Docker (Gotenberg)
- Twig
- Symfony Forms
- Symfony Security
- Tailwind CSS
- JavaScript Vanilla (Fetch / AJAX)

---

## Couche API

Le projet expose les ressources métier via **API Platform**.

Fonctionnalités :

- API REST automatique
- Pagination native
- Tri et filtrage
- Serializer Groups
- Consommation frontend via Fetch API
- Architecture découplée backend / frontend

La page d’accueil charge dynamiquement les véhicules
depuis l’API, illustrant une application Symfony moderne
orientée API.

---

## Installation

```bash
git clone https://github.com/StephMPLA/vehicle-sales-management-ar.git
cd vehicle-sales-management-ar

composer install

cp .env .env.local
# configurer la base de données

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

docker compose up -d

symfony serve
