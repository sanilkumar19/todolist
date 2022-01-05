# TGIF

https://tgif469.000webhostapp.com/login.php

TGIF is an web application which helps user after they register themselves to manage and keep track of tasks which are there in daily life such as buying groceries, completing pending assignment and so on. With the help of this web application user can easily maintain their daily schedules and also track it at the same time.

# Requirements

User should have system wokring on any OS (Mac or Windows), XAMPP, VS Code or any other suitable IDE in needs to register themselves by opening registration page in TGIF web application in order to access it. To register, user needs to enter their first and last name,email id, create a passwrod (1 uppercase, 1 number,1 special character) 

# Design

This web application is desgined using HTML,CSS,PHP and MYSQL is used as a database to store the values.

# Implementation

This web application has total of seven files:

register.php 
- This file shows how registration page is created and how one can add name,id and password and register themselves and also use of sql

main.php
- This file shows the main page of the application which appears after the registration page. This file has multiple forms, class,fucntions and sql used to create main page where user can add tasks and keep track of that

hasher.php
- This file verifies the entered password is correct or not

login.php
- This file contains sessions of login and credentials such as name,password and it also verifies it 

logut.php
- This file has sessions of logout 

index.php
- This file takes user to main page if login credentials are correct else logged out

config.php
- This file is used for connection of my sql

functions.php
- This file has different functions created for for main and registration page

# Installation
Steps to run this web application
---
- Install zip file of the web application 
    - extract the zip file
- Install XAMPP
     - Make sure to start Apache and mysql
- Install VS code/web storm
    - install required extensions of HTML,CSS,PHP
    - Set path for php file
- Open every file in either IDE and run it in any internet browser

# Contributors
Sharan Anilkumar (sanilkumar@umassd.edu)

Harmit Pareshkumar Barot (hbarot@umassd.edu)

Abderahmane Naidjate (anaidjate@umassd.edu)
