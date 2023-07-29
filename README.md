# Storagers
A monolith project as a mini e-commerce application made with TALL (Tailwind, Alpine, Laravel, Livewire) stack.

## Creator
- Vincent Franstyo (18221100)

## How to run 

### Requirements
- [PHP](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- [PHP Artisan](https://laravel.com/docs/8.x/artisan)
- [NodeJS](https://nodejs.org/en/download/)
- Make sure you have cloned the API from https://github.com/vincentfranstyo/storagersAPI.git 
- Run the API first

### Locally
1. Clone this repository
2. Run `composer install`
3. Run `npm install` 
4. Run `npm run dev`
5. Run `php artisan serve`
6. Enjoy!

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
