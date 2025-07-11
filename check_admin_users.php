<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "Admin users in database:\n";
$adminUsers = User::where('role', 'admin')->get(['id', 'name', 'userId', 'role']);

if ($adminUsers->count() > 0) {
    foreach ($adminUsers as $user) {
        echo "ID: {$user->id} - Name: {$user->name} - UserID: {$user->userId} - Role: {$user->role}\n";
    }
} else {
    echo "No admin users found in database.\n";
}

echo "\nAll users in database:\n";
$allUsers = User::all(['id', 'name', 'userId', 'role']);

if ($allUsers->count() > 0) {
    foreach ($allUsers as $user) {
        echo "ID: {$user->id} - Name: {$user->name} - UserID: {$user->userId} - Role: {$user->role}\n";
    }
} else {
    echo "No users found in database.\n";
} 