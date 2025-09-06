# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Development Commands

### Setup and Installation
```bash
# Initial setup after cloning
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite  # SQLite database file
php artisan migrate
```

### Development Workflow
```bash
# Start full development environment (server, queue, logs, vite)
composer run dev

# Individual services
php artisan serve              # Laravel development server
php artisan queue:listen --tries=1  # Queue worker
php artisan pail --timeout=0  # Log monitoring
npm run dev                    # Vite dev server for assets
```

### Testing
```bash
# Run all tests
composer run test
# OR manually:
php artisan test

# Run specific test
php artisan test --filter="ProfileUpdateTest"

# Run tests with coverage (if configured)
php artisan test --coverage
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Run migrations
php artisan migrate
php artisan migrate:fresh --seed  # Fresh migration with seeders
```

### Asset Building
```bash
npm run build  # Production build
npm run dev    # Development build with watching
```

## Architecture Overview

### Tech Stack
- **Framework**: Laravel 12 with PHP 8.2+
- **Frontend**: Livewire 3 with Livewire Flux UI components
- **Styling**: TailwindCSS v4
- **Database**: SQLite (default), configurable to MySQL/PostgreSQL
- **Testing**: Pest PHP
- **Build Tool**: Vite
- **Queue System**: Database-driven queues

### Core Application Structure

This is a **Library Management System (LibCMS)** with the following main entities:

#### Domain Models
- **Books**: Core inventory with categories, stock tracking, ISBN, cover images
- **Categories**: Book categorization system
- **Users**: Authentication with role-based access (admin/guest), online status tracking
- **Request Peminjams**: Book borrowing requests with approval workflow
- **Peminjams**: Active borrowing records 
- **Dendas**: Fine/penalty system for overdue/damaged/lost books
- **Reservations**: Book reservation system
- **Wishlists**: User book wishlists
- **Notifications**: In-app notification system

#### Key Business Flow
1. Users request book borrowing (`request_peminjams`)
2. Admin approves/rejects requests 
3. Approved requests become active borrowings (`peminjams`)
4. System tracks overdue items and generates fines (`dendas`)
5. Support for reservations and wishlists

### Livewire Components Architecture

The application uses Livewire for interactive components:

#### Settings Pages (Fully Implemented)
- `App\Livewire\Settings\Profile` - User profile management
- `App\Livewire\Settings\Password` - Password updates
- `App\Livewire\Settings\Appearance` - Theme switching (light/dark/system)

#### Component Patterns
- Full-page Livewire components for settings routes
- Uses Livewire Flux UI component library for consistent styling
- Form validation with real-time feedback
- Event-driven updates with `$this->dispatch()`

### Database Schema Notes

#### Key Relationships
- Books belong to Categories (foreign key)
- Request Peminjams link Users and Books with approval workflow
- Peminjams reference the original request and track borrowing lifecycle
- Dendas (fines) are tied to specific borrowings and users
- Users have role-based permissions and online status tracking

#### Migration Naming Convention
Files use date prefixes (2025_09_05_*) indicating recent development.

### UI/UX Framework

#### Livewire Flux Components
The app extensively uses Flux UI components:
- `<flux:button>`, `<flux:input>`, `<flux:navlist>` 
- `<flux:sidebar>`, `<flux:dropdown>`, `<flux:profile>`
- Theme system with `x-flux.appearance` for light/dark/system modes

#### Layout Structure
- Sidebar navigation with collapsible mobile support
- User profile dropdown with settings access
- Responsive design with desktop/mobile menu variants

## Development Guidelines

### Adding New Features
- Use Livewire components for interactive pages
- Follow the existing settings page pattern for new form-based features
- Leverage Flux UI components for consistent styling
- Add appropriate test coverage using Pest

### Database Changes
- Create migrations for schema changes
- Update corresponding Eloquent models
- Consider relationships and foreign key constraints
- Test migration rollbacks

### Testing Approach
- Feature tests for Livewire components using `Livewire::test()`
- Model factories for test data generation
- SQLite in-memory database for fast tests
- Follow existing test patterns in `tests/Feature/Settings/`

### Code Organization
- Models in `app/Models/` with relationships defined
- Livewire components in `app/Livewire/` with corresponding views
- Database migrations follow Laravel conventions
- Use form validation in Livewire components
