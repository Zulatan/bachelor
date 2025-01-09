# Guide to run my project on your local computer

----------------------------------------

# Prerequisites
- MAMP PRO or the free version (alternatively, XAMPP or WAMP could also work).
- Postman or Insomnia to test the API.
- A text editor such as Visual Studio Code or Sublime Text.
- Composer installed on your system for Laravel dependencies. Will also be shown how in the steps below.
- Node.js and NPM if the frontend requires it. Get node from their website: https://nodejs.org/en/download, and get a 'LTS' version or v20.9.0.
- Locally install PHP from https://www.php.net/downloads.php. Get version 8.3.

# Steps to run the project locally

1. **Download and unzip the code directory **  
   Download the 'bachelor' directory containing 'frontend' and 'backend2', and place it in a folder like `/Desktop` or `/Documents`. 

2. **Unzip database data**  
   Download and unzip 'db_data' and temporarily store it in `/Downloads`.

3. **Run the project in a text editor and install NPM and Composer**  
   Open the project directory in your preferred text editor. Open a terminal and change directory to the project and install NPM by using the command: `npm install`. 
   Also, follow the Composer Downloads guide: https://getcomposer.org/download/ or simply change directory to `backend2` by using command: `cd backend2` and then run the command:

   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer 
   verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
   php composer-setup.php
   php -r "unlink('composer-setup.php');"

5. **Configure MAMP**  
   - Open MAMP and create a new host for the project.  
   - Set the host name to 'bachelor.dk' or similar.  
   - PHP version: 8.2.0  
   - Port: 8080  
   - Webserver: Apache  
   - Document root: Point to the `public` folder inside `backend2`. For example:  
     `/User/Documents/bachelor/backend2/public`

6. **Start the MAMP server**  
   - Press the "Start" button in MAMP.  
   - Once the server is running, click "WebStart" to open the MAMP start page.  
   - Scroll down to the "MySQL" section and click the "PhpMyAdmin" link.

7. **Import the database**  
   - In PhpMyAdmin, create a new database (e.g., 'bachelor' or 'test_db').  
   - Click the database name, then go to the "Import" tab.  
   - Import the `db_data` file.

8. **Set up the `.env` file**  
   - In the `backend2` directory, create a new `.env` file by using the following command in the terminal:  `touch .env`
   - Copy the contents of `.env.example` into `.env`.  
   - Update the following lines:  
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=8889
     DB_DATABASE=bachelor
     DB_USERNAME=your_mysql_username
     DB_PASSWORD=your_mysql_password

9. **Visit the host URL**  
   Open a browser and go to `https://bachelor.dk:8080/bookings/customers` to test the application. Check other endpoint routes in `backend2/routes/web.php`.
   If your version of MAMP does not support SSL, simply visit a HTTP URL instead of HTTPS: `http://bachelor.dk:8080/bookings/customers`

10. **Run the Frontend code**  
   - Navigate to the `frontend` directory in your terminal:  `cd frontend`
   - Install dependencies using:  `npm install`
   - Start the development server with:  `npm run dev`
   - Visit the localhost URL provided in the terminal output.


# Troubleshooting
- **Server not starting**: Ensure MAMP is running and all configurations are correct.  
- **Database import errors**: Verify the format of the `db_data` file and check the PhpMyAdmin error logs.  
- **Cannot connect to the database**: Double-check the `.env` file for correct DB_HOST, DB_USERNAME, and DB_PASSWORD.
- **No Application Encryption Key Has Been Specified**: Run command in terminal: `php artisan key:generate`.
    
    # Check your system for further troubleshooting
    - Ensure Composer is installed by running: `composer --version`
    - Check Node.js and NPM by running: `node -v` and `npm -v`



--------------------------------------------------

# End of guide
