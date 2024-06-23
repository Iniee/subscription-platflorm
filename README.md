# Subscription Platform RESTful APIs

This project implements a simple subscription platform using RESTful APIs in PHP(8.1.10) with MySQL. Users can subscribe to websites and receive email notifications whenever a new post is published on a subscribed website.

## Requirements

-   PHP 7._ or 8._
-   MySQL
-   Composer (for PHP dependency management)
-   Laravel Framework

## Installation Instructions

1. **Clone the repository:**
   git clone https://github.com/Iniee/subscription-platflorm.git
   cd subscription-platform

2. **Install dependencies:**

    composer install

3. **Set up environment variables:**

    - Rename `.env.example` to `.env` and configure your database credentials.
      Update QUEUE_CONNECTION=database
      Then Include Mail Server Key

4. **Run migrations:**

    php artisan migrate

5. **(Optional) Seed initial data:**

    php artisan db:seed or use localhost:8000/api/create/website


6. **Start the development server:**

    php artisan serve
    php artisan queue:table
    php artisan migrate
    php artisan queue:table

    The server will start at `http://localhost:8000`.

## API Endpoints

### Create a Website

-   **Endpoint:** `POST /api/create/website`
-   **Description:** Create a new website.
-   **Request Body:**
    {
        "name": "Example Post Title",
        "url": "https://github.com"
    }

### Fetch all Website

-   **Endpoint:** `GET /api/websites`
-   **Description:** Fetch all websites.


### Create a Post For a Particular Website

-   **Endpoint:** `POST /api/websites/{website}/posts`
-   **Description:** Create a new post for a particular website.
-   **Request Body:**
    {
        "title": "Example Post Title",
        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
    }

### Fetch all Posts For a Particular Website

-   **Endpoint:** `GET /api/websites/{website}/posts`
-   **Description:** Fetch all Posts For a Particular Website.


### Subscribe User to Website

-   **Endpoint:** `POST /api/websites/{website_id}/subscribe`
-   **Description:** Subscribe a user to a particular website.
-   **Request Body:**
    {
        "email": "subscriber@example.com"
    }

### Send Email Notifications (Command)

-   **Command:** `php artisan app:send-emails`
-   **Description:** Sends email notifications to subscribers for new posts.
-   **Functionality:** Checks all websites for new posts and sends notifications to subscribers who haven't received them yet.


## Repository

The code is publicly available on GitHub: [https://github.com/Iniee/subscription-platflorm.git](https://github.com/Iniee/subscription-platflorm.git)
