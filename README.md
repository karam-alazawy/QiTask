# Task Management Dashboard

## Overview

This project is a task management dashboard where authenticated users can manage projects and tasks. The application is built using Laravel for the backend, Livewire for real-time updates, and TailwindCSS for a responsive and modern UI.

## Features

- **User Authentication**: Users can register, log in, and log out using Laravel's built-in authentication.
- **Projects and Tasks**:
  - Create, update, and delete projects.
  - Each project can have multiple tasks.
  - Tasks can be marked as complete or incomplete.
  - Real-time interactions for creating, updating, deleting, and marking tasks using Livewire.
- **Dashboard**: View all projects and their associated tasks.
- **Styling**: A clean, modern, and user-friendly interface using TailwindCSS.
- **API**: An API is provided for interacting with projects and tasks.

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/karam-alazawy/QiTask.git
   cd QiTask
   ```

2. **Install Dependencies**

   Install PHP and Composer dependencies:

   ```bash
   composer install
   ```

   Install JavaScript dependencies:

   ```bash
   npm install
   ```

3. **Set Up Environment**

   Copy the `.env.example` file to `.env` and update the environment settings:

   ```bash
   cp .env.example .env
   ```

   Generate the application key:

   ```bash
   php artisan key:generate
   ```

4. **Database Migration**

   Create the database and run migrations:

   ```bash
   php artisan migrate
   ```

5. **Run the Application**

   Start the Laravel development server:

   ```bash
   php artisan serve
   ```

   In another terminal, compile assets:

   ```bash
   npm run dev
   ```

   Access the application at `http://localhost:8000`.

## API Endpoints

- **Register User**
  - `POST /api/register`
  - Request body: `email`, `password`

- **Login User**
  - `POST /api/login`
  - Request body: `email`, `password`

- **Logout User**
  - `POST /api/logout`

- **Get Projects**
  - `GET /api/projects`

- **Create Project**
  - `POST /api/projects`
  - Request body: `name`, `description`

- **Update Project**
  - `PUT /api/projects/{id}`
  - Request body: `name`, `description`

- **Delete Project**
  - `DELETE /api/projects/{id}`

- **Get Tasks**
  - `GET /api/projects/{projectId}/tasks`

- **Create Task**
  - `POST /api/projects/{projectId}/tasks`
  - Request body: `name`, `description`, `duration`, `start_date`, `due_date`, `completed`

- **Update Task**
  - `PUT /api/tasks/{id}`
  - Request body: `name`, `description`, `duration`, `start_date`, `due_date`, `completed`

- **Delete Task**
  - `DELETE /api/tasks/{id}`

## Postman Collection

You can test the API endpoints using the Postman collection available here: [Postman Collection](https://restless-eclipse-788237.postman.co/workspace/p_ws~15b66501-a5ab-4e8d-8e53-931f8ac03a20/collection/3137974-9a2c306f-f6f7-4003-bd7d-d9cfdd4912c8?action=share&creator=3137974).


## Usage

- **Authentication**: Register or log in to access the dashboard.
- **Dashboard**: View and manage projects and tasks.
- **Real-Time Updates**: Live updates for task interactions via Livewire.