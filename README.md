# Vehicle Sales Management AR

Recruiter-focused demo project built with **Symfony** to showcase a clean **MVC backend architecture**, entity modeling, admin CRUD workflows, and a reservation flow for a vehicle sales platform.

The application allows users to browse vehicles, manage catalog data, handle reservation requests, and preview selected models in augmented reality (3D). A UML class diagram is included to document the domain structure.

---

## Project Goals

This project was created as a **technical portfolio piece** to demonstrate:

- Clean Symfony MVC architecture
- Doctrine entity modeling and relationships
- Admin CRUD workflows
- Secure form handling with Symfony Forms
- CSRF protection and role-based access
- Maintainable backend structure
- Recruiter-readable code organization
- Realistic domain dataset with fixtures

---

## Architecture

The project follows a **standard Symfony MVC structure**.

### Layers

- **Controllers** — handle HTTP requests and admin workflows
- **Entities** — represent core business objects
- **Repositories** — encapsulate database access (Doctrine)
- **Forms** — Symfony Form components bound directly to entities
- **Twig templates** — admin UI rendering

This approach favors clarity, maintainability, and fast development while staying aligned with common Symfony production practices.

---

## Domain Model

Core entities include:

- Vehicle
- Brand
- Category
- Fuel
- Transmission
- VehicleStatus
- ReservationRequest
- VehicleImage
- User (admin / client)

Relationships are modeled using Doctrine ORM with proper constraints and associations.

A UML class diagram is included to document and explain the domain structure.

---

## Features

- Vehicle catalog management (admin)
- Brand / category / fuel / transmission management
- Vehicle status tracking
- Reservation request workflow
- Admin dashboard with KPIs
- Secure create/edit/delete operations (CSRF protected)
- Symfony Forms bound to entities
- Doctrine fixtures for reproducible datasets
- Optional vehicle image handling
- 3D / AR model preview support
- Admin role-based access control

---

## Security

- Symfony Security component
- Role-based access (ROLE_ADMIN / ROLE_USER)
- CSRF protection on sensitive operations
- Secure delete via POST + token
- Authentication success handler (role-based redirect)

---

## Tech Stack

- PHP 8.3
- Symfony 7.x
- Doctrine ORM
- MySQL
- Twig
- Symfony Forms
- Symfony Security
- Doctrine Fixtures Bundle
- Tailwind CSS (admin UI)

---

## Installation

```bash
git clone https://github.com/StephMPLA/vehicle-sales-management-ar.git
cd vehicle-sales-management-ar

composer install

cp .env .env.local
# configure database credentials

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

symfony serve
