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
    | Authorixation | Bearer Token    | Desc   |
    | :---:   | :---: | :---: |
    | token | auth token  | auth key   |

    | Header | 
    | :---:   | :---: |
    | Key | value  |
    | accept | application/json  


# Category
Response for Category Json 
{
    "name":"Category Test ",
    "description":" Desc category"
    "created_at": "2023-12-12T08:40:06.000000Z",
    "updated_at": "2023-12-12T08:40:06.000000Z"
}

# POST:http://127.0.0.1:8000/api/category/

:name , category
:string
Descprition:
| Parameter | type    | Desc    |
| :-----: | :---: | :---: |
| name | string  | category for yours  |
| description | string  | description for yours  |


# Response for your Post Category
{
    "message": "Category\n        Addded Successfully",
    "category": {
        "name": "Orang",
        "description": "It is Orange Color",
        "updated_at": "2023-12-12T04:57:50.000000Z",
        "created_at": "2023-12-12T04:57:50.000000Z",
        "id": 3
    }
}

# Get:http://127.0.0.1:8000/api/category/

It throws all the inserted value from db;

# Get:http://127.0.0.1:8000/api/category/1

It throws record based upon given id;

.Pass value category_id
# PUT:http://127.0.0.1:8000/api/item/6

.Pass value category_id

 | Parameter | type    | Desc    |
| :-----: | :---: | :---: |
| name | string  | category for yours  |
| description | string  | description for yours  |

{
    "message": "Category Updated Successfully",
    "data": {
        "id": 6,
        "name": "orangnic",
        "description": "Black",
        "created_at": "2023-12-11T11:25:41.000000Z",
        "updated_at": "2023-12-12T06:44:35.000000Z",
       
    }
}

# DELETE:http://127.0.0.1:8000/api/category/6
{
    "message": "Category Deleted Successfully",
    "success": true
}
