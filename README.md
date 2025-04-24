# 🎟️ Event Booking API

## Overview

This is a Laravel 12-based RESTful API designed for managing events, attendees, and bookings. It allows users to create and manage events, register attendees, and handle ticket bookings. The application uses **Laravel Sail** (Docker-based environment) to simplify setup and deployment.

---

## ✨ Features

- ✅ Create, update, and delete events  
- ✅ Register attendees for events  
- ✅ Book event tickets (includes attendee and payment info)  
- ✅ RESTful API with clean JSON responses  
- ✅ Built-in automated testing (PHPUnit)  

---

## 🧰 Technologies

- Laravel 12 (PHP Framework)  
- PHP 8.2  
- MySQL  
- Docker (Laravel Sail)  
- PHPUnit for Testing

---

## 🚀 Getting Started

### 🔧 Prerequisites

Ensure you have the following installed:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/)
- (Optional) Node.js and NPM (if you're planning to add front-end tasks)

---

## 📦 Installation & Setup

### 1. Clone the repository

```bash
git clone https://github.com/neeraj8299/phpAssessment.git
cd phpAssessment
```

### 2. Copy the environment file

```bash
cp .env.example .env
```

### 3. Start Laravel Sail
> If you haven't installed dependencies yet, do this first:

```bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html \
  -w /var/www/html \
  laravelsail/php82-composer:latest \
  composer install
```

```bash
./vendor/bin/sail up -d
```

> If you’re running Sail for the first time or after changes:

```bash
./vendor/bin/sail up --build -d
```

---

### 4. Generate application key

```bash
./vendor/bin/sail artisan key:generate
```

---

### 5. Run database migrations

```bash
./vendor/bin/sail artisan migrate
```

---

## 🥪 Running Tests

Run all the automated test cases using PHPUnit inside Sail:

```bash
./vendor/bin/sail test
```

> Or use the artisan test command (Laravel 8+):

```bash
./vendor/bin/sail artisan test
```

---

## 🥪 API Testing with Postman
You can test the endpoints using Postman. Import the collection:

👉 [Event Booking API Collection (Postman)](https://elements.getpostman.com/redirect?entityId=32389459-75ebb38d-178a-4cd4-b837-cb0b15babeba&entityType=collection)

---

## 🛠 Troubleshooting

- Make sure Docker containers are running:  
  `docker ps`
- If migrations fail, check your `.env` database credentials and rebuild containers.
- To stop Sail:  
  `./vendor/bin/sail down`