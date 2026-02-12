# Vehicle Sales Management AR

Recruiter-focused demo project built with **Symfony** to showcase backend architecture, **Domain-Driven Design (DDD)** principles, entity modeling, and a reservation workflow for a vehicle sales platform.

The application allows users to browse vehicles, check availability, submit reservation requests, and preview selected models in augmented reality (3D). A UML class diagram is included to document and explain the domain design.

---

## Project Goals

This project was designed as a **technical portfolio piece** to demonstrate:

- Clean backend architecture with Symfony
- Domain-Driven Design (DDD) approach
- Rich domain modeling with Doctrine ORM
- Structured reservation workflow
- DTO usage for input handling
- Separation of concerns (Controller / Domain / Persistence)
- Maintainable and extensible codebase
- Recruiter-readable technical structure

---

## Architecture & DDD Approach

The project follows a **DDD-inspired structure** with a strong focus on domain clarity and responsibility separation.

### Domain Modeling

Core domain entities include:

- Vehicle
- Brand
- Category
- Fuel
- Transmission
- VehicleStatus
- ReservationRequest
- VehicleImage

The domain model is designed around business meaning rather than technical shortcuts.

### Key Design Choices

- Entities centered on business concepts
- Doctrine repositories used as persistence layer abstractions
- Progressive introduction of DTO pattern
- Fixtures reflect realistic domain data
- Business rules expressed at domain/entity level where relevant
- UML class diagram included for domain documentation

---

## Features

- Vehicle catalog browsing
- Structured domain entities and relationships
- Brand / category / fuel / transmission management
- Vehicle availability tracking
- Reservation request workflow
- Optional vehicle image handling
- 3D / AR model preview support
- Doctrine fixtures for reproducible datasets
- UML class diagram included

---

## Tech Stack

- PHP 8.3
- Symfony 7.x
- Doctrine ORM
- MySQL
- Twig
- Symfony Forms
- Doctrine Fixtures Bundle

---

## Installation

```bash
git clone https://github.com/your-username/vehicle-sales-management-ar.git
cd vehicle-sales-management-ar

composer install

cp .env .env.local
# configure database credentials

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

symfony serve
