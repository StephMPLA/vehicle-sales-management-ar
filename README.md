# Vehicle Sales Management AR

Recruiter-focused backend project built with **Symfony**
demonstrating clean architecture principles, admin workflows,
and a realistic vehicle catalog domain.

The application allows administrators to manage vehicles,
reference data, reservation requests, and preview vehicles
in **3D / Augmented Reality**.

---

## Project Purpose

This project was developed as a **technical portfolio application**
to showcase real-world Symfony backend development practices.

It demonstrates:

- Clean Symfony MVC architecture
- Doctrine ORM domain modeling
- Service layer pattern
- Secure admin workflows
- AJAX-based asynchronous operations
- Dynamic dashboard updates
- Maintainable and typed backend code

---

## Architecture

The application follows a **Symfony MVC architecture**
combined with a dedicated service layer.

### Main components

- Controllers — admin workflows
- Entities — Doctrine domain model
- Repositories — data access logic
- Services — business operations
- Symfony Forms — entity-driven forms
- Twig — admin interface
- JSON API endpoints — asynchronous admin actions

Controllers remain lightweight while business logic
is centralized inside services.

---

## Code Quality

- Static analysis with **PHPStan (level 6)**
- Strict typing and nullable consistency
- Typed repositories and services
- Service layer architecture
- Maintainable and readable codebase

✅ PHPStan: 0 errors
---

## Main Features

- Vehicle catalog administration
- Reference data management  
  (Brand, Category, Fuel, Transmission, Status)
- Reservation request workflow
- Admin dashboard with KPI counters
- Secure delete operations via AJAX
- Dynamic UI updates without page reload
- Vehicle image upload handling
- 3D / AR model preview support
- Role-based access control

---

## Domain Model

Core entities:

- Vehicle
- Brand
- Category
- Fuel
- VehicleTransmission
- VehicleStatus
- VehicleImage
- ReservationRequest
- User

Doctrine relationships are properly mapped
with constraints and associations.

---

## Security

- Symfony Security component
- Role-based access control (ROLE_ADMIN / ROLE_USER)
- Protected admin routes
- CSRF protection (forms & API actions)
- Authentication redirect by role

---

## PDF Generation

The application integrates **Gotenberg**
as a Dockerized microservice for PDF generation.

Workflow:

- Twig template rendering
- HTML sent to Gotenberg
- PDF generated via Chromium
- File streamed to browser

---

## Tech Stack

- PHP 8.3
- Symfony
- Doctrine ORM
- MySQL
- Docker (Gotenberg)
- Twig
- Symfony Forms
- Symfony Security
- Tailwind CSS
- Vanilla JavaScript (AJAX / fetch)

---

## Installation

```bash
git clone https://github.com/StephMPLA/vehicle-sales-management-ar.git
cd vehicle-sales-management-ar

composer install

cp .env .env.local
# configure database

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

docker compose up -d

symfony serve
