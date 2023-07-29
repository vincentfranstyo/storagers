# Storagers
A monolith project as a mini e-commerce application made with TALL (Tailwind, Alpine, Laravel, Livewire) stack.

## Creator
- Vincent Franstyo (18221100)

## How to run 

### Requirements
- [PHP](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [PHP Artisan](https://laravel.com/docs/8.x/artisan)
- [Laravel](https://laravel.com/docs/8.x/installation)
- [TALL Stack](https://github.com/laravel-frontend-presets/tall)
- [NodeJS](https://nodejs.org/en/download/)
- [Docker](https://docs.docker.com/get-docker/)
- [MySQL](https://dev.mysql.com/downloads/installer/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Tymon/JWTAuth](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)
- Make sure you have cloned the API from https://github.com/vincentfranstyo/storagersAPI.git 
- Run the API first

### Locally
1. Clone this repository
2. Run `composer install`
3. Run `npm install`
4. Run `php artisan key:generate`
5. Create your own database at the database directory, you can manually create it. (e.g. database.mysql)
6. Run `php artisan migrate`
7. Run `php artisan db:seed`
8. Set all the DB credentials in .env files (e.g. connection, host, port, name, password); 
9. Run `php artisan jwt:secret`
10. Run `npm run dev`
11. Run `php artisan serve`
12. Enjoy!

## Design Patterns
- **Strategy**: digunakan karena dapat mengubah behaviour dari sebuah class tanpa mengubah class itu sendiri
- **Singleton**: digunakan  karena dapat memastikan bahwa sebuah class hanya memiliki satu instance dan menyediakan akses global ke instance tersebut
- **Facade**: digunakan untuk memepermudah implementasi sistem kompleks menjadi subsistem

## Tech Stack
- Laravel
- TailwindCSS
- AlpineJS
- Livewire
- JWTAuth
- MySQL
- Docker
- Laravel Sail
- PHP 8
- Blade

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
- **Responsive Layout**
- **SOLID(SRP)** : saya sebisa mungkin mengimplementasikan SRP pada project ini, seperti pada `app/Http/Controllers/AuthController.php` dan `app/Http/Controllers/PurchaseController.php` dimana saya memisahkan fungsi-fungsi yang berbeda menjadi fungsi yang berbeda-beda sehingga dapat mempermudah untuk mengubah fungsi-fungsi tersebut tanpa mengubah fungsi lainnya
- **SOLID (OCP)**: OCP pada project ini diimplementasikan seperti pada `app/Http/Controllers/Controller.php` dimana Controller lainnya extend dari controller ini sehingga open for extension dan close for modification
- **SOLID (LSP)**: LSP adalah saat dimana superclass dapat digantikan oleh subclass tanpa mengubah fungsionalitas dari superclass tersebut.
- **SOLID (ISP)**: ISP adalah saat dimana sebuah interface tidak memiliki fungsi yang tidak digunakan oleh implementasi dari interface tersebut. Pada project ini, tidak ada interface yang tidak memiliki fungsi yang tidak digunakan.
- **SOLID (DIP)**: DIP adalah saat dimana sebuah fungsi tidak bergantung pada implementasi dari fungsi tersebut, tetapi bergantung pada interface dari fungsi tersebut.
