# Kenya Administrative Boundaries API (KenAdminAPI)

The Kenya Administrative Boundaries API (KenAdminAPI) provides a comprehensive and easy-to-use interface for accessing detailed information about Kenya's administrative divisions, including Counties, Constituencies, and Wards. This API is designed to help developers integrate location-based data into their applications, supporting a wide range of use cases from geographical analysis to service delivery.

Note: These are Resources for Developers and/or anyone who needs all the Counties, Constituencies, and Wards in Kenya

## Features

- Retrieve detailed information about all Counties, Constituencies, and Wards in Kenya
- Search for administrative divisions by name or code
- Get hierarchical relationships between Counties, Constituencies, and Wards
- Support for pagination and filtering of results
- Easy integration with various frontend and backend technologies

## Getting Started

### Prerequisites

- PHP 7.3 or higher
- Composer
- MySQL or any other supported database

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/sosmongare/Kenya-Administrative-Boundaries-API-KenAdminAPI.git
    cd Kenya-Administrative-Boundaries-API-KenAdminAPI
    ```

2. Install the dependencies:

    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:

    ```bash
    cp .env.example .env
    nano .env
    ```

    Set your database connection details and other environment variables.

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

5. Run the database migrations:

    ```bash
    php artisan migrate
    ```

6. Seed the database with initial data (if available):

    ```bash
    php artisan db:seed
    ```

7. Start the development server:

    ```bash
    php artisan serve
    ```

    The application will be available at `http://127.0.0.1:8000`.

### API Documentation

The API documentation is generated using Swagger and can be accessed at `http://127.0.0.1:8000/api/documentation`.

## Usage

### Counties

- **Get all counties**

    ```
    GET /api/counties
    ```

- **Get a county by ID**

    ```
    GET /api/counties/{id}
    ```

- **Create a new county**

    ```
    POST /api/counties
    ```

- **Update a county**

    ```
    PUT /api/counties/{id}
    ```

- **Delete a county**

    ```
    DELETE /api/counties/{id}
    ```

- **Search counties**

    ```
    GET /api/counties/search/{query}
    ```

### Constituencies

- **Get all constituencies**

    ```
    GET /api/constituencies
    ```

- **Get a constituency by ID**

    ```
    GET /api/constituencies/{id}
    ```

- **Create a new constituency**

    ```
    POST /api/constituencies
    ```

- **Update a constituency**

    ```
    PUT /api/constituencies/{id}
    ```

- **Delete a constituency**

    ```
    DELETE /api/constituencies/{id}
    ```

- **Search constituencies**

    ```
    GET /api/constituencies/search/{query}
    ```

### Wards

- **Get all wards**

    ```
    GET /api/wards
    ```

- **Get a ward by ID**

    ```
    GET /api/wards/{id}
    ```

- **Create a new ward**

    ```
    POST /api/wards
    ```

- **Update a ward**

    ```
    PUT /api/wards/{id}
    ```

- **Delete a ward**

    ```
    DELETE /api/wards/{id}
    ```

- **Search wards**

    ```
    GET /api/wards/search/{query}
    ```

## Contributing

Contributions are welcome! Please open an issue or submit a pull request.


## Contact

For any questions or suggestions, please contact the developer:
_ **
- **Email**: sosmongare@gmail.com
- **Twitter**: [sosmongare@gmail.com](https://x.com/msnmongare)
- **Name**: Sospeter Mongare