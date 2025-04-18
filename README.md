
# Event Booking API

## Overview

This is a Laravel-based RESTful API designed to manage events, attendees, and bookings. The API supports various operations such as creating and managing events, handling attendee registrations, and booking tickets for events. The system is built using Laravel Sail, a light-weight command-line interface for Docker, to ensure easy setup and deployment.

### Features:
- Manage events (create, update, delete).
- Add and update attendees for events.
- Handle bookings for events with details like number of tickets, attendees, and payment information.
- RESTful API endpoints with JSON responses.

## Technologies

- Laravel (PHP framework)
- MySQL
- Docker (Containerization via Laravel Sail)
- PHP 8.2

## Getting Started

### Prerequisites

Before you begin, ensure you have the following installed on your system:

- Docker
- Docker Compose
- Node.js and NPM (for front-end tasks, if applicable)

### Installation

Clone the repository:

```bash
git clone https://github.com/your-username/event-booking-api.git
cd event-booking-api
```

#### Setting up the environment

1. Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

2. Install Composer dependencies inside a Docker container (if `vendor/` doesn't exist):

```bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html \
  -w /var/www/html \
  laravelsail/php82-composer:latest \
  composer install
```

#### Starting the Laravel Sail environment

Once the dependencies are installed, start the development containers:

```bash
./vendor/bin/sail up -d
```

> If you're running Sail for the first time or made changes to your Docker setup, you can build the containers:

```bash
./vendor/bin/sail up --build
```

### Database Setup

Once the containers are up and running, run the migrations to set up the database:

```bash
./vendor/bin/sail artisan migrate
```

### Testing the API

You can test the API using Postman. Import the collection from the following link:

- [Event Booking API Collection (Postman)](https://elements.getpostman.com/redirect?entityId=32389459-75ebb38d-178a-4cd4-b837-cb0b15babeba&entityType=collection)
