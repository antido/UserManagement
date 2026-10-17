## Task

Simple CRM for User Management with RBAC (Role-Based Access Control).

## Credentials

Superadmin Account  
    - user: Superadmin  
    - pass: password  

## Installation

Extract Zip or Clone to your local machine with installed PHP Server (Example: Xampp)  
Change database credentials from config/Database.php file.  
    - Host  
    - Database  
    - Username  
    - Password  

## Modules

Users  
    - CRUD functionality for users with search and pagination.  
    - On edit user using Superadmin account, a section for adding/updating role for the specific user is added.  
Roles  
    - CRUD functionality for roles with search and pagination.  
    - On edit role using Superadmin account, a section for adding/updating permission for the specific role is added.  
Permission  
    - CRUD functionality for permission with search and pagination.  

## Folder Structure

UserManagement  
    - config  
        - Constants.php : file for constant values.  
        - Database.php : config file for database connection.  
    - db : SQL file will be located.  
    - src  
        - App  
            - Controllers : Controller classes for connecting frontend and services transaction to backend.  
            - Helpers  
                - helper.php : Helper functions are stored.  
            - Models : Model classes where logic processes are performed (select, store, etc.).  
            - Services : Instantiation of classes, manipulating and passing of data for backend transactions.  
            - Validators : Validation for form submission.  
    - vendor  
        - autoloader.php : File for dynamic autoload of files inside src/App to other files.  
    - views  
        - assets : Asset files are located (js, css, files)  
        - includes : Reusable files are located.  
        - Permissions : Frontend files for Permission Module.  
        - Roles : Frontend files for Role Module.  
        - Users : Frontend files for User Module.  
        - unauthorized.php : Frontend file for Unauthorized page access.  
    - index.php : Main or Login page of the system.  

## Technologies Used

PHP8  
MySQL  
Bootstrap 6  
JQuery  
FontAwesome
SweetAlert 2
    
