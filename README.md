# Vehicle Sales Management AR

Vehicle Sales Management AR is a Symfony-based web application designed to manage a vehicle sales catalog, with structured backend architecture and modern interactive features including 3D model visualization and Augmented Reality preview.

This project is built as a technical portfolio demonstration focusing on backend development, clean architecture, database modeling, and secure web practices.

---

## Objectives

- Build a structured Symfony application
- Design a clean database schema for vehicle catalog management
- Implement CRUD operations
- Apply backend best practices
- Integrate 3D vehicle visualization
- Add Augmented Reality preview using web AR viewer
- Demonstrate secure configuration practices

---

## Tech Stack

**Backend**
- PHP 8.3
- Symfony 7.4.5
- Doctrine ORM

**Frontend**
- Twig
  Tailwind CSS is used together with Symfony AssetMapper for styling.

This project does not use a Tailwind build pipeline.
The npm setup and tailwind.config.js file are included only for local development tooling, in order to enable Tailwind CSS autocompletion and class validation inside PhpStorm.

No Node-based build step is required to run the project.

**Database**
- PostgreSQL / MySQL 

**3D / AR**
- Web model viewer
- GLB vehicle models
- Augmented Reality preview

---

## Features (planned / in progress)

- Vehicle catalog management
- Admin CRUD interface
- Brand / model / category relations
- Image and 3D model support
- AR vehicle preview
- Secure forms & validation
- Clean controller/service architecture

---

## Security Note

Environment configuration files are not versioned in this repository.

Use `.env.local` for your local configuration.

A template environment configuration file is provided:

.env.example

Copy it to create your local configuration:

```bash
cp .env.example .env.local
