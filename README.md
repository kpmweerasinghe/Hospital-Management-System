Hospital Management System

A web-based Hospital Management System developed using PHP, MySQL, HTML, CSS, JavaScript and XAMPP.

Project Overview

The Hospital Management System is designed to manage major hospital operations through a centralized web application.

The system provides role-based access for:

* Administrator
* Doctor
* Nurse
* Receptionist
* Laboratory Staff
* Pharmacist
* Accountant

Main Features

User Management

* Secure login
* Logout
* Password hashing
* User roles
* Role-Based Access Control (RBAC)
* Session timeout
* Audit logs

Patient Management

* Register patients
* Update patient information
* Search patients
* View patient medical history
* Upload patient documents

Doctor Management

* Add doctors
* Update doctor details
* Department assignment
* Doctor schedule management

Appointment Management

* Book appointments
* View appointments
* Cancel appointments
* Reschedule appointments

Electronic Medical Records

* Diagnosis
* Treatment records
* Prescriptions
* Medical history

Laboratory Management

* Request laboratory tests
* Sample collection
* Result entry
* Laboratory reports

Pharmacy Management

* Medicine inventory
* Stock management
* Prescription processing
* Expiry monitoring

Billing

* Consultation charges
* Laboratory charges
* Pharmacy charges
* Admission charges
* Invoice generation
* Payment recording

Reports

* Patient reports
* Appointment reports
* Revenue reports
* Pharmacy reports
* Laboratory reports
* Staff reports

Technologies Used

* PHP
* MySQL
* HTML5
* CSS3
* JavaScript
* XAMPP
* phpMyAdmin

System Requirements

* XAMPP
* Apache
* MySQL
* PHP
* Web browser

Installation

1. Install XAMPP

Install XAMPP and start:

* Apache
* MySQL

2. Clone the Repository

Place the project inside:

C:\xampp\htdocs\

3. Database Setup

Open:

http://localhost/phpmyadmin

Create a database named:

hms_db

Import:

hms_database.sql

4. Configure Database

Open:

db.php

Make sure the database configuration matches your local XAMPP setup.

5. Run the System

Open:

http://localhost/hospital_management_system/

Default Test Account

For demonstration purposes:

Username: admin

Password: 12345

Change the demonstration password when using the system in a real environment.

Project Structure

hospital_management_system/
│
├── css/
├── uploads/
├── patients.php
├── doctors.php
├── appointments.php
├── emr.php
├── laboratory.php
├── pharmacy.php
├── billing.php
├── reports.php
├── users.php
├── dashboard.php
├── db.php
├── hms_database.sql
└── README.md

Security

The project includes:

* Password hashing
* Role-Based Access Control
* Session management
* Session timeout
* Audit logging
* Prepared statements in security-sensitive operations

This project is intended for academic and demonstration purposes.
IKPM Weerasinghe.
