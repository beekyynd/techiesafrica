# Laravel Test

## Requirements
- PHP 8.1+
- Composer
- MySQL / Postgres
- Laravel 10

## Setup
1. clone repo
2. cp .env.example .env and configure DB
3. composer install
4. php artisan key:generate
5. php artisan migrate --seed
6. composer require laravel/sanctum maatwebsite/excel guzzlehttp/guzzle
7. php artisan storage:link (if you want public link)
8. php artisan serve

## API
- POST /api/register
- POST /api/login
- Use Bearer token for protected routes.

See postman_collection.json for Postman API request or cURL below

## Example API Requests using cURL

1. Register

curl -X POST http://127.0.0.1:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
        "name":"John Doe",
        "email":"john@example.com",
        "password":"secret",
        "password_confirmation":"secret"
      }'

2. Login

curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
        "email":"john@example.com",
        "password":"secret"
      }'

## The response will include a token. Use it in the next requests:

-H "Authorization: Bearer <TOKEN>"

3. Logout

curl -X POST http://127.0.0.1:8000/api/logout \
  -H "Authorization: Bearer <TOKEN>"

4. List Products

curl -X GET http://127.0.0.1:8000/api/products \
  -H "Authorization: Bearer <TOKEN>"

5. Create Product with image upload

curl -X POST http://127.0.0.1:8000/api/products \
  -H "Authorization: Bearer <TOKEN>" \
  -F "name=Red Shirt" \
  -F "sku=SHIRT-RED-M" \
  -F "price=25.50" \
  -F "quantity=20" \
  -F "image=@/path/to/image.jpg"

  6. Create Product without image

  curl -X POST http://127.0.0.1:8000/api/products \
  -H "Authorization: Bearer <TOKEN>" \
  -H "Content-Type: application/json" \
  -d '{
        "name":"Blue Jeans",
        "sku":"JEANS-BLUE-32",
        "price":45.00,
        "quantity":15
      }'

7. Bulk import Products using Excel

curl -X POST http://127.0.0.1:8000/api/products/import-excel \
  -H "Authorization: Bearer <TOKEN>" \
  -F "file=@/path/to/products.xlsx"

8. Place an order

curl -X POST http://127.0.0.1:8000/api/orders \
  -H "Authorization: Bearer <TOKEN>" \
  -H "Content-Type: application/json" \
  -d '{
        "items":[
          {"product_id":1,"quantity":2},
          {"product_id":2,"quantity":1}
        ]
      }'

9. List Orders

curl -X GET http://127.0.0.1:8000/api/orders \
  -H "Authorization: Bearer <TOKEN>"

10. Low stock report

curl -X GET http://127.0.0.1:8000/api/reports/low-stock \
  -H "Authorization: Bearer <TOKEN>"

11. Sales summary report

curl -X GET http://127.0.0.1:8000/api/reports/sales-summary \
  -H "Authorization: Bearer <TOKEN>"


