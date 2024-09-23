# Laravel API with Job Queue, Database, and Event Handling

## Introduction

This project demonstrates a REST API in Laravel that handles data submission using job queues, database operations, and event handling. The API accepts a POST request, validates the data, processes it via a job queue, stores it in a database, and triggers an event upon successful submission.

## Requirements

- PHP 8.0+
- Docker (for Laravel Sail)
- Composer

## Setup Instructions

### 1. Clone the repository

### 2. Install dependencies using Composer

`composer install`

### 3. Copy `.env.example` to `.env`

`cp .env.example .env`

### 4. Install Laravel Sail

`composer require laravel/sail --dev`

### 5. Start Laravel Sail

`./vendor/bin/sail up`

This will spin up the Docker containers (including MySQL for the database).

### 6. Edit `.env`

At this moment we need only to generate key

`./vendor/bin/sail artisan key:generate`


### 7. Run database migrations

Once Sail is running, run the following command to create the necessary tables:

`./vendor/bin/sail artisan migrate`

### 8. Queue Worker

Open another terminal and run the queue worker to process the jobs:

`./vendor/bin/sail artisan queue:work`

### 9. Testing the API

You can test the API by sending a POST request to the `/api/submit` endpoint using the following cURL command:
```bash
curl -X POST http://localhost/api/submit \
-H "Content-Type: application/json" \
-d '{"name": "John Doe", "email": "john.doe@example.com", "message": "This is a test message."}'
```

### 10. Unit Testing

To run the unit tests, use the following command:

`./vendor/bin/sail artisan test`

# Project Summary
## This project includes:

 * Job Queues: Data submissions are processed asynchronously using Laravel Jobs.
 * Event Handling: After successful data saving, an event SubmissionSaved is triggered, and a listener logs the event.
 * Error Handling: Appropriate validation and error handling with status codes.
 * Unit Testing: Basic unit test included to ensure the job is dispatched correctly.
