 ## Installation
1. Run `composer install`
2. Run `php artisan db:seed --class=DatabaseSeeder` to create a test user in the database
3. Run `php artisan create:ticket` to generate a new ticket (this will be associated with the user created in the previous step)
4. Run `php artisan update:ticket` to update the oldest ticket status to true (Processed)

## Testing the Endpoints
### Using POSTMAN
1. Make a **POST** request to `http://127.0.0.1:8000/api/get-token` with the following parameters in the body (x-www-form-urlencoded):
   - email: `test@test.com`
   - password: `password`
   - device_name: `test`
2. Copy the token received in the **Authorization (Bearer)** tab to be able to access the endpoints.
3. Make **GET** requests to the routes specified in the exercise document to test the results.
