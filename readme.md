## Nguyên Hà Tech Framework

[![Build Status](https://travis-ci.org/fsd14/nht-starter.svg)](https://travis-ci.org/fsd14/nht-starter)

Core framework của Nguyên Hà dựa trên nền tảng framework Laravel 5.

### Cấu hình

- Duplicate file **env.example** và rename thành file **.env**
- Trên terminal chạy lệnh `php artisan key:generate` để lấy key, sau đó copy & paste vào giá trị biến `APP_KEY` trong file **.env**
- Nếu dùng [Homestead](http://laravel.com/docs/5.1/homestead) thì dùng thông tin mặc định, database name là `nht-starter`.
- Chạy lệnh `php artisan migrate` và `php artisan db:seed` để generate dữ liệu User.

### Bản quyền
Nguyên Hà Tech and the Laravel framework [MIT license](http://opensource.org/licenses/MIT)
