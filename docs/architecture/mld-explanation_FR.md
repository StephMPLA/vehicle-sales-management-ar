# Modèle de données — Vehicle Sales Management AR

Ce document décrit le modèle logique de données (MLD) du projet **Vehicle Sales Management AR**.

L’objectif est de structurer une base de données cohérente pour une plateforme de démonstration de vente de véhicules intégrant :

- un catalogue de véhicules
- la gestion des utilisateurs
- les demandes de réservation
- la gestion d’images multiples
- la visualisation 3D / AR optionnelle

---

# Principes de modélisation

La base est organisée autour de quatre blocs fonctionnels :

- **Catalogue véhicule**
- **Utilisateurs**
- **Demandes de réservation**
- **Ressources médias**

Les valeurs métier répétables (marque, carburant, statut, transmission, etc.) sont stockées dans des **tables de référence**.

---

# Entités principales

---

## Vehicle

Représente un véhicule présent dans le catalogue.

Chaque véhicule contient les informations techniques et commerciales :

- nom
- année
- prix
- poids
- description
- date de création
- chemin optionnel vers un modèle 3D (visualisation AR)

Un véhicule est lié à plusieurs tables de référence :

- une marque
- un carburant
- une catégorie
- un type de transmission
- une condition commerciale (neuf / occasion)
- un statut de disponibilité

Relations :

- un véhicule peut posséder plusieurs images ou aucune (relation OneToMany — 0..n)
- un véhicule peut recevoir plusieurs demandes de réservation (relation OneToMany — 0..n)

---

## User

Représente un utilisateur de la plateforme.

Contient les informations d’identité et de contact :

- prénom
- nom
- email
- téléphone
- code postal
- ville
- date de création
- mot de passe hashé
- rôles de sécurité

Un utilisateur peut effectuer plusieurs demandes de réservation (relation OneToMany — 0..n).

Les rôles permettent de distinguer :

- administrateur
- utilisateur standard

---

## ReservationRequest

Représente une demande de réservation faite par un utilisateur pour un véhicule.

Cette entité permet :

- de conserver l’historique des demandes
- de gérer le workflow de validation
- d’éviter la suppression de données métier
- de tracer les actions

Chaque demande est liée à :

- un utilisateur
- un véhicule
- un statut de réservation

Plusieurs demandes peuvent exister pour un même véhicule.  
La logique métier applicative gère les conflits et transitions d’état.

---

## VehicleImage

Stocke les images associées aux véhicules.

Chaque image est liée à un seul véhicule (relation ManyToOne — 1).
Un véhicule peut avoir plusieurs images ou aucune (relation OneToMany — 0..n).

Champs principaux :

- chemin du fichier image
- texte alternatif (accessibilité / SEO)
- ordre d’affichage

L’ordre d’affichage permet de contrôler la présentation dans les galeries ou carousels.

Les images sont supprimées automatiquement si elles sont détachées du véhicule (orphan removal).

---

# Tables de référence

Les tables suivantes contiennent des valeurs contrôlées partagées par plusieurs véhicules.

---

## Brand

Liste des marques de véhicules.

Exemples : BMW, Audi, Tesla…

Relation :

Brand → Vehicle : OneToMany — 0..n  
Vehicle → Brand : ManyToOne — 1

## Fuel

Types de carburant.

Exemples : essence, diesel, électrique…

Relation :

Fuel → Vehicle : OneToMany — 0..n  
Vehicle → Fuel : ManyToOne — 1

## Category

Exemples : SUV, berline, utilitaire…

Relation :

Category → Vehicle : OneToMany — 0..n  
Vehicle → Category : ManyToOne — 1

## VehicleTransmission

Relation :

VehicleTransmission → Vehicle : OneToMany — 0..n  
Vehicle → VehicleTransmission : ManyToOne — 1

## VehicleStatus

Relation :

VehicleStatus → Vehicle : OneToMany — 0..n  
Vehicle → VehicleStatus : ManyToOne — 1

## ReservationStatus

Relation :

ReservationStatus → ReservationRequest : OneToMany — 0..n  
ReservationRequest → ReservationStatus : ManyToOne — 1
