# PHP-code-refactoring
This project demonstrates a refactored PHP application using PDO, MVC structure, and Docker for containerization. It fetches data from an API and displays it using a Bootstrap-based frontend.
![image](https://github.com/user-attachments/assets/df2a3160-a928-4283-97d4-561a06fb3710)

## Getting Started

### Clone the Repository

```bash
git clone https://github.com/uparkalau/PHP-code-refactoring.git
cd php-code-refactoring
```

### Build and Run Docker Containers

Run the following command to build and start the Docker containers:

```bash
docker-compose up --build
```
1. Build the Docker images.
2. Start the MySQL database container.
3. Start the PHP/Apache container.
4. Initialize the database and create the required table.

### Install Composer Dependencies

Run the following command to install the required PHP dependencies:

```bash
docker-compose exec web composer install
docker-compose exec web composer dump-autoload
```

### Access the Application

Once the containers are up and running, you can access the application in your web browser at:

```
http://localhost:8080
```

### Fetch Data from API

Click the "Fetch Data" button to fetch data from the API and display it in a responsive card layout.

## Why Refactoring 
### Improved Security

- **PDO**: Using PDO for database interactions enhances security by supporting prepared statements, which help prevent SQL injection attacks.
- **Error Handling**: Improved error handling with logging instead of using `die()`, which is not suitable for production environments.

### Better Organization

- **MVC Structure**: The project is organized using the MVC (Model-View-Controller) pattern, which separates concerns and makes the code more maintainable and scalable.
- **Namespaces**: Using namespaces helps avoid class name conflicts and keeps the code organized.

### Flexibility

- Configuration settings are managed using environment variables, making it easier to change settings without modifying the code.
- Containerization with Docker ensures that the application runs consistently across different environments.
### Improved Performance

- Batch Data Saving: The new saveBatchData() function has been optimized to save data in one insert, reducing multiple calls to the database and improving overall performance.
## These improvements make the application more secure, maintainable, and user-friendly compared to the original implementation.
