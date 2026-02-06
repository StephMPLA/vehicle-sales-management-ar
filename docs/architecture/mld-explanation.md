# Data Model — Vehicle Sales Management AR

This document describes the logical data model (LDM) of the **Vehicle Sales Management AR** project.

The goal is to structure a consistent database for a vehicle sales demonstration platform including:

- a vehicle catalog
- user management
- reservation requests
- multiple image management
- optional 3D / AR visualization

---

# Modeling Principles

The database is organized around four functional blocks:

- **Vehicle catalog**
- **Users**
- **Reservation requests**
- **Media resources**

Reusable business values (brand, fuel, status, transmission, etc.) are stored in **reference tables**.

---

# Main Entities

---

## Vehicle

Represents a vehicle available in the catalog.

Each vehicle contains technical and commercial information:

- name
- year
- price
- horsePower
- weight
- description
- creation date
- optional 3D model path (AR visualization)

A vehicle is linked to several reference tables:

- one brand
- one fuel type
- one category
- one transmission type
- one commercial condition (new / used)
- one availability status

Relations:

- a vehicle can have multiple images or none (OneToMany — 0..n)
- a vehicle can receive multiple reservation requests (OneToMany — 0..n)

---

## User

Represents a platform user.

Contains identity and contact information:

- first name
- last name
- email
- phone
- postal code
- city
- creation date
- hashed password
- security roles

A user can create multiple reservation requests (OneToMany — 0..n).

Roles allow distinction between:

- administrator
- standard user

---

## ReservationRequest

Represents a reservation request made by a user for a vehicle.

This entity allows:

- keeping request history
- managing the validation workflow
- avoiding business data deletion
- tracking actions

Each request is linked to:

- one user
- one vehicle
- one reservation status

Multiple requests can exist for the same vehicle.  
Application business logic handles conflicts and state transitions.

---

## VehicleImage

Stores images associated with vehicles.

Each image is linked to exactly one vehicle (ManyToOne — 1).  
A vehicle can have multiple images or none (OneToMany — 0..n).

Main fields:

- image file path
- alternative text (accessibility / SEO)
- display order

Display order ensures correct ordering in galleries or carousels.

Images are automatically deleted when detached from their vehicle (orphan removal).

---

# Reference Tables

The following tables store controlled values shared by multiple vehicles.

---

## Brand

List of vehicle brands.

Examples: BMW, Audi, Tesla…

Relation:

Brand → Vehicle : OneToMany — 0..n  
Vehicle → Brand : ManyToOne — 1

---

## Fuel

Fuel types.

Examples: gasoline, diesel, electric…

Relation:

Fuel → Vehicle : OneToMany — 0..n  
Vehicle → Fuel : ManyToOne — 1

---

## Category

Examples: SUV, sedan, utility…

Relation:

Category → Vehicle : OneToMany — 0..n  
Vehicle → Category : ManyToOne — 1

---

## VehicleTransmission

Relation:

VehicleTransmission → Vehicle : OneToMany — 0..n  
Vehicle → VehicleTransmission : ManyToOne — 1

---

## VehicleStatus

Relation:

VehicleStatus → Vehicle : OneToMany — 0..n  
Vehicle → VehicleStatus : ManyToOne — 1

---

## ReservationStatus

Relation:

ReservationStatus → ReservationRequest : OneToMany — 0..n  
ReservationRequest → ReservationStatus : ManyToOne — 1
