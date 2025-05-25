# 🌍 Localization - MindBeamer.io

## Overview

MindBeamer.io supports multiple languages through a central configuration system. All language settings are managed in `config/languages.php`.

## Currently Supported Languages

- **German** (de) 🇩🇪
- **English** (en) 🇬🇧  
- **Spanish** (es) 🇪🇸

## 🔧 Adding a New Language

### Step 1: Extend Configuration

Extend `config/languages.php`:

```php
'available_locales' => [
    'en',
    'de', 
    'es',
    'it', // NEW: Add Italian
],

'locale_names' => [
    'en' => 'English',
    'de' => 'Deutsch',
    'es' => 'Español', 
    'it' => 'Italiano', // NEW
],

'locale_flags' => [
    'en' => '🇬🇧',
    'de' => '🇩🇪',
    'es' => '🇪🇸',
    'it' => '🇮🇹', // NEW
],
```

### Step 2: Create Translation Files

Create the directory and translation files:

```bash
mkdir -p lang/it
```

Copy and translate the following files:
- `lang/it/messages.php` (Main translations)
- `lang/it/emails.php` (Email translations)
- `lang/it/privacy.php` (Privacy texts)
- `lang/it/legal.php` (Legal texts)
- `lang/it/cookie-consent.php` (Cookie consent)

### Step 3: Add Route

In `routes/web.php` add:

```php
Route::get('/it', [LocaleController::class, 'it'])->name('locale.it');
```

### Step 4: Create Controller Method

In `app/Http/Controllers/LocaleController.php`:

```php
public function it()
{
    app()->setLocale('it');
    session()->put('locale', 'it');
    return redirect()->back();
}
```

### Step 5: Extend Navigation

Add Italian to the language selector component (if present).

## ✅ That's it!

**Important**: The system automatically recognizes the new language:
- ✅ Emails are automatically sent in the new language
- ✅ Admin emails show the correct language information
- ✅ All services work without code changes

## 🔍 System Architecture

### Central Configuration
- `config/languages.php` - Main configuration file
- `app/Services/LocaleService.php` - Service for language management
- `app/Services/TranslationService.php` - Translation service

### Email System
- `app/Mail/DemoRequest.php` - Admin notification
- `app/Mail/DemoRequestConfirmation.php` - User confirmation
- Templates automatically multilingual

### Important Services
```php
$localeService = app(\App\Services\LocaleService::class);

// Get available languages
$locales = $localeService->getAvailableLocales();

// Display name with flag
$display = $localeService->getFormattedDisplayName('de'); // "Deutsch 🇩🇪"

// Validate language
$valid = $localeService->sanitizeLocale('invalid'); // Fallback to 'en'
```

## 🚫 What NOT to Do

- ❌ Hardcoded language arrays in templates or services
- ❌ Duplicate configuration in `config/app.php` and `config/languages.php`
- ❌ Direct translations without the `__()` helper
- ❌ Language-specific if/else blocks in code

## 🧪 Testing

After adding a new language:

1. Clear cache: `php artisan config:clear`
2. Test email functionality with MailPit
3. Test language selection on the website
4. Check admin emails for correct language display

## 📝 Troubleshooting

### Problem: New language is not recognized
- ✅ Check `config/languages.php` syntax
- ✅ Run `php artisan config:clear`
- ✅ Ensure all arrays have been extended

### Problem: Emails in wrong language
- ✅ Check if translation files exist
- ✅ Validate `__()` helper in templates
- ✅ Test `App::getLocale()` in the controller

### Problem: Flags are not displayed
- ✅ Check `locale_flags` array in `config/languages.php`
- ✅ Ensure UTF-8 is correctly configured
