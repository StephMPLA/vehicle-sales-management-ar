# Vehicle Sales Management AR

Recruiter-focused demo project built with **Symfony** to demonstrate a clean backend architecture, admin CRUD workflows, and a realistic vehicle catalog domain.  
The project also includes a small REST API endpoint used for dynamic UI updates without page reload.

The application allows administrators to manage a vehicle catalog, handle related reference data, process reservation requests, and preview selected vehicles in 3D / AR. An admin dashboard displays KPIs that update dynamically after certain actions.

---

## Project Purpose

This project was created as a **technical portfolio project** to showcase practical Symfony backend skills on a realistic use case.

It demonstrates:

- Symfony MVC architecture
- Admin CRUD operations
- Doctrine entity modeling and relationships
- Symfony Forms usage
- Service layer pattern
- Secure delete workflow
- Partial REST API integration
- AJAX UI updates without reload
- Clean and readable code structure

---

## Architecture Overview

The project mainly follows a **Symfony MVC architecture** for pages and forms, combined with a **targeted REST API layer** for dynamic operations.

### MVC Layer

- Controllers — handle admin pages and workflows
- Entities — domain objects mapped with Doctrine ORM
- Repositories — database access logic
- Symfony Forms — bound directly to entities
- Twig templates — admin interface rendering
- Services — encapsulate persistence operations (create / update / delete)

This keeps controllers thin and improves maintainability.

### REST API (Targeted Usage)

A REST endpoint is implemented for vehicle deletion:

- `DELETE /api/admin/vehicles/{id}`
- JSON request with CSRF token
- Deletion handled via service layer
- Triggered using JavaScript `fetch()`
- Table row removed dynamically in the UI
- Vehicle KPI counter refreshed via API
- No full page reload required

This demonstrates practical REST usage alongside MVC.

---

## Main Features

- Admin vehicle catalog management
- Create and edit vehicles with Symfony Forms
- Reference data management (brand, category, fuel, transmission, status)
- Vehicle status tracking
- Reservation request entity and workflow
- Admin dashboard with KPI counters
- Secure delete via REST + AJAX
- Live KPI refresh after deletion
- Doctrine fixtures for demo dataset
- Optional vehicle image handling
- 3D / AR model preview support
- Role-based access control

---

## Domain Model

Core entities include:

- Vehicle
- Brand
- Category
- Fuel
- VehicleTransmission
- VehicleStatus
- VehicleImage
- ReservationRequest
- User

Doctrine relationships are properly mapped with constraints and associations.

A UML class diagram is included to document the domain structure.

---

## Security

- Symfony Security component
- Role-based access control (ROLE_ADMIN / ROLE_USER)
- Admin routes protected with attributes
- CSRF protection on forms
- CSRF validation on REST delete endpoint
- Secure delete workflow (token + role check)
- Authentication success redirect by role

---

## Technical Highlights

- Symfony MVC + service layer pattern
- Doctrine ORM with multiple relationships
- Entity-driven Symfony Forms
- REST DELETE endpoint
- JSON request/response handling
- AJAX delete with fetch API
- Dynamic UI synchronization after server mutation
- Dashboard KPI refresh via API call
- Clean separation of concerns

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
- Vanilla JavaScript (fetch / AJAX)

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
