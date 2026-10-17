## Task

Simple CRM for User Management with RBAC (Role-Based Access Control).

## Credentials

Superadmin Account  
&emsp;    - user: Superadmin  
&emsp;    - pass: password  

## Installation

Extract Zip or Clone to your local machine with installed PHP Server (Example: Xampp)  
Change database credentials from config/Database.php file.  
&emsp;    - Host  
&emsp;    - Database  
&emsp;    - Username  
&emsp;    - Password  

## Modules

Users  
&emsp;    - CRUD functionality for users with search and pagination.  
&emsp;    - On edit user using Superadmin account, a section for adding/updating role for the specific user is added.  
Roles  
&emsp;    - CRUD functionality for roles with search and pagination.  
&emsp;    - On edit role using Superadmin account, a section for adding/updating permission for the specific role is added.  
Permission  
&emsp;    - CRUD functionality for permission with search and pagination.  

## Folder Structure

UserManagement  
&emsp;    - config  
&emsp;&emsp;        - Constants.php : file for constant values.  
&emsp;&emsp;        - Database.php : config file for database connection.  
&emsp;    - db : SQL file will be located.  
&emsp;    - src  
&emsp;&emsp;        - App  
&emsp;&emsp;&emsp;            - Controllers : Controller classes for connecting frontend and services transaction to backend.  
&emsp;&emsp;&emsp;            - Helpers  
&emsp;&emsp;&emsp;&emsp;                - helper.php : Helper functions are stored.  
&emsp;&emsp;&emsp;            - Models : Model classes where logic processes are performed (select, store, etc.).  
&emsp;&emsp;&emsp;            - Services : Instantiation of classes, manipulating and passing of data for backend transactions.  
&emsp;&emsp;&emsp;            - Validators : Validation for form submission.  
&emsp;    - vendor  
&emsp;&emsp;        - autoloader.php : File for dynamic autoload of files inside src/App to other files.  
&emsp;    - views  
&emsp;&emsp;        - assets : Asset files are located (js, css, files)  
&emsp;&emsp;        - includes : Reusable files are located.  
&emsp;&emsp;        - Permissions : Frontend files for Permission Module.  
&emsp;&emsp;        - Roles : Frontend files for Role Module.  
&emsp;&emsp;        - Users : Frontend files for User Module.  
&emsp;&emsp;        - unauthorized.php : Frontend file for Unauthorized page access.  
&emsp;    - index.php : Main or Login page of the system.  

## Technologies Used

PHP8  
MySQL  
Bootstrap 6  
JQuery  
FontAwesome
SweetAlert 2
    
