# Modèle de données — Vehicle Sales Management AR

Ce document présente le modèle logique de données (MLD) utilisé dans le projet.

L’objectif est de structurer une base de données adaptée à une plateforme de démonstration de vente de véhicules, avec gestion de catalogue, demandes de réservation, images multiples et visualisation 3D/AR optionnelle.

Le modèle a été pensé pour rester simple, cohérent métier, et facilement exploitable avec Symfony et Doctrine.

---

## Principes généraux

La base est organisée autour de quatre blocs principaux :

- le catalogue de véhicules
- les utilisateurs
- les demandes de réservation
- les ressources médias (images)

Les tables de référence (marque, carburant, catégorie) sont séparées afin de garantir la cohérence des données et faciliter les relations.

---

## Entités principales

### Vehicle

Représente un véhicule présent dans le catalogue.

Chaque véhicule est lié à une marque, un type de carburant et une catégorie.

Il contient les informations techniques et commerciales : année, prix, transmission, poids, description, état (neuf ou occasion), ainsi qu’un statut (disponible, réservé, vendu).

Un chemin vers un modèle 3D peut être stocké lorsqu’une visualisation AR est disponible.

Un véhicule peut avoir plusieurs images et plusieurs demandes de réservation.

---

### User

Représente un utilisateur enregistré sur la plateforme.

Contient les informations d’identité et de contact.  
Un système de rôles permet de distinguer les administrateurs des utilisateurs standards.

Un utilisateur peut effectuer plusieurs demandes de réservation.

---

### ReservationRequest

Représente une demande de réservation faite par un utilisateur pour un véhicule.

Cette table permet de conserver l’historique des demandes et de gérer le workflow de validation côté administrateur.

Chaque demande possède un statut : en attente, validée ou refusée.

Même si un véhicule ne peut être réservé qu’une seule fois au final, plusieurs demandes peuvent exister — la logique métier côté application empêche les conflits.

---

### VehicleImage

Permet de stocker plusieurs images par véhicule.

Un champ d’ordre d’affichage est utilisé pour garantir l’ordre des images dans le carousel côté interface.

---

## Choix de modélisation

- Les demandes de réservation sont séparées du véhicule pour conserver l’historique
- Le statut du véhicule est stocké directement dans la table Vehicle pour simplifier les filtres
- Les images sont isolées dans une table dédiée pour supporter plusieurs visuels
- Les tables de référence évitent les valeurs libres et les incohérences
