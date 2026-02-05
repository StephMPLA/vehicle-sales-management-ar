# Vehicle Sales Management AR

## Status
Active development — portfolio demonstration project.

Vehicle Sales Management AR is a Symfony-based web application designed to manage a vehicle sales catalog. It relies on a structured backend architecture and includes modern interactive features such as 3D visualization and Augmented Reality preview when available.

This project is built as a technical demonstration for a recruiter portfolio. It focuses on backend architecture, domain modeling, data structuring, and secure development practices.

---

## Functional Description

The application simulates a platform for selling new and used vehicles.

It allows browsing a catalog, searching by brand or model, and viewing detailed vehicle pages with images, technical specifications, and — when available — 3D visualization and Augmented Reality preview.

The goal is to demonstrate realistic business logic implementation within a well-structured Symfony application.

---

## Functional Scope

The application simulates a vehicle sales platform for demonstration purposes.

---

## Public Visitors

- browse available vehicles
- search by brand or model
- view vehicle detail pages
- view images and specifications
- use 3D visualization and AR preview when available

Visitors cannot reserve vehicles.

---

## Registered Users

- access a personal account
- manage required documents (demonstration feature)
- contact the seller through internal messaging (optional feature)
- send a vehicle reservation request

---

## Sales Rules

Online payment is not implemented.  
Transactions are assumed to be completed offline (in agency).

Users can send reservation requests.  
Reservation validation is performed by the administrator.

---

## Administrator

The administrator can:

- create vehicles
- edit vehicles
- delete vehicles
- upload images
- upload optional 3D models
- select brand and fuel type from controlled lists
- mark vehicles as new or used
- view registered clients
- approve or reject a reservation request

---

## Objectives

- build a structured Symfony application
- design a clean database schema for vehicle catalog management
- implement full CRUD operations
- apply backend best practices
- integrate vehicle 3D visualization
- add Augmented Reality preview via a web AR viewer
- demonstrate secure application configuration

---

## Technical Stack

### Backend

- PHP 8.3
- Symfony 7.4.5
- Doctrine ORM

---

### Frontend

- Twig
- Tailwind CSS via Symfony AssetMapper

This project does not use a Tailwind build pipeline.

The npm setup and the `tailwind.config.js` file are included only for local development tooling in order to enable Tailwind CSS autocompletion and class validation in PhpStorm.

No Node-based build step is required to run the project.

---

### Database

- PostgreSQL / MySQL

---

## 3D / Augmented Reality

- web 3D viewer
- GLB vehicle models
- Augmented Reality preview

---

## Features (planned / in progress)

- vehicle catalog management
- admin CRUD interface
- brand / model / category relations
- image and 3D model management
- AR vehicle preview
- secure forms and validation
- clean controller/service architecture

---

## Security Note

Environment configuration files are not versioned in the repository.

Use `.env.local` for your local configuration.

A template environment configuration file is provided:

.env.example

Copy it to create your local configuration:

```bash
cp .env.example .env.local
