## Nguyên Hà Tech Framework

[![Build Status](https://travis-ci.org/fsd14/nht-starter.svg)](https://travis-ci.org/fsd14/nht-starter)

Core framework của Nguyên Hà dựa trên nền tảng framework Laravel 5.

### Cấu hình

- Chạy lệnh `composer install` để cài đặt các packages cần thiết. Danh sách packages xem trong file **package.json**.
- Trên terminal chạy lệnh `php artisan key:generate` để lấy key, sau đó copy & paste vào giá trị biến `APP_KEY` trong file **.env**
- Duplicate file **env.example** và rename thành file **.env**
- Nếu dùng [Homestead](http://laravel.com/docs/5.1/homestead) thì dùng thông tin mặc định, chỉ cần sửa database name trong file **.env** là `nht-starter` hoặc bất kỳ tên nào bạn muốn.
- Chạy lệnh `php artisan migrate` và `php artisan db:seed` để generate dữ liệu Super Admin, Role, Permission...

### Hướng dẫn bắt đầu

#### Administrator

Thông tin đăng nhập tài khoản Super Admin:

> **URL**: http://domain.app/admin/login

> **Tài khoản**: admin@nguyenhats.com

> **Mật khẩu**: admin1234

Chú ý: Thay *domain.app* bằng domain của bạn.

#### Coding style và quy tắc tạo file

Tuân theo chuẩn code [PSR-1](http://www.php-fig.org/psr/psr-1/) và [PSR-2](http://www.php-fig.org/psr/psr-2/)

Nên sử dụng các lệnh artisan để tạo file:

- Tạo 1 file controller: `php artisan make:controller BlogController`
- Tạo 1 file Request: `php artisan make:request LoginFormRequest`
- Xem thêm trong list artisan: `php artisan`

#### BaseRepository

Là một abstract class chứa các method chung cho tất cả các Repository kế thừa nó. Xem danh sách method trong **app/Hocs/Core/BaseRepository.php**.

Các repositories nên *extends* class này và *implements* các interface tương ứng (chi tiết bên dưới).

#### Model, Repository và Service provider

Tất cả các file liên quan tới Model và Repository được đặt trong  1 folder riêng trong folder **Hocs** cùng với namespace `Nht\Hocs\TenFolderMoiTao`.

Ví dụ: khi làm việc với module `User`, ta sẽ tạo folder **app/Hocs/Users**. Tạo file model **User.php** bằng lệnh artisan `php artisan make:model Hocs/Users/User`.

Mỗi một module như thế sẽ bao gồm tối thiểu 3 file: model, interface, implementation. Khi checkout code về, hãy để ý trong folder **app/Hocs/Users** sẽ có tương ứng các file: **User.php**, **UserRepository**, **DbUserRepository**.

Các file implementation (vd: DbUserRepository) thì luôn luôn *extends* từ class `BaseRepository` và *implements* từ interface (vd: UserRepository).

Sau khi đã có các file trên, tiếp theo sẽ cần 1 file Service Provider để khai báo  module đó với IoC, tiện việc dùng Dependency Injection sau này. Sử dụng lệnh artisan `php artisan make:provider UserServiceProvider`.

Mở file **app/Providers/UserServiceProvider** và thực hiện bind implementation với interface của nó:

     /**
      * Register the application services.
      *
      * @return void
      */
     public function register()
     {
        $this->app->singleton('Nht\Hocs\Users\UserRepository', 'Nht\Hocs\Users\DbUserRepository');
     }

Cuối cùng là thêm dòng `Nht\Providers\UserServiceProvider::class` vào phía cuối mảng providers trong file **config/app.php**

Để sử dụng, ví dụ cần tìm 1 User theo ID, chúng ta chỉ cần inject interface của nó vào controller:

Trong **UserController**:

     public function getIndex(UserRepository $model)
     {
        $user = $model->getById(1);
     }

#### Middleware

Dùng lệnh artisan để tạo file: `php artisan make:middleware TenMiddleware`

Hệ thống hiện tại có 2 file middleware tự dev như sau:

- **AdminAuthentication.php**: Có tác dụng filter tất cả các requests tới khu vực admin, yêu cầu bắt buộc phải có quyền admin (Admin role) mới được truy cập.

- **CheckPermission.php**: Mục đích là để kiểm tra các quyền truy cập tới các requests. Khai báo quyền truy cập từng request tại file **app/Http/routes.php**

Ví dụ:

    Route::delete('users/{users}', [
      'as' => 'user.destroy',
      'uses' => 'UserController@destroy',
      'permissions' => 'user.destroy',
    ]);

Ví dụ trên yêu cầu quyền `user.destroy` để có thể truy cập link xóa một user.

#### Form Request và vấn đề validation

Dùng lệnh artisan để tạo file: `php artisan make:request TenFormRequest`

Các vấn đề về validation (rules, messages) sẽ được khai báo trong các file FormRequest này.

Sử dụng bằng cách inject vào một controller's method là hệ thống sẽ tự động validate request mỗi khi submit.

Trong **UserController**:

     /**
      * Store a newly created resource in storage.
      *
      * @return Response
      */
     public function store(AdminUserFormRequest $request)
     {
        if ($this->user->create($request->except('_token', '_method']))
        {
           return redirect()->route('user.create')->with('success', trans('general.messages.create_success'));
        }
        return redirect()->back()->withInputs()->with('error', trans('general.messages.create_fail'));
     }

#### Phân trang

Sử dụng class `NhtPagination` để phân trang theo style trong administrator hoặc phân trang thông thường theo style bootstrap mặc định của laravel cung cấp.

Nếu sử dụng class `NhtPagination` thì ở cuối data grid đặt 1 đoạn code sau:

    @include('admin/partials/paginate', ['data' => $users, 'appended' => ['email' => Request::get('email'), 'phone' => Request::get('phone')]])

Với `data` là một đối tượng `Illuminate\Support\Collection` chứa dữ liệu generated trong data grid. Và `appended` là một mảng thể hiện tham số muốn nối tiếp vào url: `http://starter.lc/admin/users/?email=&phone=0934577xxx&page=2`

#### Đa ngôn ngữ

### Bản quyền
Nguyên Hà Tech and the Laravel framework [MIT license](http://opensource.org/licenses/MIT)
