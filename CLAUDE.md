## General code instructions

- Don't generate code comments above the methods or code blocks if they are obvious. Generate comments only for something that needs extra explanation for the reasons why that code was written

---

## PHP instructions

- In PHP, use `match` operator over `switch`  whenever possible
- Use PHP 8 constructor property promotion. Don't create an empty Constructor method if it doesn't have any parameters
- Using Services in Controllers: if Service class is used only in ONE method of Controller, inject it directly into that method with type-hinting. If Service class is used in MULTIPLE methods of Controller, initialize it in Constructor
- Use return types in functions whenever possible, adding the full path to classname to the top in 'use' section

---

## Laravel instructions

- For DB pivot tables, use correct alphabetical order, like "project_role" instead of "role_project"
- I am using composer run dev locally, so always assume that the main URL of the project is `http://localhost:8000`
- **Eloquent Observers** should be register in Eloquent Models wit PHP Attributes, and not in AppServiceProvider. Example: `#[ObservedBy([UserObserver::class])]` with `use Illuminate\Database\Eloquent\Attributes\ObservedBy;` on top
- When generating Controllers, put validation in Form Request classes
- Aim for "slim" Controllers and put larger logic pieces in Service classes
- Use Laravel helpers instead of `use` section classes whenever possible. Examples: use `auth()->id()` instead of `Auth::id()` and adding `Auth` in the `use` section. Another example: use `redirect()->route()` instead of `Redirect::route()`

---

## Use Laravel 11+ skeleton structure

- **Service Providers**: there are no other service providers except AppServiceProvider. Don't create new service providers unless absolutely necessary. Use Laravel 11+ new features, instead. Or, if you really need to create a new service provider, register it in `bootstra/providers.php` and not `config/app.php` like it used to be before Laravel 11
- **Event Listeners**: since Laravel 11, Listeners auto-listen for the events if they are type-hinted correctly
- **Console Scheduler**: scheduled commands should be in `routes/console.php` and not `app/Console/Kernel.php` which doesn't exist since Laravel 11
- **Middleware**: whenever possible, use Middleware by class name in the routes. But if you do need to register Middleware alias, it should be registered in `bootstrap/app.php` and not `app/Http/Kernel.php` which doesn't exist since Laravel 11
- **Tailwind**: in new Blade pages, use Tailwind and not Bootstrap. Tailwind is already pre-configured since Laravel 11, with Vite
- **Faker**: in Factories, use `fake()` helper instead of `$this->faker`
- **Policies**: Laravel automatically auto-discovers Policies, no need to register them in the Service Providers

---

## Testing instructions

Every test method should be structured with Arrange-Act-Assert

In the Arrange phase, use Laravel factories but add meaningful column values and variable names if they help to understand failed tests better.
Bad example: `$user1 = User::factory()->create();`
Better example: `$adminUser = User::factory()->create(['email' = 'admin@admin.com']);`

In the Assert phase, perform these assertions when applicable:
- HTTP status code returned from Act: `assertStatus()`
- Structure/data returned from Act (Blade or JSON): functions like `assertViewHas()`, `AssertSee()`, `assertDontSee()` or `assertJsonContains()`
- Or, redirect assertions like `assertRedirect()` and `assertSessionHas()` in case of Flash session value passed
- DB changes if any create/update/delete operation was performed: functions like `assertDatabaseHas()`, `assertDatabaseMissing()`, `expect($variable)->toBe()` and similar

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
