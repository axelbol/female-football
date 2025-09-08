# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel application built with the official Livewire starter kit, designed for female football content. The application uses:

- **Laravel 12** with PHP 8.2+
- **Livewire** for reactive components
- **Livewire Flux** for UI components  
- **Tailwind CSS 4** for styling
- **Pest** for testing
- **SQLite** database (default)

## Development Commands

### Quick Start
```bash
# Start full development environment (server, queue, logs, vite)
composer dev
```

### Individual Services
```bash
# Start Laravel development server
php artisan serve

# Start Vite development server  
npm run dev

# Build assets for production
npm run build

# Start queue worker
php artisan queue:listen --tries=1

# Monitor logs
php artisan pail --timeout=0
```

### Testing
```bash
# Run all tests
composer test
# Or directly:
php artisan test

# Run specific test file
php artisan test tests/Feature/Auth/LoginTest.php

# Run tests with Pest directly
./vendor/bin/pest
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Clear application cache
php artisan config:clear
php artisan cache:clear
```

## Architecture

### Livewire Components
- **Auth components**: `app/Livewire/Auth/` - Handle authentication flows (login, register, password reset)
- **Settings components**: `app/Livewire/Settings/` - User profile, password, appearance settings
- **Actions**: `app/Livewire/Actions/` - Reusable actions like logout

### Authentication System
- Uses Laravel Breeze patterns with Livewire
- Rate limiting implemented in auth components
- Email verification support
- Password confirmation for sensitive operations

### UI Architecture
- **Flux components**: Custom UI component library via Livewire Flux
- **Layout system**: `resources/views/components/layouts/` with app and auth layouts
- **Blade components**: Reusable UI components in `resources/views/components/`
- **Custom Flux extensions**: Additional icons and components in `resources/views/flux/`

### Database
- SQLite for development (database/database.sqlite)
- Migrations in `database/migrations/`
- Uses Laravel's default user authentication schema

### Testing Strategy
- **Pest PHP** as testing framework
- Feature tests for authentication flows and settings
- Tests use in-memory SQLite database
- RefreshDatabase trait for clean test state

### Frontend Build
- Vite for asset compilation
- Tailwind CSS 4 with Vite plugin
- Hot reload enabled for development
- Assets in `resources/css/` and `resources/js/`

## Key Patterns

- All Livewire components use attributes for validation (`#[Validate]`)
- Rate limiting implemented with RateLimiter facade
- Authentication components use `#[Layout]` attributes for specific layouts
- Settings pages follow consistent navigation patterns
- Tests organized by feature areas (Auth, Settings, etc.)