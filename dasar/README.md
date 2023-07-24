## 1. Testing

Untuk melakukan testing terhadap suatu feature / fungsi

    // Untuk FeatureTest
    php artisan make:test NamaTest

    // Untuk UnitTest
    php artisan make:test NamaTest --unit

    // Untuk run Test
    php artisan test

## 2. Environment

Dapat di akses menggunakan

    env(value, default)

atau

    Env::get(value, default)

Note: default optional

## 3. App Environment

Dapat di akses menggunakan

    App::environment(value)

digunakan untuk test App sedang berada di jenis environment yang mana, local, dev, staging, qa, atau production

## 4. Configuration

Harus mereturn array di akhir config. Pengambilannya value menggunakan titik (.), dapat diakses dengan

    config(value, default) -> config('contoh.name.first')

Jika ingin melakukan cache ke config (semisal banyak config, supaya tidak lemot, prosesnya akan melakukan merge ke semua config menjadi 1 file)

    php artisan config:cache

Jika ingin melakukan perubahan config namun config sudah di cache, harus di re-cache (hapus, cache lagi)

    php artisan config:clear

## 5. Dependency Injection

Semacam OOP, basis nya ada di constructor

## 5. Service Container - Basic

Digunakan untuk manajemen dependency, fitur laravel untuk melakukan Dependency Injection

    $foo = $this->app->make(Foo::class); // $foo = new Foo();

Secara default, saat pembuatan menggunakan constructor dengan parameter kosong

    new Foo();

## 6. Service Container - Binding

Bila ingin menggunakan constructor dengan parameter, maka di class yang akan dipanggil perlu menggunakan function closure bind() sebelum dilakukan pemanggilan class

    $this->app->bind(Person::class, function ($app) {
        return new Person("Carens", "Wijaya");
    });

    $person = $this->app->make(Person::class);

## 7. Service Container - Singleton

Ketikan melakukan pemanggilan (make), object dan bind (bila ada) akan dibuat berulang-ulang, bila hanya ingin membuat 1 object saja (singleton), maka dapat dilakukan dengan

    $this->app->singleton(Person::class, function ($app) {
            return new Person("Carens", "Wijaya");
    });

    $person1 = $this->app->make(Person::class); // new Person("Carens", Wijaya"); if not exists
    $person2 = $this->app->make(Person::class); // return existing

Maka $person1 dan $person2 akan sama

## 8. Service Container - Instance

Bila object sudah ada dan ingin dilakukan singleton, bisa dilakukan menggunakan instance

    $person = new Person("Carens", "Wijaya");
    $this->app->instance(Person::class, $person);

    $person1 = $this->app->make(Person::class); // $person

## 9. Service Container - Binding Interface

Ada bagusnya kalau buat class, buat juga interface nya sebagai kontrak dasarnya. Bisa menggunakan singleton juga dengan parameter

    $this->app->singleton(Interface::class, MyClass::class);

Pastikan MyClass sudah implements Interface
