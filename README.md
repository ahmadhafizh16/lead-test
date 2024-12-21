This project demonstrates the creation of a REST API using Laravel v11 with event-driven architecture and email services. The application fulfills the following requirements:

- **Create User API**
- **Get Users API**

---

## 💻 Tech Stack

- **Framework**: Laravel v11
- **Email Testing**: Mailpit
- **Queue Mechanism**: Laravel Queues with a PostgreSQL Driver

---

## 🚀 Features

1. **Create User API**
    - Endpoint: `POST /api/users`
    - Functionality:
        - Adds a new user to the database.
        - Sends two emails:
            1. Confirmation email to the new user.
            2. Notification email to the system administrator.
        - Excludes the password field in the response.
    - Example Request Input:
        ```json
        {
          "email": "example@example.com",
          "password": "securepassword",
          "name": "John Doe"
        }
        ```
    - Example Response:
        ```json
        {
          "id": 123,
          "email": "example@example.com",
          "name": "John Doe",
          "created_at": "2024-11-25T12:34:56Z"
        }
        ```
    - Example Request from Postman
    
      ![image](https://github.com/user-attachments/assets/b73d6bfd-59c3-4729-8423-e5b9f059e7f6)
    - Example Email received after creating new user
    
      ![image](https://github.com/user-attachments/assets/8080e5ad-eff0-49b6-9757-42e46bec959f)


2. **Get Users API**
    - Endpoint: `GET /api/users`
    - Functionality:
        - Retrieves a paginated list of active users.
        - Supports filtering by `search` (matches name or email).
        - Allows sorting by `sortBy` (name, email, created_at) with a default of `created_at`.
        - Excludes the password field in the response.
        - Includes `orders_count` representing the total number of orders per user.
    - Example Request Input:
        ```
        ?search=John&page=1&sortBy=name
        ```
    - Example Response:
        ```json
        {
          "page": 1,
          "users": [
            {
              "id": 123,
              "email": "example@example.com",
              "name": "John Doe",
              "created_at": "2024-11-25T12:34:56Z",
              "orders_count": 10
            },
            {
              "id": 124,
              "email": "another@example.com",
              "name": "Jane Smith",
              "created_at": "2024-11-24T11:20:30Z",
              "orders_count": 5
            }
          ]
        }
        ```
   - Example Request from Postman
      
      ![image](https://github.com/user-attachments/assets/a5ffc577-448b-4e40-9561-3ec4668e3c35)

   - Example Request from Postman using Search Query
   
      ![image](https://github.com/user-attachments/assets/0e6de44f-4b06-43f2-b623-4cbad384ea2c)

---

## 📦 Database Structure

### Users Table
- `id` (INT, Primary Key, Auto Increment)
- `email` (VARCHAR, 255, Unique, Not Null)
- `password` (VARCHAR, 255, Not Null)
- `name` (VARCHAR, 255, Not Null)
- `active` (BOOLEAN, Default: true)
- `created_at` (DATETIME, Default: Current Timestamp)

### Orders Table
- `id` (INT, Primary Key, Auto Increment)
- `user_id` (INT, Foreign Key to `users.id`)
- `created_at` (DATETIME, Default: Current Timestamp)

---

## 🛠️ Setup Instructions

1. **Clone the Repository**
    ```bash
    git clone https://github.com/ahmadhafizh16/lead-test.git
    cd lead-test
    ```

2. **Install Dependencies**
    ```bash
    composer install
    ```

3. **Environment Configuration**
    I have copy configured env for this test to `.env.example`, so just copy the `.env.example` to `.env` for convenience.
    ```bash
    cp .env.example .env
    ```

4. **Using docker compose to start the services**
    ```bash
    docker compose up -d
    ```

5. **Run Migrations**
   From inside docker container run 
    ```bash
    php artisan migrate
    ```

6. **Queue Worker**
    Start the queue worker to process email jobs run this from inside docker container:
    ```bash
    php artisan queue:work
    ```

7. **Done**
    - Visit `http://localhost` to see Laravel app.
    - Visit `http://localhost:8025` to see captured emails.
