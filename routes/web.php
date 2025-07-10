<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\ReadingMaterialController;

use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentAnswerEnglishController;
use App\Http\Controllers\StudentAnswerTagalogController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;

// Home Route
Route::get('/', function () {
    return view('auth.login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Change Routes (require auth but NOT password.change middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [LoginController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [LoginController::class, 'changePassword'])->name('password.change.post');
});

// Protected Routes (require authentication and password change if needed)
Route::middleware(['web', 'auth', 'password.change'])->group(function () {
    // Teacher Routes
    Route::prefix('teacher')->group(function () {
        Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');

        Route::get('/students', function () {
            return view('teacher.students');
        })->name('teacher.students');

        Route::get('/student-management', [TeacherController::class, 'studentManagement'])->name('teacher.student-management');

        Route::get('/view', [TeacherController::class, 'view'])->name('teacher.view');

        Route::get('/about', function () {
            return view('teacher.about');
        })->name('teacher.about');

        Route::get('/readinglangu', function () {
            return view('teacher.assessment');
        })->name('teacher.readinglanguage');

        Route::get('/passage', [TeacherController::class, 'passage'])->name('teacher.passage');

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

        Route::get('/filipinoreport', [ReportsController::class, 'filipinoReport'])->name('teacher.filipinoreport');

        // Reading Assessment Routes
        Route::post('/save-reading-assessment', [ReportsController::class, 'saveReadingAssessment'])->name('teacher.save-reading-assessment');
        Route::get('/get-student-assessments/{studentId}', [ReportsController::class, 'getStudentAssessments'])->name('teacher.get-student-assessments');
        Route::get('/grade-level-data', [ReportsController::class, 'getGradeLevelData'])->name('teacher.grade-level-data');
        Route::get('/comprehension-level-data', [ReportsController::class, 'getTeacherComprehensionLevelDistribution'])->name('teacher.comprehension-level-data');
        Route::get('/section-wise-reading-data', [ReportsController::class, 'getSectionWiseReadingData'])->name('teacher.section-wise-reading-data');
        Route::get('/section-wise-comprehension-data', [ReportsController::class, 'getSectionWiseComprehensionData'])->name('teacher.section-wise-comprehension-data');

        // Comprehension Details Routes
        Route::get('/get-student-comprehension/{studentId}/{language?}', [TeacherController::class, 'getStudentComprehensionDetails'])->name('teacher.get-student-comprehension');
        Route::get('/get-students-by-section', [TeacherController::class, 'getStudentsBySection'])->name('teacher.get-students-by-section');

        // Add search route for teachers
        Route::get('/search-student', [StudentController::class, 'search'])->name('teacher.search-student');

        // Add route to get students by section and grade
        Route::get('/students-by-section', [StudentController::class, 'getStudentsBySection'])->name('teacher.students-by-section');

        // Add route to get student details with assessments
        Route::get('/student/{student}', [StudentController::class, 'show'])->name('teacher.student.show');

        // Add the update-reading route
        Route::post('/update-reading', [ReadingController::class, 'updateReading'])->name('reading.update');

        // Add route for reading progress report
        Route::get('/reading-progress', function () {
            return view('teacher.report');
        })->name('teacher.reading-progress');

        // Feedback routes
        Route::post('/save-feedback', [TeacherController::class, 'saveFeedback'])->name('teacher.save.feedback');
        Route::post('/send-feedback', [TeacherController::class, 'sendFeedback'])->name('teacher.send.feedback');
        Route::get('/feedback-history', [TeacherController::class, 'getFeedbackHistory'])->name('teacher.feedback.history');

        Route::get('/reading-assessment-controls', [App\Http\Controllers\TeacherController::class, 'readingAssessmentControls'])->name('teacher.reading-assessment-controls');
    });

    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

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

        Route::get('/user-management', function () {
            return view('admin.userManagement');
        })->name('admin.user-management');

        Route::delete('/delete-test/{id}', [AdminController::class, 'deleteTest'])->name('admin.delete.test');

        Route::post('/users', [ProfileController::class, 'store']);
        Route::get('/users', [ProfileController::class, 'index']);
        Route::put('/users/{user}', [ProfileController::class, 'update']);
        Route::delete('/users/{user}', [ProfileController::class, 'destroy']);
    });

    // Student Routes
    Route::prefix('student')->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
        Route::get('/reports', [StudentDashboardController::class, 'reports'])->name('student.reports');
        Route::post('/add/english', [StudentAnswerEnglishController::class, 'store'])->name('student.add.english');
        Route::get('/unread-feedback-count', [StudentDashboardController::class, 'getUnreadFeedbackCount'])->name('student.unread.feedback.count');
    });

    // Reading Materials Routes
    Route::prefix('api')->group(function () {
        Route::post('/reading-materials', [ReadingMaterialController::class, 'store'])->name('reading-materials.store');
        Route::get('/reading-materials/{grade}/{subject}', [ReadingMaterialController::class, 'getByGradeAndSubject'])->name('reading-materials.get-by-grade-subject');
        Route::get('/reading-materials/admin/{grade}/{subject}', [ReadingMaterialController::class, 'getByGradeAndSubjectForAdmin'])->name('reading-materials.get-by-grade-subject-admin');
        Route::put('/reading-materials/{id}', [ReadingMaterialController::class, 'update'])->name('reading-materials.update');
        Route::delete('/reading-materials/{id}', [ReadingMaterialController::class, 'destroy'])->name('reading-materials.destroy');
        Route::post('/reading-materials/{id}/publish', [ReadingMaterialController::class, 'publish'])->name('reading-materials.publish');

    });
});

