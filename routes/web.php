<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReadingController;
use Illuminate\Http\Request;

//student part
use App\Http\Controllers\StudentAnswerEnglishController;
use App\Http\Controllers\StudentAnswerTagalogController;

Route::post('/student/add', [StudentAnswerEnglishController::class, 'store']);
Route::post('/student/add', [StudentAnswerTagalogController::class, 'store']);

// Home Route
Route::get('/', function () {
    return view('home');
});

Route::get('/main', function () {
    return view('main');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/students-eng', function () {
    return view('students-eng');
});

Route::get('/students-tag', function () {
    return view('students-tag');
});

Route::get('/students-results', function () {
    return view('students-results');
});




// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Teacher Routes
    Route::prefix('teacher')->group(function () {
        Route::get('/dashboard', function () {
            return view('teacher.dashboard');
        })->name('teacher.dashboard');

        Route::get('/about', function () {
            return view('teacher.about');
        })->name('teacher.about');
        
        Route::get('/readinglanguage', function () {
            return view('teacher.readinglanguage');
        })->name('teacher.readinglanguage');

        Route::get('/english', function () {
            return view('teacher.english');
        })->name('teacher.english');

        Route::get('/english-mahugani', function () {
            return view('teacher.english-mahugani');
        })->name('teacher.english-mahugani');

        Route::get('/english-dao', function () {
            return view('teacher.english-dao');
        })->name('teacher.english-dao');

        Route::get('/english-lawaan', function () {
            return view('teacher.english-lawaan');
        })->name('teacher.english-lawaan');

        Route::get('/filipino', function () {
            return view('teacher.filipino');
        })->name('teacher.filipino');

        Route::get('/filipino-dao', function () {
            return view('teacher.filipino-dao');
        })->name('teacher.filipino-dao');

        Route::get('/filipino-lawaan', function () {
            return view('teacher.filipino-lawaan');
        })->name('teacher.filipino-lawaan');

        Route::get('/filipino-mahugani', function () {
            return view('teacher.filipino-mahugani');
        })->name('teacher.filipino-mahugani');

        
        Route::get('/viewreports', [ReportsController::class, 'index'])->name('teacher.viewreports');

        // Add search route for teachers
        Route::get('/search-student', [StudentController::class, 'search'])->name('teacher.search-student');

        // Add the update-reading route
        Route::post('/update-reading', [ReadingController::class, 'updateReading'])->name('reading.update');
    });

    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.AdminDashboard');
        })->name('admin.dashboard');

        Route::get('/reports', function () {
            return view('admin.reports');
        })->name('admin.reports');

        Route::get('/student-records', [StudentController::class, 'index'])->name('admin.student-records');
        Route::post('/students', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');
        Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

        Route::get('/test-management', function () {
            return view('admin.testManagement');
        })->name('admin.test-management');  

        Route::get('/settings', function () {
            return view('admin.setting');
        })->name('admin.settings');

        Route::post('/users', [ProfileController::class, 'store']);
        Route::get('/users', [ProfileController::class, 'index']);
        Route::put('/users/{user}', [ProfileController::class, 'update']);
        Route::delete('/users/{user}', [ProfileController::class, 'destroy']);
    });
});


Route::get('/viewreports', function () {
    return view('viewreports');
});

Route::get('/log', function () {
    return view('log'); // This is your homepage
});

