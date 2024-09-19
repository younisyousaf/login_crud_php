# CRUD With Login in PHP

## Description

This project is a secure PHP application that offers user authentication (login and logout) and CRUD (Create, Read, Update, Delete) functionalities for managing user data. It demonstrates the fundamentals of session management, database interaction, and form handling in PHP.

### Features

* **User Authentication:** Provides secure login and logout functionalities.
* **CRUD Operations:** Enables management of user data (Create, Read, Update, Delete) using a MySQL database.
* **Session Management:** Ensures users remain logged in across different pages until they log out.
* **Prepared Statements:** Utilizes prepared statements for secure database queries, preventing SQL injection attacks.
* **Bootstrap Integration:** Delivers a clean and responsive user interface using Bootstrap 5.

### Installation

1. **Clone the Repository:**

   ```bash
   git clone [https://github.com/younisyousaf/login_crud_php.git](https://github.com/younisyousaf/login_crud_php.git);

   ```

2. **Setup the Environment:**
    * Install a local server like XAMPP
    * Start Apache and MySQL services.

3. **Create Database:**
    * Open phpMyAdmin and create a database named "login_crud".
    * Import the provided SQL file (if available) or manually create a table named "userdata" with the following structure:

    ```sql
    CREATE TABLE userdata (
      email VARCHAR(50) NOT NULL,
      password VARCHAR(255) NOT NULL
    );
    ```

4. **Configure the Project:**

    * Open "login.php" and "dashboard.php" files.
    * Update the database credentials (host, username, password) within these files according to your local server configuration.

5. **Access the Application**:

    * Open your web browser and navigate to: <http://localhost/login_crud_php>.

## Usage

**Login:** Enter your email and password to log in.
**CRUD Operations:** Once logged in, access the dashboard to manage user data.
**Logout:** Click the logout button to terminate the session securely.

### Requirements

* PHP 7.0 or higher
* MySQL database
* Apache Server (XAMPP, WAMP, etc.)
* Bootstrap (included via CDN)
