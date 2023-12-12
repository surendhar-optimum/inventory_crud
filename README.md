# INVENTORY MANAGEMENT SYSTEM
Laravel Inventory Management System Api Crud Technical Challenge

## OBJECTIVE
Create Restful API for an inventory management system using Laravel and Mysql.

# REQUIRED SOFTWARES
    * PHP >=8.0,
    * Laravel 10,
    * Mysql DB
    * POSTMAN

# FEATURES
    *Item Management,
    *Category Management,
    *Email Notifications,
    *Unit Testing

# INSTALLATION
    . Install Composer 
    . create DB into Mysql 
    . implement DB name into .env
    . update token into POSTMAN to authenticate 
    . updae admin email and team emails to get mail notifications
    
# Terminal Activities
    . open folder select the file path into cmd to execute vs code.
# Appliation 
    . To run the application user Php artisan serve
    . Create Item Controller and Category Controller 
       .. Php artisan make:controller Item Controller --resource,
       .. Php artisan make:controller Category Controller --resource,
    . Create Model for Item and Category using -m to migration the tables and it create tables as plurals of model
       .. Php artisan make:model Item -m
       .. Php artisan make:model Category -m
    . Use composer to create Mail 
    . create Unit testing 
       .. php artisan make:test UserTest
# API Authorization
    | Attempt | #1    | #2    |
| :---:   | :---: | :---: |
| Seconds | 301   | 283   |
