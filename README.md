<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/tuanbtre/csm"><img src="https://img.shields.io/packagist/dt/tuanbtre/csm" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/tuanbtre/csm"><img src="https://img.shields.io/packagist/v/tuanbtre/csm" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/tuanbtre/csm"><img src="https://img.shields.io/packagist/l/tuanbtre/csm" alt="License"></a>
</p>

## Giới thiệu

CSM là ứng dụng web được phát triển trên Laravel framework dành cho các website từ đơn giản cho đến chuyên nghiệp. tài liệu tham khảo bên dưới: 

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## Yêu cầu

    PHP >= 7.3
    BCMath PHP Extension
    Ctype PHP Extension
    Fileinfo PHP Extension
    JSON PHP Extension
    Mbstring PHP Extension
    OpenSSL PHP Extension
    PDO PHP Extension
    Tokenizer PHP Extension
    XML PHP Extension
	CURL OPEN
	
## Cài đặt

	vào thư mục chứa project
	cd project
	composer require tuanbtre/csm
	mở file .env thay đổi các thông số cấu hình kết nối database
	php artisan install:csm
	php artisan storage:link
	start project
	php artisan serve
	link addmin: 127.0.0.1:8000/admin     user/pass = administrator/websrv
	link public: 127.0.0.1
## Sử dụng

	Tham khảo (https://laravel.com)	
	
## Security Vulnerabilities

Mọi thông tin về vấn đề bảo mật hay mở rộng dự án vui lòng liên hệ qua email [tuancsharp@gmail.com](mailto:tuancsharp@gmail.com). xin chân thành cám ơn.

## License

CSM Laravel Framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
