# Vehicle Sales Management AR

Projet de démonstration orienté recruteur, développé avec **Symfony**, visant à présenter une architecture backend propre, des workflows CRUD d’administration, et un domaine réaliste de gestion de catalogue de véhicules.  
Le projet inclut également un endpoint **API REST** ciblé pour permettre des mises à jour dynamiques de l’interface sans rechargement de page.

L’application permet à un administrateur de gérer un catalogue de véhicules, les données de référence associées, des demandes de réservation, et d’afficher des modèles en 3D / AR. Un tableau de bord admin affiche des KPI mis à jour dynamiquement après certaines actions.

---

## Objectif du projet

Ce projet a été réalisé comme **projet portfolio technique** afin de démontrer des compétences pratiques en développement backend Symfony sur un cas métier réaliste.

Il met en avant :

- Architecture Symfony MVC
- CRUD d’administration
- Modélisation d’entités Doctrine
- Utilisation des Symfony Forms
- Pattern service (couche métier/persistance)
- Suppression sécurisée
- Intégration REST partielle
- Mise à jour UI via AJAX sans rechargement

---

## Vue d’ensemble de l’architecture

Le projet repose principalement sur une **architecture Symfony MVC** pour les pages et formulaires, combinée avec une **petite couche API REST** pour certaines actions dynamiques.

### Couche MVC

- Controllers — gèrent les pages et workflows d’administration
- Entités — objets métier mappés avec Doctrine ORM
- Repositories — accès base de données
- Symfony Forms — formulaires liés aux entités
- Twig — rendu de l’interface admin
- Services — encapsulent les opérations create / update / delete

Cette organisation permet de garder des controllers légers et un code maintenable.

---

## Couche REST (usage ciblé)

Un endpoint REST est utilisé pour la suppression d’un véhicule :

- `DELETE /api/admin/vehicles/{id}`
- Requête JSON avec token CSRF
- Suppression via la couche service
- Appelé via `fetch()` en JavaScript
- Ligne supprimée dynamiquement dans le tableau
- KPI “nombre de véhicules” mis à jour via API
- Aucun rechargement de page

Cela démontre une utilisation pratique de REST en complément du MVC.

---

## Fonctionnalités principales

- Gestion du catalogue véhicules (admin)
- Création et édition via Symfony Forms
- Gestion des données de référence (marque, catégorie, carburant, transmission, statut)
- Suivi du statut des véhicules
- Entité et workflow de demande de réservation
- Dashboard admin avec KPI
- Suppression sécurisée via REST + AJAX
- Mise à jour dynamique des KPI après suppression
- Fixtures Doctrine pour jeu de données démo
- Gestion optionnelle d’images véhicule
- Support prévisualisation 3D / AR
- Contrôle d’accès par rôles
- Gotenberg (microservice de génération PDF)


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

Les relations Doctrine sont correctement mappées avec contraintes et associations.

Un diagramme UML est fourni pour documenter la structure du domaine.

---

## Sécurité

- Composant Symfony Security
- Contrôle d’accès par rôles (ROLE_ADMIN / ROLE_USER)
- Routes admin protégées par attributs
- Protection CSRF sur formulaires
- Validation CSRF sur endpoint REST delete
- Suppression sécurisée (token + rôle)
- Redirection post-login selon rôle

---

## Points techniques mis en avant

- Architecture Symfony MVC + couche service
- Doctrine ORM avec relations multiples
- Symfony Forms liés aux entités
- Endpoint REST DELETE
- Échanges JSON
- Suppression AJAX via fetch
- Synchronisation UI après mutation serveur
- Rafraîchissement KPI via API
- Séparation des responsabilités

---

## Stack technique

- PHP 8.3
- Symfony 7.x
- Doctrine ORM
- MySQL
- Twig
- Symfony Forms
- Symfony Security
- Doctrine Fixtures Bundle
- Tailwind CSS (interface admin)
- JavaScript natif (fetch / AJAX)

---

## Génération de PDF

L’application intègre **Gotenberg** afin de générer des documents PDF professionnels.

Les fiches clients peuvent être exportées en PDF directement depuis le tableau de bord administrateur.

---

## Installation

```bash
git clone https://github.com/StephMPLA/vehicle-sales-management-ar.git
cd vehicle-sales-management-ar

# Install PHP dependencies
composer install

# Configure environment
cp .env .env.local
# configure database credentials if needed

# Create database
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

# Start external services (PDF microservice)
docker compose up -d

# Start Symfony server
symfony serve
