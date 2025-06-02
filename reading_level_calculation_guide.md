# 📊 Reading Level Calculation Guide
## How Frustration, Instructional, and Independent Levels are Calculated

---

## 🎯 Overview

The ReadEase application calculates reading levels based on **Word Reading Accuracy** using two different calculation methods in different parts of the system.

---

## 🔍 Calculation Locations

### **1. Primary Calculation (ReportsController.php)**
**File**: `app/Http/Controllers/ReportsController.php`
**Lines**: 62-74 and 206-213

### **2. Frontend Calculation (passage.blade.php)**
**File**: `resources/views/teacher/passage.blade.php`
**Lines**: 1156-1157

---

## 📐 Calculation Methods

### **Method 1: Word Recognition Label (ReportsController.php)**

```php
private function getWordRecognitionLabel($miscues, $totalWords)
{
    if ($totalWords === 0)
        return 'N/A';

    $accuracy = (($totalWords - $miscues) / $totalWords) * 100;

    if ($accuracy >= 98)
        return 'Independent';
    if ($accuracy >= 95)
        return 'Instructional';
    return 'Frustration';
}
```

**Thresholds:**
- **Independent**: ≥ 98% accuracy
- **Instructional**: 95% - 97% accuracy  
- **Frustration**: < 95% accuracy

### **Method 2: Grade Level Data (ReportsController.php)**

```php
// Group by reading levels
$readingLevels = $assessments->groupBy(function ($assessment) {
    $accuracy = $assessment->correct_reading;
    if ($accuracy >= 97)
        return 'Independent';
    if ($accuracy >= 90)
        return 'Instructional';
    return 'Frustration';
});
```

**Thresholds:**
- **Independent**: ≥ 97% accuracy
- **Instructional**: 90% - 96% accuracy
- **Frustration**: < 90% accuracy

### **Method 3: Frontend Calculation (passage.blade.php)**

```javascript
// Calculate correct reading percentage (words read correctly)
const correctReading = totalWords > 0 ? 
    Math.round(((totalWords - miscues) / totalWords) * 100) : 0;
```

**Formula**: `((Total Words - Miscues) / Total Words) × 100`

---

## 🎯 Key Components

### **Input Variables:**
- **Total Words**: Number of words in the reading passage
- **Miscues**: Number of reading errors/mistakes
- **Correct Reading**: Percentage of words read correctly

### **Calculation Formula:**
```
Reading Accuracy = ((Total Words - Miscues) / Total Words) × 100
```

### **Example Calculation:**
- **Total Words**: 150
- **Miscues**: 5
- **Calculation**: ((150 - 5) / 150) × 100 = 96.67%
- **Result**: **Instructional Level** (using Method 2)

---

## 📊 Reading Level Definitions

### **🟢 Independent Level**
- **Accuracy**: 97-100% (Method 2) or 98-100% (Method 1)
- **Description**: Student reads fluently without assistance
- **Characteristics**: 
  - Minimal reading errors
  - Strong word recognition
  - Can read material independently

### **🟡 Instructional Level**
- **Accuracy**: 90-96% (Method 2) or 95-97% (Method 1)
- **Description**: Student can read with teacher support
- **Characteristics**:
  - Some reading errors present
  - Benefits from guided instruction
  - Appropriate for classroom teaching

### **🔴 Frustration Level**
- **Accuracy**: Below 90% (Method 2) or Below 95% (Method 1)
- **Description**: Student struggles with reading material
- **Characteristics**:
  - Many reading errors
  - Material too difficult
  - Needs easier texts or intensive support

---

## 🔄 Data Flow

### **1. Assessment Collection:**
1. Teacher conducts reading assessment
2. Records miscues and total words
3. Frontend calculates accuracy percentage
4. Data sent to backend for storage

### **2. Level Determination:**
1. Backend receives assessment data
2. Applies calculation method based on context
3. Stores reading level in database
4. Displays results in reports

### **3. Report Generation:**
1. System retrieves stored assessments
2. Groups students by reading levels
3. Calculates distribution statistics
4. Displays in dashboard charts

---

## ⚠️ Important Notes

### **Inconsistency Alert:**
The system currently uses **two different threshold sets**:

**Method 1 (Word Recognition):**
- Independent: ≥ 98%
- Instructional: 95-97%
- Frustration: < 95%

**Method 2 (Grade Level Data):**
- Independent: ≥ 97%
- Instructional: 90-96%
- Frustration: < 90%

### **Recommendation:**
Consider standardizing to one set of thresholds for consistency across the application.

---

## 📍 Code Locations Summary

### **Backend Calculations:**
1. **`app/Http/Controllers/ReportsController.php`**
   - Line 67: Word accuracy calculation
   - Lines 69-73: Level determination (Method 1)
   - Lines 207-212: Level determination (Method 2)

### **Frontend Calculations:**
1. **`resources/views/teacher/passage.blade.php`**
   - Line 1157: Correct reading percentage calculation

### **Database Storage:**
1. **`app/Models/ReadingAssessment.php`**
   - Stores: miscues, total_words, correct_reading
   - Used for: Level calculations and reporting

---

## 🎯 Usage in Application

### **Teacher Assessment Page:**
- Calculates accuracy in real-time
- Shows immediate feedback to teacher
- Stores data for future analysis

### **Reports Dashboard:**
- Groups students by reading levels
- Shows distribution charts
- Provides grade-level statistics

### **Student Progress Tracking:**
- Tracks improvement over time
- Identifies students needing support
- Guides instructional decisions

---

## 🔧 Technical Implementation

### **Database Fields:**
- `miscues` (integer): Number of reading errors
- `total_words` (integer): Total words in passage
- `correct_reading` (integer): Percentage of correct reading

### **Calculation Triggers:**
- Real-time during assessment
- Batch processing for reports
- On-demand for dashboard updates

### **Performance Considerations:**
- Calculations are lightweight
- Results cached in database
- Efficient grouping for reports
