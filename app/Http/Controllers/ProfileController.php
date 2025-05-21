<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            'section' => 'required_if:role,student|nullable|in:Narra,Dao,Lawaan,Mahugani,Molave,Talisay,Yakal,Kamagong,Acacia,Mahogany',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        // Only include grade and section if role is student
        if ($validated['role'] !== 'student') {
            unset($validated['grade']);
            unset($validated['section']);
        }

        $user = User::create($validated);
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
            'section' => 'required_if:role,student|nullable|in:Narra,Dao,Lawaan,Mahugani,Molave,Talisay,Yakal,Kamagong,Acacia,Mahogany',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        // Only include grade and section if role is student
        if ($validated['role'] !== 'student') {
            unset($validated['grade']);
            unset($validated['section']);
        }

        $user->update($validated);
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
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
