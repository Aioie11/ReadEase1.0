# First-Time Password Change Feature - Testing Guide

## Overview
This feature ensures that all new users must change their password on their first login before accessing the system.

## How It Works

### For New Users:
1. Admin creates a user account with default credentials
2. User logs in with provided credentials
3. System detects it's their first login (`must_change_password = true`)
4. User is redirected to change password page
5. User must enter current password and new password
6. After successful password change, user can access the system normally

### For Existing Users:
- Existing users are not affected and can continue using their current passwords
- The migration sets `must_change_password = false` for all existing users

## Testing Steps

### Test 1: Create a New User (Admin)
1. Login as admin
2. Go to User Management
3. Create a new user with:
   - Name: "Test NewUser"
   - User ID: "TEST001"
   - Password: "defaultpass123"
   - Role: "student" (or teacher)

### Test 2: First-Time Login
1. Logout from admin account
2. Try to login with the new user credentials:
   - User ID: TEST001
   - Password: defaultpass123
3. Should be redirected to `/change-password` page
4. Fill in the form:
   - Current Password: defaultpass123
   - New Password: mynewpassword123
   - Confirm New Password: mynewpassword123
5. Submit the form
6. Should be redirected to appropriate dashboard

### Test 3: Subsequent Logins
1. Logout
2. Login again with:
   - User ID: TEST001
   - Password: mynewpassword123
3. Should go directly to dashboard (no password change required)

### Test 4: Existing Users
1. Login with existing user credentials (e.g., ADMIN123/admin123)
2. Should go directly to dashboard (no password change required)

## Security Features

### Password Requirements:
- At least 8 characters long
- Contains uppercase letter
- Contains lowercase letter
- Contains number

### Protection:
- Users cannot access any protected routes until password is changed
- Middleware prevents bypassing the password change requirement
- Current password verification ensures security

## Files Modified/Created:

### Database:
- `users` table: Added `must_change_password` and `password_changed_at` fields
- Migration: `add_password_change_fields_to_existing_users_table.php`

### Controllers:
- `LoginController.php`: Added password change logic and methods
- `ProfileController.php`: Updated to set password change requirement for new users

### Views:
- `change-password.blade.php`: New password change form

### Middleware:
- `RequirePasswordChange.php`: Protects routes until password is changed

### Routes:
- `/change-password` (GET): Show password change form
- `/change-password` (POST): Process password change

## Error Handling:
- Invalid current password
- Password confirmation mismatch
- Password doesn't meet requirements
- User not authenticated

## Success Messages:
- Password changed successfully
- Redirect to appropriate dashboard based on user role
