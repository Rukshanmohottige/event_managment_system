ITUM Event Management System
A comprehensive web-based event management system for the Institute of Technology University of Moratuwa that allows students to discover, register for, and manage academic and extracurricular events.

🚀 Features
User Authentication: Secure registration and login system

Event Management: View upcoming events with detailed information

Event Registration: One-click registration for events

Session Management: Persistent login sessions

Responsive Design: Mobile-friendly interface

Role-based Access: Support for students, staff, and admin roles

🛠 Technology Stack
Frontend: HTML5, CSS3, JavaScript (ES6+)

Backend: PHP

Database: MySQL

Server: Apache/XAMPP

Architecture: RESTful API design

📋 System Requirements
PHP 7.4 or higher

MySQL 5.7 or higher

Apache Web Server

Modern web browser (Chrome, Firefox, Safari, Edge)

🗄 Database Schema
Tables Structure
Users Table
sql
CREATE TABLE users (
  user_id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(50) NOT NULL DEFAULT 'student',
  PRIMARY KEY (user_id),
  UNIQUE KEY email (email)
);
Events Table
sql
CREATE TABLE events (
  event_id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  event_date DATETIME NOT NULL,
  venue VARCHAR(255) DEFAULT NULL,
  description TEXT DEFAULT NULL,
  created_by INT(11) DEFAULT NULL,
  PRIMARY KEY (event_id),
  FOREIGN KEY (created_by) REFERENCES users (user_id)
);
Registrations Table
sql
CREATE TABLE registrations (
  registration_id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  event_id INT(11) NOT NULL,
  PRIMARY KEY (registration_id),
  UNIQUE KEY user_event (user_id,event_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (event_id) REFERENCES events (event_id)
);
📥 Installation Guide
Step 1: Environment Setup
Install XAMPP/WAMP/MAMP

Start Apache and MySQL services

Step 2: Database Setup
Open phpMyAdmin (http://localhost/phpmyadmin)

Create a new database named itum_events

Import the db_structure.sql file or run the following:

sql
CREATE DATABASE itum_events;
USE itum_events;

-- Run the complete SQL from db_structure.sql
Step 3: Project Setup
Download or clone the project files

Place the project folder in your web server root directory (htdocs for XAMPP)

Update database credentials in db_connect.php if needed:

php
$host = "localhost";
$user = "root";
$pass = "";
$db = "itum_events";
Step 4: Access the Application
Open your web browser and navigate to:

text
http://localhost/project-folder-name
📁 Project Structure
text
/project/
├── index.php                 # Main application entry point
├── style.css                 # Stylesheets
├── java_script.js            # Frontend JavaScript
├── db_connect.php            # Database connection
├── check_session.php         # Session validation
├── login.php                 # User login handler
├── logout.php                # User logout handler
├── register.php              # User registration
├── get_events.php            # Fetch events from database
├── register_event.php        # Event registration handler
├── db_structure.sql          # Database schema and sample data
├── README.md                 # This file
├── images/                   # Image assets
│   └── header-logo.jpg
└── report.pdf               # Project documentation
👥 Default Test Accounts
Student Accounts:
Email: john.silva@itum.com | Password: password123

Email: jane.perera@itum.com | Password: password123

Email: kamal.fernando@itum.com | Password: password123

Admin/Staff Accounts:
Email: admin@itum.com | Password: admin123

Email: events@itum.com | Password: event123

Email: sameera.bandara@itum.com | Password: prof123

🎯 Sample Events
The system comes pre-loaded with sample events:

Hackathon 2025 (Nov 20, 2025 - Main Hall)

AI Workshop (Nov 25, 2025 - Lab 3)

Sports Meet (Dec 10, 2025 - Playground)

Career Fair 2025

Cultural Festival

Research Symposium

🔧 Core Functionalities
User Management
User registration with email validation

Secure login system with session management

Role-based access control (student, staff, admin)

Profile management

Event Management
Dynamic event listing with chronological sorting

Event details including date, venue, and description

Responsive event cards with registration buttons

Real-time event updates

Registration System
One-click event registration

Prevention of duplicate registrations

Visual feedback for registration status

Login requirement enforcement

🛡 Security Features
Session-based authentication

Input validation on client and server side

SQL injection prevention using prepared statements

Unique constraints to prevent duplicate registrations

Password protection (plain text for demo - use hashing in production)

📱 Responsive Design
The application is fully responsive and works on:

Desktop computers

Tablets

Mobile phones

Various screen sizes

🐛 Troubleshooting
Common Issues
Database Connection Error

Check if MySQL service is running

Verify database credentials in db_connect.php

Ensure database itum_events exists

Session Not Persisting

Check if browser cookies are enabled

Verify session_start() is called on all PHP files

Registration/Login Issues

Check if email already exists in database

Verify password matching

Check browser console for JavaScript errors

Events Not Loading

Verify database has sample events

Check PHP error logs for database query issues

Error Messages
"Database connection failed" - Check MySQL service and credentials

"Login Failed" - Invalid email or password

"Already registered" - User already registered for the event

"Please login to register" - User not logged in

🔄 API Endpoints
GET Endpoints
get_events.php - Fetch all events

check_session.php - Check user session status

POST Endpoints
login.php - User authentication

register.php - User registration

register_event.php - Event registration

logout.php - User logout

🚀 Future Enhancements
Planned Features
Password hashing for security

Email verification system

Password recovery functionality

Admin panel for event management

Event categories and filtering

Calendar integration

Email notifications

QR code attendance system

Analytics dashboard

Security Improvements
Implement bcrypt password hashing

Add CSRF protection

Implement rate limiting

Add input sanitization

Secure session management

📞 Support
For technical support or issues with the ITUM Event Management System, please contact:

System Administrator: admin@itum.com

Event Coordinator: events@itum.com

📄 License
This project is developed for academic purposes at the Institute of Technology University of Moratuwa. All rights reserved.

👨‍💻 Development Team
Developed by ITUM Web Development Students

Academic Year: 2025

Course: Web Development Project
