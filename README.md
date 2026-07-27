
# Task-Assign-Website

## Installation

### Clone Repository

```bash
git clone https://github.com/YOUR_USERNAME/task-management.git
```

### Move to Project

```bash
cd task-management
```

### Install Dependencies

```bash
composer install
```

### Copy Environment File

```bash
cp .env.example .env
```

### Generate Application Key

```bash
php artisan key:generate
```

### Configure Database

Update the `.env` file.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=

### Run Migrations

```bash
php artisan migrate
```

---

### Run Seeders

```bash
php artisan db:seed
```

### Start Development Server

```bash
php artisan serve
```
Open

```
http://127.0.0.1:8000
```

## Demo Credentials
Admin - user name : admin@example.com
        password : password

Staff - user name : staff@example2.com
        password : staff@example2.com
>>>>>>> f84454940530efa6eb70f4cb1afabc99faf146d3
