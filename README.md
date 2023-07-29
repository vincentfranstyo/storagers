# Storagers
A monolith project as a mini e-commerce application made with TALL (Tailwind, Alpine, Laravel, Livewire) stack.

## Creator
- Vincent Franstyo (18221100)

## How to run on docker
1. Clone this repository
2. Get Docker Desktop
3. Ensure that docker desktop is running
4. Run `docker-compose up -d`
5. Open through docker desktop
6. Enjoy!

## How to run locally
1. Clone this repository
2. Run `composer install`
3. Run `npm install`
4. Run `npm run dev`
5. Run `php artisan serve`
6. Open `localhost:8000`
7. Enjoy!

## Design Patterns
- Strategy: digunakan karena dapat mengubah behaviour dari sebuah class tanpa mengubah class itu sendiri
- Singleton: digunakan  karena dapat memastikan bahwa sebuah class hanya memiliki satu instance dan menyediakan akses global ke instance tersebut
- Facade: digunakan untuk memepermudah implementasi sistem kompleks menjadi subsistem

## Tech Stack
- Laravel
- TailwindCSS
- AlpineJS
- Livewire
- JWTAuth
- MySQL
- Docker

## Endpoints
### Auth
- `POST /api/auth/login`: login 
- `POST /api/auth/register`: register 
- `POST /api/auth/logout`: logout

### Pages
- `GET /login`: login page
- `GET /register`: register page
- `GET /home`: home page
- `GET /detail/name`: detail page
- `GET /purchase/name`: purchase page
- `GET /history`: history page

### Functional
- `POST /purchase/name`: purchase product

## Bonus
- Responsive Layout
- SOLID(SRP) : saya sebisa mungkin mengimplementasikan SRP pada project ini, seperti pada `app/Http/Controllers/AuthController.php` dan `app/Http/Controllers/PurchaseController.php` dimana saya memisahkan fungsi-fungsi yang berbeda menjadi fungsi yang berbeda-beda sehingga dapat mempermudah untuk mengubah fungsi-fungsi tersebut tanpa mengubah fungsi lainnya
