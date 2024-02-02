## Summary
This is a simple employee management project. The features available in this project are login, register, email verification and password reset using Google SMTP, admin dashboard to manage users and master data.
## Database 

### Master Data

```sql
CREATE TABLE [companies](
	[id] [varchar](36) NOT NULL,
    [company_name] [nvarchar](255) NOT NULL,
	[email] [nvarchar](255) NOT NULL,
	[phone_number] [nvarchar](255) NOT NULL,
	[website] [nvarchar](255) NOT NULL,
	[address] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```

```sql
CREATE TABLE [company_assets](
	[id] [varchar](36) NOT NULL,
    [company_id] [varchar](36)NOT NULL,
    [file_name] [nvarchar](255) NOT NULL,
	[url] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```

```sql
CREATE TABLE [divisions](
	[id] [varchar](36) NOT NULL,
	[company_id] [varchar](36) NOT NULL,
    [division_name] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```

```sql
CREATE TABLE [positions](
	[id] [varchar](36) NOT NULL,
	[company_id] [varchar](36) NOT NULL,
    [position_name] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```

```sql
CREATE TABLE [employees](
	[id] [varchar](36) NOT NULL,
	[company_id] [varchar](36) NOT NULL,
	[division_id] [varchar](36) NOT NULL,
	[position_id] [varchar](36) NOT NULL,
    [employee_name] [nvarchar](255) NOT NULL,
    [employee_code] [nvarchar](255) NOT NULL,
	[email] [nvarchar](255) NOT NULL,
	[phone_number] [nvarchar](255) NOT NULL,
	[address] [nvarchar](255) NOT NULL,
	[entry_date] [date_time] NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```

```sql
CREATE TABLE [employee_asset](
	[id] [varchar](36) NOT NULL,
    [product_id] [varchar](36)NOT NULL,
    [file_name] [nvarchar](255) NOT NULL,
	[url] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```

## User Authentication

Custom user authentication with role based system and permission using (https://spatie.be/docs/laravel-permission/v6/basic-usage/role-permissions)

```sql
CREATE TABLE [modul](
	[id] [varchar](36) NOT NULL,
    [name] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```

```sql
CREATE TABLE [permissions](
	[id] [varchar](36) NOT NULL,
    [modul_id] [varchar](36)NOT NULL,
    [name] [nvarchar](255) NOT NULL,
	[guard_name] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```

```sql
CREATE TABLE [roles](
	[id] [varchar](36) NOT NULL,
    [name] [nvarchar](255) NOT NULL,
    [guard_name] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```

```sql
CREATE TABLE [role_has_permissions](
	[permission_id] [varchar](36) NOT NULL,
    [role_id] [varchar](36)NOT NULL,
)
```

```sql
CREATE TABLE [password_resets](
	[email] [nvarchar](256) NOT NULL,
    [token] [nvarchar](256) NOT NULL,
    [created_at] [datetime] NOT NULL,
)
```

```sql
CREATE TABLE [users](
	[id] [varchar](36) NOT NULL,
    [role_id] [varchar](36)NOT NULL,
    [name] [nvarchar](255) NOT NULL,
    [email] [nvarchar](256) NOT NULL,
	[password] [nvarchar](256) NOT NULL,
    [email_verified_at] [datetime] NULL,
    [remember_token] [nvarchar](256) NOT NULL,
    [is_email_verfied] [bool] NOT NULL,
	[created_at] [datetime] NOT NULL,
	[updated_at] [datetime] NULL,
)
```


## Gmail SMTP setting env

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Install and run the application on a local development environment

```
composer install
```
OR
```
composer update
```
Create new .env and copy paste from .env.example

```
php artisan key:generate
```

Setting up Database 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

```
php artisan migrate --seed
```

```
php artisan serve
```

## Running PHP Unit Test
Documentation (https://laravel.com/docs/10.x/testing)

```
php artisan test
```