// Student Routes
Route::get('/stud-dash', [StudentDashboardController::class, 'index'])->name('student.dashboard');

// Reading Material Routes for Students
Route::get('/stud-eng', [ReadingMaterialController::class, 'getPublishedMaterial'])->name('student.students-eng');
Route::get('/stud-fil', [ReadingMaterialController::class, 'getPublishedMaterial'])->name('student.students-fil');

Route::get('/stud-reports', [StudentDashboardController::class, 'reports'])->name('student.reports');

// Route for checking reading assessment updates (auto-refresh)
Route::get('/student/check-reading-updates/{studentId}', [StudentDashboardController::class, 'checkReadingUpdates'])->name('student.check.reading.updates');

Route::post('/student/add/filipino', [StudentAnswerTagalogController::class, 'store'])->name('student.add.filipino');



// Student Assessment Routes
Route::post('/api/compute-student-assessment', [ReportsController::class, 'computeStudentAssessment']);
Route::get('/api/student-assessment/{studentName}/{grade}/{section}/{language}', [ReportsController::class, 'getStudentAssessment']);

// Reading Level Distribution Routes
Route::get('/api/reading-level-distribution/english', [ReportsController::class, 'getEnglishReadingLevelDistribution']);
Route::get('/api/reading-level-distribution/filipino', [ReportsController::class, 'getFilipinoReadingLevelDistribution']);

// Reading Level Distribution by Section Routes
Route::get('/api/reading-level-distribution/english/by-section', [ReportsController::class, 'getEnglishReadingLevelDistributionBySection']);
Route::get('/api/reading-level-distribution/filipino/by-section', [ReportsController::class, 'getFilipinoReadingLevelDistributionBySection']);

// Comprehension Level Distribution Routes
Route::get('/api/comprehension-level-distribution/english', [ReportsController::class, 'getEnglishComprehensionLevelDistribution']);
Route::get('/api/comprehension-level-distribution/filipino', [ReportsController::class, 'getFilipinoComprehensionLevelDistribution']);

// Comprehension Level Distribution by Section Routes
Route::get('/api/comprehension-level-distribution/english/by-section', [ReportsController::class, 'getEnglishComprehensionLevelDistributionBySection']);
Route::get('/api/comprehension-level-distribution/filipino/by-section', [ReportsController::class, 'getFilipinoComprehensionLevelDistributionBySection']);



