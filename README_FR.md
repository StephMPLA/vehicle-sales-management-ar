# Vehicle Sales Management AR

## Statut
Développement actif — projet de démonstration pour portfolio.

Vehicle Sales Management AR est une application web basée sur Symfony permettant de gérer un catalogue de véhicules à vendre. Elle s’appuie sur une architecture backend structurée et intègre des fonctionnalités modernes comme la visualisation 3D et la réalité augmentée lorsque disponible.

Ce projet est réalisé comme démonstration technique pour un portfolio destiné aux recruteurs. Il met l’accent sur l’architecture backend, la modélisation métier, la structuration des données et les bonnes pratiques de sécurité.

---

## Description fonctionnelle du projet

L’application simule une plateforme de vente de véhicules neufs et d’occasion.

Elle permet la consultation d’un catalogue, la recherche par marque ou modèle, l’affichage de fiches véhicules détaillées avec images, caractéristiques techniques, et, lorsque disponible, visualisation 3D et aperçu en réalité augmentée.

Le projet vise à démontrer une implémentation réaliste de logique métier dans une application Symfony structurée.

---

## Périmètre fonctionnel

L’application simule une plateforme de vente de véhicules à des fins de démonstration.

---

## Visiteurs publics

- parcourir les véhicules disponibles

- rechercher par marque ou modèle

- consulter la fiche détaillée d’un véhicule

- voir les images et caractéristiques

- utiliser la visualisation 3D et la réalité augmentée si disponibles

Les visiteurs ne peuvent pas réserver de véhicule.

---

## Utilisateurs enregistrés

- accéder à un espace personnel
- gérer des documents requis (fonction de démonstration)
- contacter le vendeur via une messagerie interne (fonction optionnelle)
- envoyer une demande de réservation pour un véhicule

---

## Règles de vente

La plateforme ne gère pas le paiement en ligne.  
Les transactions sont supposées être finalisées hors ligne (en agence).

Les utilisateurs peuvent envoyer une demande de réservation.  
La validation de la réservation est effectuée par l’administrateur.

---

## Administrateur

L’administrateur peut :

- créer des véhicules
- modifier des véhicules
- supprimer des véhicules
- importer des images
- importer des modèles 3D optionnels
- sélectionner la marque et le carburant depuis des listes contrôlées
- indiquer si le véhicule est neuf ou d’occasion
- consulter les clients enregistrés
- valider ou refuser une demande de réservation

---

## Objectifs

- construire une application Symfony structurée

- concevoir un schéma de base de données propre pour la gestion d’un catalogue de véhicules

- implémenter des opérations CRUD complètes

- appliquer les bonnes pratiques backend

- intégrer la visualisation 3D de véhicules

- ajouter un aperçu en réalité augmentée via un visualiseur AR web

- démontrer une configuration sécurisée de l’application

---

## Stack technique
### Backend

- PHP 8.3

- Symfony 7.4.5

- Doctrine ORM

---

### Frontend

- Twig

- Tailwind CSS utilisé avec le composant Symfony AssetMapper pour le style

Ce projet n’utilise pas de pipeline de build Tailwind.

La configuration npm et le fichier tailwind.config.js sont présents uniquement pour l’outillage local de développement afin d’activer l’autocomplétion et la validation des classes Tailwind dans PhpStorm.

Aucune étape de build Node n’est nécessaire pour exécuter le projet.

---

### Base de données

- PostgreSQL / MySQL

---

## 3D / Réalité augmentée

- visualiseur 3D web

- modèles GLB de véhicules

- aperçu en réalité augmentée

---

## Architecture de la base de données

Le modèle logique de données (MLD) ainsi que son explication détaillée sont disponibles dans la documentation d’architecture :

- Diagramme MLD : `docs/architecture/mld-final.png`
- Explication du modèle (EN) : `docs/architecture/mld-explanation.md`
- Explication du modèle (FR) : `docs/architecture/mld-explanation_FR.md`

Cette documentation présente les choix de modélisation métier et la logique du workflow de réservation.

---

## Fonctionnalités (prévues / en cours)

- gestion du catalogue de véhicules

- interface CRUD administrateur

- relations marque / modèle / catégorie

- gestion d’images et de modèles 3D

- aperçu AR des véhicules

- formulaires sécurisés et validation

- architecture contrôleur / service propre

---

## Note de sécurité

Les fichiers de configuration d’environnement ne sont pas versionnés dans le dépôt.

Utilisez .env.local pour votre configuration locale.

Un fichier modèle est fourni :

.env.example

Copiez-le pour créer votre configuration locale :

```bash
cp .env.example .env.local
