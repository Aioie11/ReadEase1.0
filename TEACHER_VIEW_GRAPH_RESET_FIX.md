# Teacher View Graph Reset Fix

## Problem
In the teacher side (`view.blade.php`), when the admin publishes a new reading material, the graph data was not being reset like it was in the student side (`stud-reports.blade.php`). The graphs continued to show data from previous reading materials instead of clearing when new materials were published.

## Root Cause
The `TeacherController::view()` method was retrieving ALL reading assessments for a student regardless of publication status:

```php
// OLD CODE - Gets all assessments regardless of publication status
$readingAssessments = ReadingAssessment::with('readingMaterial')
    ->where('student_id', $student->student_number)
    ->orderBy('assessment_date', 'desc')
    ->get();
```

This differed from the student side (`StudentDashboardController::reports()`) which correctly filtered assessments to only show data from currently published materials for graphs.

## Solution
Modified the `TeacherController::view()` method to match the behavior in `StudentDashboardController::reports()`:

### 1. Controller Changes (`app/Http/Controllers/TeacherController.php`)

**Added filtering for current published materials:**
```php
// Get currently published reading materials for this student's grade
$currentEnglishMaterial = ReadingMaterial::where('grade_level', $student->grade_level)
    ->where('subject', 'english')
    ->where('is_published', true)
    ->first();

$currentFilipinoMaterial = ReadingMaterial::where('grade_level', $student->grade_level)
    ->where('subject', 'filipino')
    ->where('is_published', true)
    ->first();
```

**Separated graph data from historical data:**
```php
// Get reading assessments for CURRENT published materials only (for graphs)
$currentReadingAssessments = collect();

// Only include assessments from currently published materials
if ($currentEnglishMaterial) {
    $englishAssessment = ReadingAssessment::with('readingMaterial')
        ->where('student_id', $student->student_number)
        ->where('language', 'english')
        ->where('reading_material_id', $currentEnglishMaterial->id)
        ->latest('assessment_date')
        ->first();
    if ($englishAssessment) {
        $currentReadingAssessments->push($englishAssessment);
    }
}

// Get ALL reading assessments for historical data (Reading Results table)
$allReadingAssessments = ReadingAssessment::with('readingMaterial')
    ->where('student_id', $student->student_number)
    ->orderBy('assessment_date', 'desc')
    ->get();

// Pass both collections to the view
$student->readingAssessments = $currentReadingAssessments;  // For graphs
$student->allReadingAssessments = $allReadingAssessments;   // For historical tables
```

### 2. View Changes (`resources/views/teacher/view.blade.php`)

**Updated historical data sections to use `allReadingAssessments`:**
```php
// Total Assessments count
@if(isset($student) && isset($student->allReadingAssessments))
    {{ $student->allReadingAssessments->count() }}
@else
    0
@endif

// Reading Results table
@if(isset($student) && isset($student->allReadingAssessments) && $student->allReadingAssessments->count() > 0)
    @foreach($student->allReadingAssessments->sortByDesc('assessment_date') as $assessment)
```

**Kept graph sections using `readingAssessments` (no changes needed):**
```php
// Graph data and metrics continue to use readingAssessments
@if(isset($student) && $student->readingAssessments->where('language', 'english')->first())
    {{ $student->readingAssessments->where('language', 'english')->first()->reading_speed ?? 0 }}
```

## Result
✅ **Graphs now reset when new reading materials are published** - Only show data from currently published materials
✅ **Historical data is preserved** - Reading Results and Answer Results tables show all historical assessments
✅ **Behavior matches student side** - Consistent functionality between teacher and student views

## Testing
The fix ensures that:
1. When a new reading material is published, the graphs clear (show no data until student takes new assessment)
2. Historical data in Reading Results tables remains intact
3. The behavior matches exactly what happens in the student reports (`stud-reports.blade.php`)

This resolves the issue where teacher graphs were not resetting when admins published new reading materials.
