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
    . To run the application
        .. Php artisan serve
    . Create Item Controller and Category Controller 
       .. Php artisan make:controller Item Controller --resource,
       .. Php artisan make:controller Category Controller --resource,
    . Create Model for Item and Category using -m to migration the tables and it create tables as plurals of model
       .. Php artisan make:model Item -m
       .. Php artisan make:model Category -m
    . Use composer to create Mail 
    . create Unit testing 
       .. php artisan make:test Test
       
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
{
    "data": [
        {
            "id": 1,
            "name": "Apple s",
            "description": "Green",
            "created_at": "2023-12-11T11:17:52.000000Z",
            "updated_at": "2023-12-11T11:17:52.000000Z"
        },
        {
            "id": 2,
            "name": "Orange",
            "description": "It is Orange Color",
            "created_at": "2023-12-12T03:58:59.000000Z",
            "updated_at": "2023-12-12T03:58:59.000000Z"
        },
        {
            "id": 3,
            "name": "Orang",
            "description": "It is Orange Color",
            "created_at": "2023-12-12T04:57:50.000000Z",
            "updated_at": "2023-12-12T04:57:50.000000Z"
        },
        {
            "id": 5,
            "name": "almon1702365527",
            "description": "Green",
            "created_at": "2023-12-12T07:18:47.000000Z",
            "updated_at": "2023-12-12T07:18:47.000000Z"
        },
        {
            "id": 6,
            "name": "almon1702365575",
            "description": "Green",
            "created_at": "2023-12-12T07:19:35.000000Z",
            "updated_at": "2023-12-12T07:19:35.000000Z"
        },
        {
            "id": 7,
            "name": "almon1702365707",
            "description": "Green",
            "created_at": "2023-12-12T07:21:47.000000Z",
            "updated_at": "2023-12-12T07:21:47.000000Z"
        }
    ]
}

# Get:http://127.0.0.1:8000/api/category/1

It throws record based upon given id;
{
    "data": {
        "id": 3,
        "name": "Orang",
        "description": "It is Orange Color",
        "created_at": "2023-12-12T04:57:50.000000Z",
        "updated_at": "2023-12-12T04:57:50.000000Z"
    }
}


# PUT:http://127.0.0.1:8000/api/item/6

.Pass with value category_id

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

# ITEM RESPONSE

# POST:http://127.0.0.1:8000/api/item/

| Parameter | type    | Desc    |
| :-----: | :---: | :---: |
| name | string  | category for yours  |
| description | string  | description for yours  |
| price| integer  | price value for yours  |
| quantity | integer  | quantity value for yours  |
| category_id | integer  | pass minimum 1 valuable category_id |


# Response for your Post item
{
    "message": "Item\n        Addded Successfully",
    "Item": {
        "name": "Sapta gola",
        "description": "Green",
        "price": "150",
        "quantity": "1500",
        "updated_at": "2023-12-12T08:40:06.000000Z",
        "created_at": "2023-12-12T08:40:06.000000Z",
        "id": 103
    }
}

# Get:http://127.0.0.1:8000/api/item/

It throws all the inserted value from db;
{
    "data": [
        {
            "id": 3,
            "name": "Grapes",
            "description": "Red in color",
            "price": 290,
            "quantity": 40,
            "created_at": "2023-12-11T11:22:31.000000Z",
            "updated_at": "2023-12-11T13:06:58.000000Z",
            "category": [
                {
                    "id": 40,
                    "category_id": 1,
                    "item_id": 3,
                    "created_at": "2023-12-11T11:22:31.000000Z",
                    "updated_at": "2023-12-11T13:06:58.000000Z",
                }
            ]
        },
        {
            "id": 4,
            "name": "Mangof",
            "description": "Green",
            "price": 150,
            "quantity": 1500,
            "created_at": "2023-12-11T11:23:36.000000Z",
            "updated_at": "2023-12-11T11:23:36.000000Z",
            "category": [
                {
                    "id": 3,
                    "category_id": 1,
                    "item_id": 4,
                    "created_at": "2023-12-11T11:23:36.000000Z",
                    "updated_at": "2023-12-11T11:23:36.000000Z",
                    }
            ]
        },
        {
            "id": 5,
            "name": "Mangossf",
            "description": "Green",
            "price": 150,
            "quantity": 1500,
            "created_at": "2023-12-11T11:23:36.000000Z",
            "updated_at": "2023-12-11T11:23:36.000000Z",
            "category": [
                {
                    "id": 4,
                    "category_id": 1,
                    "item_id": 5,
                    "created_at": "2023-12-11T11:23:36.000000Z",
                    "updated_at": "2023-12-11T11:23:36.000000Z"
                    }
            ]
        },
        {
            "id": 6,
            "name": "orangnic",
            "description": "Black",
            "price": 170,
            "quantity": 700,
            "created_at": "2023-12-11T11:25:41.000000Z",
            "updated_at": "2023-12-12T06:44:35.000000Z",
            "category": [
                {
                    "id": 128,
                    "category_id": 2,
                    "item_id": 6,
                    "created_at": "2023-12-11T11:25:41.000000Z",
                    "updated_at": "2023-12-12T06:44:35.000000Z"
                    }
            ]
        },
        {
            "id": 60,
            "name": "Sap",
            "description": "Green",
            "price": 150,
            "quantity": 1500,
            "created_at": "2023-12-12T04:58:03.000000Z",
            "updated_at": "2023-12-12T04:58:03.000000Z",
            "category": [
                {
                    "id": 64,
                    "category_id": 1,
                    "item_id": 60,
                    "created_at": "2023-12-12T04:58:03.000000Z",
                    "updated_at": "2023-12-12T04:58:03.000000Z"
                }
            ]
        },
        {
            "id": 103,
            "name": "Sapta gola",
            "description": "Green",
            "price": 150,
            "quantity": 1500,
            "created_at": "2023-12-12T08:40:06.000000Z",
            "updated_at": "2023-12-12T08:40:06.000000Z",
            "category": [
                {
                    "id": 261,
                    "category_id": 1,
                    "item_id": 103,
                    "created_at": "2023-12-12T08:40:06.000000Z",
                    "updated_at": "2023-12-12T08:40:06.000000Z"
                }
            ]
        }
    ],
    "success": true
}

# Get:http://127.0.0.1:8000/api/item/3

It throws record based upon given id;
{
    "data": {
        "id": 3,
        "name": "Grapes",
        "description": "Red in color",
        "price": 290,
        "quantity": 40,
        "created_at": "2023-12-11T11:22:31.000000Z",
        "updated_at": "2023-12-11T13:06:58.000000Z",
        "category": [
            {
                "id": 40,
                "category_id": 1,
                "item_id": 3
            }
        ]
    }
}


# PUT:http://127.0.0.1:8000/api/item/3

.Pass with value category_id

 | Parameter | type    | Desc    |
| :-----: | :---: | :---: |
| name | string  | item for yours  |
| description | string  | description for yours  |
| price| integer  | item value for yours  |
| quantity | integer  | quantity value for yours  |

{
    "message": "Item Updated Successfully",
    "data": {
        "id": 3,
        "name": "orangnic",
        "description": "Black",
        "price": "170",
        "quantity": "700",
        "created_at": "2023-12-11T11:25:41.000000Z",
        "updated_at": "2023-12-12T06:44:35.000000Z"
    }
}


# DELETE:http://127.0.0.1:8000/api/category/6
{
    "message": "Item Deleted Successfully",
    "success": true
}

