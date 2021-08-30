# OnTheQ
On The Q Website Reservation Management

Hi there, here are the files for the Project of On The Q reservation Management.

As we will need to change most settings when uploading them to the new domain, I let you here what do we need to modify.


- Database Scripts: We must Import the Database in the cPanel of our domain.
  - Log In PhpMyAdmin create a database with the Name that you want (We will need it for the settings later)
  - Once the database is created, Import the File ontheq_db_script, that will import all the tables needed for the project to work.

- login/db.php: We must complete the define database settings, so we will change these lines.
  define('DB_USERNAME', '#yourDbUsername'); 
  define('DB_PASSWORD', '#yourDbPassword');          
  define('DB_NAME', '#yourDbName');
  
- Then regarding the Email Settings, we will need to change 2 path links:
  - login/register.php: We will modify the path where we will be redirected when activating the account.
    - Line 54 http://www.YOURDOMAIN/login/verify.php?email='.$email.'&hash='.$hash.'
  - login/error_tries: Same for the recover password path link
    - Line 29 http://www.YOURDOMAIN/login/reset_password.php?email='.$email.'&key='.$key.'&action=reset



After changing this things, everything is going to work propertly. If something still misses, contact me.

