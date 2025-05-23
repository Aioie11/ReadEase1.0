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
            'userId' => 'required|string|unique:users,userId',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,teacher,student',
            'grade' => 'required_if:role,student|nullable|in:7,8,9,10',
            'section' => 'required_if:role,student|nullable|in:Narra,Dao,Mahugani,Lawaan,Avocado,Guava,Duhat,Mango,Gold,Silver,Zinc,Galileo,Edison,Newton',
            'gender' => 'required_if:role,student|nullable|in:Male,Female,Other',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        // Only include grade, section, and gender if role is student
        if ($validated['role'] !== 'student') {
            unset($validated['grade']);
            unset($validated['section']);
            unset($validated['gender']);
        }

        $user = User::create($validated);

        // If the user is a student, create a student record
        if ($validated['role'] === 'student') {
            // Split the full name into parts
            $nameParts = explode(' ', $validated['name']);
            $lastName = array_pop($nameParts);
            $firstName = array_shift($nameParts);
            $middleName = implode(' ', $nameParts);

            Student::create([
                'student_number' => $validated['userId'],
                'first_name' => $firstName,
                'last_name' => $lastName,
                'middle_name' => $middleName ?: null,
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
            'userId' => 'required|string|unique:users,userId,' . $user->id,
            'role' => 'required|in:admin,teacher,student',
            'grade' => 'required_if:role,student|nullable|in:7,8,9,10',
            'section' => 'required_if:role,student|nullable|in:Narra,Dao,Mahugani,Lawaan,Avocado,Guava,Duhat,Mango,Gold,Silver,Zinc,Galileo,Edison,Newton',
            'gender' => 'required_if:role,student|nullable|in:Male,Female,Other',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        // Only include grade, section, and gender if role is student
        if ($validated['role'] !== 'student') {
            unset($validated['grade']);
            unset($validated['section']);
            unset($validated['gender']);
        }

        $user->update($validated);

        // If the user is a student, update or create the student record
        if ($validated['role'] === 'student') {
            // Split the full name into parts
            $nameParts = explode(' ', $validated['name']);
            $lastName = array_pop($nameParts);
            $firstName = array_shift($nameParts);
            $middleName = implode(' ', $nameParts);

            // Try to find existing student record
            $student = Student::where('student_number', $validated['userId'])->first();

            if ($student) {
                // Update existing student record
                $student->update([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'middle_name' => $middleName ?: null,
                    'gender' => $validated['gender'],
                    'grade_level' => $validated['grade'],
                    'section' => $validated['section']
                ]);
            } else {
                // Create new student record if it doesn't exist
                Student::create([
                    'student_number' => $validated['userId'],
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'middle_name' => $middleName ?: null,
                    'gender' => $validated['gender'],
                    'grade_level' => $validated['grade'],
                    'section' => $validated['section']
                ]);
            }
        }

        return response()->json(['success' => true, 'user' => $user]);
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
}
