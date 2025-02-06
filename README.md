# Employee Leave Management System

The Employee Leave Management System is a web application that allows companies to efficiently manage employee leave requests. It enables employees to submit leave applications, track the status of their requests, and manage their leave balances. The system features an attractive and user-friendly interface designed using Tailwind CSS.

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL
- Node.js and npm (for Tailwind CSS installation)
  
## Features

- Employee Portal:
  - Employee login using employee name and employee number.
  - Submit leave request.
  - View leave request status.

- Admin Portal:
  - View all leave requests.
  - Approve, reject, or cancel leave requests.
  - Generate reports.

## Technologies Used

- Laravel 1* – The backend framework.
- Livewire 3 – For building reactive components.
- Tailwind CSS – For modern, responsive design.
- MySQL – Database system.

## Installation

Follow these steps to set up the project locally:

1. **Clone the Repository:**
  git clone https://github.com/EngYemen21/leave-managment-system.git
   cd leave-management-system
2. Install Composer Dependencies:
   composer install
3. Copy the Environment File:
4. Generate the Application Key:
   php artisan key:generate
5. Configure the Database:
6. Run Migrations:
    php artisan migrate
7. Install NPM Dependencies & Build Assets: If you use npm for Tailwind CSS:
    npm install
    npm run dev
8. Run the Application:
    php artisan serve


نسخ
تحرير

