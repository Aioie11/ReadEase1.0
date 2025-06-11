<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Student;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'userId' => 'required|string|unique:users,userId',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,teacher,student',
            'grade' => 'required_if:role,student|nullable|in:7,8,9,10',
            'section' => 'required_if:role,student|nullable|in:Narra,Dao,Mahugani,Lawaan,Avocado,Guava,Duhat,Mango,Gold,Silver,Zinc,Galileo,Edison,Newton',
            'gender' => 'required_if:role,student|nullable|in:Male,Female,Other',
            'teacherGrade' => 'nullable|in:7,8,9,10',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['must_change_password'] = true; // Force password change on first login

        // Clean up role-specific fields
        if ($validated['role'] === 'student') {
            // For students, remove teacherGrade
            unset($validated['teacherGrade']);
        } elseif ($validated['role'] === 'teacher') {
            // For teachers, remove student-specific fields
            unset($validated['grade']);
            unset($validated['section']);
            unset($validated['gender']);
        } else {
            // For admins, remove all role-specific fields
            unset($validated['grade']);
            unset($validated['section']);
            unset($validated['gender']);
            unset($validated['teacherGrade']);
        }

        $user = User::create($validated);

        // If the user is a student, create a student record
        if ($validated['role'] === 'student') {
            // Parse the name in "LastName, FirstName MiddleName" format
            $nameParts = $this->parseFullName($validated['name']);

            Student::create([
                'student_number' => $validated['userId'],
                'first_name' => $nameParts['firstName'],
                'last_name' => $nameParts['lastName'],
                'middle_name' => $nameParts['middleName'],
                'gender' => $validated['gender'],
                'grade_level' => $validated['grade'],
                'section' => $validated['section']
            ]);
        }

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return response()->json($users);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'userId' => 'required|string|unique:users,userId,' . $user->id,
            'role' => 'required|in:admin,teacher,student',
            'grade' => 'required_if:role,student|nullable|in:7,8,9,10',
            'section' => 'required_if:role,student|nullable|in:Narra,Dao,Mahugani,Lawaan,Avocado,Guava,Duhat,Mango,Gold,Silver,Zinc,Galileo,Edison,Newton',
            'gender' => 'required_if:role,student|nullable|in:Male,Female,Other',
            'teacherGrade' => 'nullable|in:7,8,9,10',
            'password' => 'nullable|string|min:6',
        ]);

        // Handle password update
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        // Clean up role-specific fields
        if ($validated['role'] === 'student') {
            // For students, remove teacherGrade
            unset($validated['teacherGrade']);
        } elseif ($validated['role'] === 'teacher') {
            // For teachers, remove student-specific fields
            unset($validated['grade']);
            unset($validated['section']);
            unset($validated['gender']);
        } else {
            // For admins, remove all role-specific fields
            unset($validated['grade']);
            unset($validated['section']);
            unset($validated['gender']);
            unset($validated['teacherGrade']);
        }

        \Log::info('Updating user', [
            'user_id' => $user->id,
            'old_data' => $user->toArray(),
            'new_data' => $validated
        ]);

        $updated = $user->update($validated);

        \Log::info('User update result', [
            'user_id' => $user->id,
            'update_success' => $updated,
            'updated_data' => $user->fresh()->toArray()
        ]);

        // If the user is a student, update or create the student record
        if ($validated['role'] === 'student') {
            // Parse the name in "LastName, FirstName MiddleName" format
            $nameParts = $this->parseFullName($validated['name']);

            // Try multiple strategies to find existing student record
            $student = null;

            // Strategy 1: Find by original userId (most important for updates)
            if ($user->userId) {
                $student = Student::where('student_number', $user->userId)->first();
            }

            // Strategy 2: If not found and userId has changed, try with the new userId
            if (!$student && $user->userId !== $validated['userId']) {
                $student = Student::where('student_number', $validated['userId'])->first();
            }

            // Strategy 3: If still not found, try to find by name match (to catch existing records)
            if (!$student) {
                $student = Student::where('first_name', $nameParts['firstName'])
                    ->where('last_name', $nameParts['lastName'])
                    ->where('grade_level', $validated['grade'])
                    ->where('section', $validated['section'])
                    ->first();
            }

            if ($student) {
                // Update existing student record
                \Log::info('Updating existing student record', [
                    'student_id' => $student->id,
                    'old_student_number' => $student->student_number,
                    'new_student_number' => $validated['userId']
                ]);

                $student->update([
                    'student_number' => $validated['userId'], // Update student number if it changed
                    'first_name' => $nameParts['firstName'],
                    'last_name' => $nameParts['lastName'],
                    'middle_name' => $nameParts['middleName'],
                    'gender' => $validated['gender'],
                    'grade_level' => $validated['grade'],
                    'section' => $validated['section']
                ]);
            } else {
                // Create new student record if it doesn't exist
                \Log::info('Creating new student record', [
                    'student_number' => $validated['userId'],
                    'name' => $nameParts['firstName'] . ' ' . $nameParts['lastName']
                ]);

                Student::create([
                    'student_number' => $validated['userId'],
                    'first_name' => $nameParts['firstName'],
                    'last_name' => $nameParts['lastName'],
                    'middle_name' => $nameParts['middleName'],
                    'gender' => $validated['gender'],
                    'grade_level' => $validated['grade'],
                    'section' => $validated['section']
                ]);
            }
        } else {
            // If role changed from student to something else, remove the student record
            if ($user->role === 'student' && $validated['role'] !== 'student') {
                Student::where('student_number', $user->userId)->delete();
            }
        }

        // Refresh the user data to get the latest values
        $user->refresh();

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // If the user is a student, delete the associated student record
            if ($user->role === 'student') {
                Student::where('student_number', $user->userId)->delete();
            }
            
            $user->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Parse full name in "LastName, FirstName MiddleName" format
     *
     * @param string $fullName
     * @return array
     */
    private function parseFullName($fullName)
    {
        // Default values
        $firstName = '';
        $lastName = '';
        $middleName = null;

        // Check if name contains comma (LastName, FirstName MiddleName format)
        if (strpos($fullName, ',') !== false) {
            $parts = explode(',', $fullName, 2);
            $lastName = trim($parts[0]);

            if (isset($parts[1])) {
                $firstAndMiddle = trim($parts[1]);
                $nameTokens = explode(' ', $firstAndMiddle);
                $firstName = array_shift($nameTokens);

                if (!empty($nameTokens)) {
                    $middleName = implode(' ', $nameTokens);
                    // Remove trailing period if present
                    $middleName = rtrim($middleName, '.');
                }
            }
        } else {
            // Fallback: assume "FirstName MiddleName LastName" format
            $nameParts = explode(' ', $fullName);
            if (count($nameParts) >= 2) {
                $firstName = array_shift($nameParts);
                $lastName = array_pop($nameParts);
                if (!empty($nameParts)) {
                    $middleName = implode(' ', $nameParts);
                }
            } else {
                $firstName = $fullName;
            }
        }

        return [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'middleName' => $middleName
        ];
    }
}
