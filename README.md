
# Vending Machine System

This repository contains the code for a Vending Machine System. The project is built with Laravel, a PHP framework, and follows a microservice architecture. The application is deployed on Heroku.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [Deployment](#deployment)
- [Environment Variables](#environment-variables)
- [Production URL](#production-url)
- [Contributing](#contributing)
- [License](#license)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Htet-Shine-Htwe/vending-machine-system.git
   cd vending-machine-system
   ```

2. **Install PHP dependencies:**

   ```bash
   composer install
   ```

3. **Install Node.js dependencies:**

   ```bash
   npm install
   ```

4. **Create a copy of the `.env` file:**

   ```bash
   cp .env.example .env
   ```

5. **Generate an application key:**

   ```bash
   php artisan key:generate
   ```

6. **Set up the database:**

   Update your `.env` file with the correct database credentials, then run:

   ```bash
   php artisan migrate --seed
   ```

7. **Run the development server:**

   ```bash
   php artisan serve
   ```

   The application will be accessible at `http://localhost:8000`.

## User Account Information

- **Username:** admin@gmail.com
- **Password:** password

### Authentication Endpoints

- **`POST /api/v1/login`**  
  Authenticate user and return a token.

- **`POST /api/v1/logout`**  
  Log out the user and invalidate the token.

- **`POST /api/v1/refresh`**  
  Refresh the authentication token.

- **`POST /api/v1/register`**  
  Register a new user.

- **`GET|HEAD /api/user`**  
  Get user details.

### Purchase Endpoints

- **`GET|HEAD /api/v1/user/purchase`**  
  List all purchases for the user.

- **`POST /api/v1/user/purchase/create`**  
  Create a new purchase for the user.

### Frontend

The frontend is built with Laravel Blade and Vue.js. The assets are managed with Vite. You can build the frontend assets by running:

```bash
npm run build
```

## Testing

This project includes both unit and feature tests. The tests are written using PHPUnit and can be run with the following commands:

- **Feature Tests:**

  ```bash
  php artisan test --testsuite=Feature
  ```

- **Unit Tests:**

  ```bash
  php artisan test --testsuite=Unit
  ```

You can also run all tests:

```bash
php artisan test
```

## Deployment

The project is deployed on Heroku. You can access the live version at:

**Production URL:** [https://vending-machine-system-a7e7429a0f92.herokuapp.com/](https://vending-machine-system-a7e7429a0f92.herokuapp.com/)

### Continuous Deployment

The repository is set up with GitHub Actions for continuous deployment. The workflow file is located in `.github/workflows/deploy.yml`. The deployment is triggered on every push to the `production` and `development` branches.

To deploy manually, run:

```bash
git push heroku main --force
```

Make sure your Heroku app is configured to use the `main` branch for deployments.

## Environment Variables

The application uses environment variables for configuration. The following variables are required:

- `APP_NAME` - The name of your application
- `APP_ENV` - The application environment (`local`, `production`, etc.)
- `APP_KEY` - The application key (generated using `php artisan key:generate`)
- `DB_CONNECTION` - The database connection type (e.g., `mysql`, `sqlite`)
- `DB_HOST` - The database host
- `DB_PORT` - The database port
- `DB_DATABASE` - The database name
- `DB_USERNAME` - The database username
- `DB_PASSWORD` - The database password

## Production URL

To test the deployed application, you can use the following production URL:

**Production URL:** [https://vending-machine-system-a7e7429a0f92.herokuapp.com/](https://vending-machine-system-a7e7429a0f92.herokuapp.com/)

This URL points to the live instance of the application hosted on Heroku. Use it to verify the deployment and interact with the live version of the Vending Machine System.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any changes youd like to make.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
