# Database Model — Vehicle Sales Management AR

This document explains the logical database model (MLD) used in this project.

The goal of the schema is to support a vehicle sales demonstration platform including a catalog, a reservation request workflow, multiple images per vehicle, and optional 3D / AR visualization.

The model was designed to stay simple, consistent with the business needs, and easy to implement with Symfony and Doctrine ORM.

---

## General approach

The database structure is organized around four main areas:

- vehicle catalog
- users
- reservation requests
- media resources (images)

Reference tables such as brand, fuel type, and category are separated to keep data consistent and avoid free-text duplication.

---

## Main entities

### Vehicle

Represents a vehicle listed in the catalog.

Each vehicle is linked to a brand, a fuel type, and a category.

It stores both technical and business data such as year, price, transmission, weight, description, condition (new or used), and a status (available, reserved, sold).

A 3D model path can also be stored when AR preview is available.

A vehicle can have multiple images and multiple reservation requests.

---

### User

Represents a registered user or administrator.

Stores identity and contact information.  
A role system is used to distinguish administrators from standard users.

A user can create multiple reservation requests.

---

### ReservationRequest

Represents a reservation request made by a user for a vehicle.

This table is used to keep request history and support an admin validation workflow.

Each request has a status: pending, approved, or refused.

Even though only one reservation can be approved per vehicle, multiple requests are allowed at the database level. Conflict prevention is handled by application business logic.

---

### VehicleImage

Stores multiple images for each vehicle.

A display order field is used to control image ordering in the frontend carousel.

---

## Modeling choices

- Reservation requests are stored in a separate entity to keep history and workflow traceability
- The vehicle status (available / reserved / sold) is stored directly in the Vehicle table to indicate its current state and control allowed user actions.
- Images are normalized into a dedicated table to support multiple visuals
- Reference tables (Brand, Fuel, Category) ensure controlled and consistent values
