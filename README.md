# 🏥 Hospital Management System

A web-based **Hospital Management System (HMS)** developed to manage and streamline the daily operations of a hospital. The system provides separate functionality for administrators, doctors, nurses, receptionists, laboratory staff, pharmacists, and accountants.

The system is designed to manage patients, doctors, appointments, electronic medical records, laboratory services, pharmacy operations, billing, reports, user access control, and security-related activities from a centralized platform.

---

## 📌 Project Overview

The Hospital Management System provides an integrated solution for managing hospital-related activities through a web-based application.

The system allows authorized users to:

- Register and manage patients
- Manage doctor information and departments
- Manage doctor schedules
- Book, cancel, and reschedule appointments
- Maintain electronic medical records
- Manage laboratory test requests and results
- Manage pharmacy inventory and prescriptions
- Manage hospital billing and payments
- Generate operational and financial reports
- Manage system users and roles
- Maintain audit logs
- Implement role-based access control
- Apply secure login and session timeout mechanisms

The project was developed as an academic/software development project using PHP, MySQL, HTML, CSS, JavaScript, and XAMPP.

---

## 🎯 Project Objectives

The main objectives of this system are:

1. To computerize hospital management activities.
2. To reduce manual paperwork and data duplication.
3. To provide centralized patient and medical information.
4. To improve appointment and doctor schedule management.
5. To simplify laboratory and pharmacy management.
6. To automate billing and payment recording.
7. To provide role-based access to different hospital staff.
8. To improve data security and accountability.
9. To provide useful reports for hospital management.
10. To create an efficient and user-friendly hospital information system.

---

## ✨ Main Features

### 👤 User Management

- User login and logout
- Password-protected authentication
- User account management
- User role assignment
- Role-based access control
- Account status management
- Secure password hashing
- Session management
- Session timeout
<h4>Login Page</h4>
<img src="login.png" alt="Login Page" width="700">
---

### 🧑‍⚕️ Patient Management

- Register new patients
- Update patient information
- Search patients
- View patient details
- View medical history
- Upload patient-related documents
- Maintain centralized patient records

---

### 👨‍⚕️ Doctor Management

- Add doctors
- Update doctor information
- Manage doctor specializations
- Assign doctors to departments
- Manage doctor schedules
- View doctor schedules

---

### 📅 Appointment Management

- Book appointments
- View appointments
- Cancel appointments
- Reschedule appointments
- Track appointment information
- Connect appointments with patients and doctors

---

### 📋 Electronic Medical Records (EMR)

- Maintain patient medical records
- Record diagnoses
- Manage prescriptions
- Record treatment history
- Maintain medical reports
- Connect medical information with patient records

---

### 🧪 Laboratory Management

- Create laboratory test requests
- Manage sample collection
- Enter laboratory results
- Generate laboratory reports
- Track laboratory test information

---

### 💊 Pharmacy Management

- Manage pharmacy inventory
- Process prescriptions
- Record medicine stock
- Monitor medicine quantities
- Monitor medicine expiry
- Manage pharmacy-related transactions

---

### 💰 Billing Management

- Record consultation charges
- Record laboratory charges
- Record pharmacy charges
- Record admission charges
- Generate invoices
- Record payments
- Track billing information

---

### 📊 Reports

The system provides different reports to support hospital management and decision-making.

Available report categories include:

- Patient Reports
- Appointment Reports
- Revenue Reports
- Pharmacy Reports
- Laboratory Reports
- Staff Reports

---

### 🔐 Security Features

Security mechanisms implemented in the system include:

- Secure login
- Password hashing
- Role-Based Access Control (RBAC)
- Protected pages
- Session management
- Session timeout
- Audit logging
- Access restriction based on user roles
- Prepared SQL statements for important database operations

---

## 👥 User Roles

The system supports the following user roles:

| Role | Main Responsibilities |
|------|------------------------|
| **Administrator** | Manage users, doctors, patients, appointments, system operations, and reports |
| **Doctor** | Manage schedules, appointments, medical records, diagnoses, and prescriptions |
| **Nurse** | Access patient information and assist with medical records |
| **Receptionist** | Register patients and manage appointments |
| **Laboratory Staff** | Manage laboratory tests, samples, and results |
| **Pharmacist** | Manage prescriptions, medicines, inventory, and expiry monitoring |
| **Accountant** | Manage billing, payments, and financial information |

---

## 🛠️ Technologies Used

### Frontend

- HTML5
- CSS3
- JavaScript

### Backend

- PHP

### Database

- MySQL

### Development Environment

- XAMPP
- Apache
- MySQL
- phpMyAdmin

### Development Tools

- Visual Studio Code
- Git
- GitHub

---

## 🏗️ System Architecture

The system follows a basic web application architecture:

```text
                    ┌──────────────────────┐
                    │       User           │
                    │ Doctor / Nurse /     │
                    │ Receptionist / etc.  │
                    └──────────┬───────────┘
                               │
                               ▼
                    ┌──────────────────────┐
                    │    Web Interface     │
                    │   HTML / CSS / JS    │
                    └──────────┬───────────┘
                               │
                               ▼
                    ┌──────────────────────┐
                    │      PHP Backend     │
                    │ Authentication / RBAC│
                    │ Business Logic       │
                    └──────────┬───────────┘
                               │
                               ▼
                    ┌──────────────────────┐
                    │    MySQL Database    │
                    │        hms_db          │
                    └──────────────────────┘
