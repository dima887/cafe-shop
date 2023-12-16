<h1>Cafe Shop</h1>

<p>Cafe Shop is a convenient web application for cafe management, providing diverse functionality for users and administrators.</p>

<h3>Main Features:</h3>
<ol>
    <li>Authentication and Registration:
    <ul>
        <li>Implemented using <a href="https://laravel.com/docs/10.x/sanctum" target="_blank">Sanctum</a>.</li>
    </ul>
    </li>
    <li>Cart and Payment:
        <ul>
            <li>Users can easily add items to the cart and securely pay for them using the <a href="https://stripe.com/docs/api/connected-accounts" target="_blank">Stripe API</a>.</li>
        </ul>
    </li>
    <li>Product Viewing and Review Submission:
        <ul>
            <li>Authorized users can submit reviews for products.</li>
        </ul>
    </li>
    <li>Administrative Panel:
        <ul>
            <li>Add, edit, and delete products and categories.</li>
            <li>News Parsing.</li>
            <li>Order List.</li>
        </ul>
    </li>
    <li>Swagger UI:
        <ul>
            <li>List of API routes with descriptions</li>
            <li>Examples of received data</li>
            <li>Examples for sending data</li>
        </ul>
    </li>
</ol>

<h3>Technologies:</h3>
<ol>
    <li>Backend: Laravel</li>
    <li>Frontend: React.js</li>
    <li>Test: PHPUnit</li>
    <li>Docker: The project is easily deployable locally using Docker.</li>
    <li>Swagger UI: Visualize and interact with the API’s resources without having any of the implementation logic in place.</li>
    <li>Redis: Redis is used for data caching and performance improvement.</li>
    <li>Stripe API: Integrated with the Stripe payment system API for secure and convenient payments.</li>
    <li>WebSockets: for instant updates of the order list in the administrative panel.</li>
    <li>Parser: used the <a href="https://github.com/Imangazaliev/DiDOM" target="_blank">DiDOM library for parsing food-related news</a>.</li>
    <li>Design Patterns:
        <ul>Facade: for grouping functionality and working with the Stripe API.</ul>
        <ul>Factory Method: for creating objects to work with different parsers.</ul>
    </li>
</ol>

<h3>Deploy:</h3>

In the backend `directory`, rename the `.env.example` file to `.env`.

Execute the following command at the root of the project:

```bash
docker-compose up -d --build
```

Enter the backend container:

```bash
docker exec -it backend bash
```

Run the following command to create tables in the database:

```
php artisan migrate
```

Run the following command if you want to populate the table with test data:

```
php artisan db:seed
```

Admin Data:
email = `admin@mail.com`
password = `password`

User Data:
email = `user@mail.com`
password = `password`

For authentication to work, add the following lines to your hosts file:

```
127.0.0.1 shop.local
127.0.0.1 api.shop.local
```

Alternatively, run the following file in the terminal, and it will add the necessary lines:

```bash
.\update_hosts.sh
```

To enable payment, register or log in to your <a href="https://stripe.com/en-gb">Stripe</a> account.
Go to <a href="https://dashboard.stripe.com/test/apikeys">apikeys</a> and copy your `Secret key` into the 
`stripe-cli\stripe_cli.env` file under the `STRIPE_API_KEY` variable. Also, add it to the `backend\.env` file under 
the `STRIPE_SECRET_KEY` variable.

The project will be accessible through the following links:

Frontend `shop.local:3000`

Backend `api.shop.local:8080`

Swagger-documentation `api.shop.local:8080/api/documentation`

PHPMyAdmin `localhost:8081`

Redis-commander `localhost:8082`