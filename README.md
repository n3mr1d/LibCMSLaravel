# Laravel Livewire CMS Starter Kit

A modern, full-stack content management system built with Laravel 12, Livewire, and Flux UI components. This starter kit provides a solid foundation for building scalable web applications with a beautiful, responsive interface.

## 🚀 Features

- **Modern Laravel Framework**: Built on Laravel 12 with PHP 8.2+
- **Livewire Integration**: Full-stack reactive components without writing JavaScript
- **Flux UI Components**: Beautiful, accessible UI components for rapid development
- **Authentication System**: Complete user registration, login, and password management
- **User Profile Management**: Update profile information and change passwords
- **Email Verification**: Built-in email verification system
- **Dark Mode Support**: Automatic dark/light theme switching
- **Mobile Responsive**: Optimized for all device sizes
- **Modern Frontend**: Vite for fast asset compilation and TailwindCSS for styling
- **SQLite Database**: Lightweight database perfect for development and small applications
- **Testing Ready**: PHPUnit and Pest testing frameworks included

## 🛠 Technology Stack

### Backend
- **Laravel 12**: PHP web application framework
- **Livewire 3**: Full-stack reactive components
- **PHP 8.2+**: Modern PHP with latest features

### Frontend
- **Flux UI**: Component library for Livewire
- **TailwindCSS 4**: Utility-first CSS framework
- **Vite**: Fast frontend build tool
- **Alpine.js**: Minimal JavaScript framework (via Livewire)

### Database
- **SQLite**: File-based database (configurable to MySQL, PostgreSQL, etc.)

### Development Tools
- **Pest**: Modern testing framework
- **Laravel Pint**: Code style fixer
- **Laravel Sail**: Docker development environment (optional)

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- SQLite extension for PHP

## 🔧 Installation

### 1. Clone and Setup

```bash
# Clone the repository
git clone <repository-url> laravel-cms
cd laravel-cms

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 2. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Database Setup

```bash
# Create SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate
```

### 4. Build Assets

```bash
# Build frontend assets for development
npm run dev

# Or build for production
npm run build
```

### 5. Start Development Server

```bash
# Start Laravel development server
php artisan serve

# In another terminal, start Vite dev server (for hot reloading)
npm run dev
```

Visit `http://localhost:8000` to view your application.

## 🏗 Project Structure

```
├── app/
│   ├── Http/Controllers/     # HTTP controllers
│   ├── Livewire/            # Livewire components
│   │   ├── Auth/            # Authentication components
│   │   ├── Settings/        # User settings components
│   │   └── Actions/         # Livewire actions
│   ├── Models/              # Eloquent models
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Database migrations
│   ├── factories/           # Model factories
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   │   ├── components/     # Blade components
│   │   ├── livewire/       # Livewire views
│   │   └── flux/           # Flux component views
│   ├── js/                 # JavaScript files
│   └── css/                # CSS files
├── routes/
│   ├── web.php             # Web routes
│   ├── auth.php            # Authentication routes
│   └── console.php         # Console routes
├── public/                 # Public assets
├── storage/                # Storage directory
├── tests/                  # Tests
└── vendor/                 # Composer dependencies
```

## 📚 Key Components

### Authentication System

The application includes a complete authentication system with:

- **User Registration** (`/register`): Create new user accounts
- **User Login** (`/login`): Authenticate existing users
- **Password Reset** (`/forgot-password`): Reset forgotten passwords
- **Email Verification**: Verify user email addresses
- **Profile Management** (`/settings/profile`): Update user information
- **Password Change** (`/settings/password`): Change user passwords

### Livewire Components

#### Authentication Components
- `App\Livewire\Auth\Login`: Handle user login
- `App\Livewire\Auth\Register`: Handle user registration
- `App\Livewire\Auth\ForgotPassword`: Handle password reset requests
- `App\Livewire\Auth\ResetPassword`: Handle password reset
- `App\Livewire\Auth\VerifyEmail`: Handle email verification

#### Settings Components
- `App\Livewire\Settings\Profile`: Manage user profile
- `App\Livewire\Settings\Password`: Change user password
- `App\Livewire\Settings\Appearance`: Manage appearance settings

### Flux UI Components

The application uses Flux UI components for consistent, accessible interface elements:

- Form inputs and validation
- Buttons and navigation
- Modals and dropdowns
- Layout components (sidebar, header)
- Profile avatars and menus

## 🎨 Customization

### Styling

The application uses TailwindCSS for styling. You can customize:

1. **Colors**: Edit `tailwind.config.js` to modify the color palette
2. **Components**: Customize Flux components in `resources/views/flux/`
3. **Layouts**: Modify layouts in `resources/views/components/layouts/`

### Database

To use a different database:

1. Update `.env` file with your database credentials
2. Change `DB_CONNECTION` from `sqlite` to `mysql`, `pgsql`, etc.
3. Run migrations: `php artisan migrate`

### Adding Features

1. **Create Livewire Components**: `php artisan make:livewire ComponentName`
2. **Add Routes**: Add routes to `routes/web.php`
3. **Create Models**: `php artisan make:model ModelName -m`
4. **Add Migrations**: `php artisan make:migration create_table_name`

## 🧪 Testing

The application includes testing setup with Pest:

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/AuthTest.php

# Run tests with coverage
php artisan test --coverage
```

## 🚀 Deployment

### Production Build

```bash
# Install production dependencies
composer install --optimize-autoloader --no-dev

# Build production assets
npm run build

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force
```

### Environment Variables

Make sure to set these in production:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=your-generated-key
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## 📝 License

This project is licensed under the MIT License. See the LICENSE file for details.

## 🔗 Links

- [Laravel Documentation](https://laravel.com/docs)
- [Livewire Documentation](https://livewire.laravel.com)
- [Flux UI Documentation](https://flux.laravel.com)
- [TailwindCSS Documentation](https://tailwindcss.com)

## ⚡ Performance Tips

- Use `php artisan optimize` for production caching
- Enable OPcache in production
- Use a proper database (MySQL/PostgreSQL) for production
- Implement Redis for caching and sessions in production
- Use CDN for static assets

## 🆘 Troubleshooting

### Common Issues

1. **Permission Errors**: Ensure `storage/` and `bootstrap/cache/` are writable
2. **Database Connection**: Check your `.env` database settings
3. **Asset Loading**: Run `npm run build` if styles/scripts aren't loading
4. **Livewire Issues**: Clear cache with `php artisan optimize:clear`

### Debug Mode

Enable debug mode in development:

```env
APP_DEBUG=true
LOG_LEVEL=debug
```

---

Built with ❤️ using Laravel, Livewire, and Flux UI.
