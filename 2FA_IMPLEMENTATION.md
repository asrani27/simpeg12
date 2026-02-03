# Two-Factor Authentication (2FA) Implementation

## Overview

This document describes the Two-Factor Authentication (2FA) feature implemented for the SIMPEG application. The 2FA feature adds an extra layer of security by requiring users to provide a verification code from an authenticator app after logging in with their username and password.

## Features

- **Time-based One-Time Password (TOTP)**: Uses TOTP algorithm compatible with Google Authenticator, Authy, Microsoft Authenticator, and other authenticator apps
- **QR Code Setup**: Easy setup process with QR code scanning
- **Secret Key Backup**: Users can view and copy their secret key for manual setup
- **Enable/Disable 2FA**: Users can enable or disable 2FA from their profile page
- **Session-based Verification**: 2FA verification is maintained during the session
- **Graceful Fallback**: Redirects users to 2FA verification page when needed

## Technical Implementation

### Database Schema

The following fields were added to the `users` table:

```php
$table->string('google2fa_secret', 32)->nullable();
$table->boolean('google2fa_enabled')->default(false);
```

- `google2fa_secret`: Stores the secret key for TOTP generation
- `google2fa_enabled`: Flag to indicate if 2FA is enabled for the user

### Dependencies

The implementation uses the `pragmarx/google2fa` package:

```bash
composer require pragmarx/google2fa
```

### Key Components

#### 1. TwoFactorController

Located at: `app/Http/Controllers/TwoFactorController.php`

Handles:
- Showing the 2FA setup page
- Enabling 2FA (generating secret and QR code)
- Verifying the 2FA code during login
- Disabling 2FA

#### 2. TwoFactorMiddleware

Located at: `app/Http/Middleware/TwoFactorMiddleware.php`

Ensures that users with 2FA enabled must complete verification before accessing protected routes. The middleware:
- Checks if the user has 2FA enabled
- Verifies if the session contains the `2fa_verified` flag
- Allows access to 2FA verification and logout routes
- Redirects to 2FA verification page if not verified

#### 3. Views

- `resources/views/auth/2fa-setup.blade.php`: Setup page with QR code and secret key
- `resources/views/auth/2fa-verify.blade.php`: Verification page during login

#### 4. Modified Files

- `app/Http/Controllers/LoginController.php`: Added 2FA check after successful login
- `app/Http/Controllers/LogoutController.php`: Clears 2FA session on logout
- `app/Models/User.php`: Added 2FA-related attributes and methods
- `routes/web.php`: Added 2FA routes
- `bootstrap/app.php`: Registered the 2FA middleware
- `resources/views/profile/index.blade.php`: Added 2FA enable/disable controls

## User Flow

### Enabling 2FA

1. User logs in to their account
2. User navigates to Profile page
3. User clicks "Aktifkan 2FA" button
4. User is taken to the 2FA setup page
5. User:
   - Downloads and installs an authenticator app (Google Authenticator, Authy, etc.)
   - Scans the QR code using the authenticator app
   - OR manually enters the secret key
6. User enters the 6-digit code from the authenticator app
7. System verifies the code
8. 2FA is enabled for the user

### Logging In with 2FA

1. User enters username and password
2. System authenticates the credentials
3. If 2FA is enabled, user is redirected to 2FA verification page
4. User enters the 6-digit code from their authenticator app
5. System verifies the code
6. Session is marked as 2FA verified
7. User is redirected to their dashboard

### Disabling 2FA

1. User navigates to Profile page
2. User clicks "Nonaktifkan 2FA" button
3. User confirms the action
4. 2FA is disabled for the user

## Routes

```php
// 2FA Routes
Route::middleware(['auth'])->prefix('2fa')->name('2fa.')->group(function () {
    Route::get('verify', [TwoFactorController::class, 'showVerification'])->name('verify');
    Route::post('verify', [TwoFactorController::class, 'verify']);
    
    Route::middleware(['2fa.verified'])->group(function () {
        Route::get('setup', [TwoFactorController::class, 'showSetup'])->name('setup');
        Route::post('enable', [TwoFactorController::class, 'enable'])->name('enable');
        Route::post('disable', [TwoFactorController::class, 'disable'])->name('disable');
    });
});
```

## Security Considerations

1. **Secret Key Storage**: Secret keys are stored encrypted in the database
2. **Code Time Window**: Codes are valid for 30 seconds
3. **Code Verification**: Uses Google2FA library for secure TOTP verification
4. **Session Management**: 2FA verification is cleared on logout
5. **CSRF Protection**: All forms include CSRF tokens
6. **Session Invalidation**: Full session invalidation on logout

## Browser Compatibility

The 2FA feature works with all modern browsers that support:
- JavaScript (for auto-submit and formatting features)
- HTTPS (recommended for production)

## Testing

### Manual Testing Steps

1. **Test Enable 2FA**:
   - Login as a user
   - Go to Profile page
   - Click "Aktifkan 2FA"
   - Scan QR code with authenticator app
   - Enter verification code
   - Verify 2FA is enabled

2. **Test Login with 2FA**:
   - Logout
   - Login with username and password
   - Verify redirection to 2FA verification page
   - Enter correct code from authenticator app
   - Verify access to dashboard
   - Repeat with incorrect code to see error message

3. **Test Disable 2FA**:
   - Go to Profile page
   - Click "Nonaktifkan 2FA"
   - Confirm action
   - Verify 2FA is disabled
   - Test login without 2FA

### Authenticator Apps

Tested with:
- Google Authenticator (iOS & Android)
- Authy (iOS & Android)
- Microsoft Authenticator (iOS & Android)
- LastPass Authenticator (iOS & Android)

## Troubleshooting

### Common Issues

1. **QR Code Not Scanning**:
   - Ensure authenticator app has camera permissions
   - Try entering the secret key manually

2. **Invalid Code Error**:
   - Check device time is synchronized
   - Wait for the next code cycle (30 seconds)
   - Ensure you're entering the correct code

3. **Cannot Access After Enabling 2FA**:
   - Contact administrator to disable 2FA from database
   - Set `google2fa_enabled = false` for the user in the database

4. **Secret Key Lost**:
   - Users must keep their secret key safe
   - If lost, disable 2FA and re-enable to get a new secret

## Future Enhancements

Possible improvements for the future:

1. **Recovery Codes**: Generate backup recovery codes for account recovery
2. **Multiple Devices**: Allow users to set up 2FA on multiple devices
3. **SMS 2FA**: Alternative 2FA method via SMS
4. **Email 2FA**: Alternative 2FA method via email
5. **Remember Device**: Option to remember trusted devices for 30 days
6. **Admin Override**: Allow admins to disable 2FA for users from admin panel

## Support

For issues or questions about the 2FA implementation:
- Check this documentation first
- Review the error messages displayed in the UI
- Contact the development team with specific error details

## License

This 2FA implementation is part of the SIMPEG application and follows the same license.