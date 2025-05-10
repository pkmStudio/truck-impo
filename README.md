

# 🚀 Запуск Truck-Import

###  Клонирование репозитория
```bash
git clone https://github.com/pkmStudio/truck-impo.git
cd truck-impo
```


### Установка зависимостей
```bash
composer install
npm install
```


### Настройка `.env`
-   Скопируй `.env.example` в `.env`
```bash
cp .env.example .env
```
-   Укажи **настройки БД** (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)


### Запуск миграций и сидеров
```bash
php artisan migrate --seed
```


### Запуск Vite
```bash
npm run build
```


### Запуск локального сервера
```bash
php artisan serve
```


### Создание администратора вручную
```bash
php artisan tinker
```

```php
use Illuminate\Support\Facades\Hash;
use App\Models\User;

User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => Hash::make('password123'),
    'is_admin' => true,
]);
```


###  Готово!
-   Зайди в админку: `http://localhost:8000/admin/login`

-   Введи `admin@example.com` / `password123`
