<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\ActivityLog;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password_hash'] = Hash::make($data['password']);
        unset($data['password'], $data['password_confirmation']);

        $user = User::create($data);
        session(['user_id' => $user->id]);

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'user_registered',
            'description' => "New user: {$user->name} ({$user->email}) as {$user->role}",
            'ip_address' => $request->ip(),
        ]);

        return $this->success(['user_id' => $user->id], 'Registration successful', 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->where('is_active', 1)->first();

        if (!$user || !Hash::check($request->password, $user->password_hash)) {
            return $this->error('Invalid email or password', 401);
        }

        session(['user_id' => $user->id]);
        $user->update(['last_login' => now()]);

        return $this->success([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ], 'Login successful');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return $this->success(null, 'Logged out');
    }

    public function me()
    {
        $user = User::with('university')->find(session('user_id'));
        if (!$user) {
            return $this->error('Not authenticated', 401);
        }
        return $this->success($user);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(session('user_id'));
        if (!$user) {
            return $this->error('Not authenticated', 401);
        }

        $fields = [
            'name', 'department', 'education_level', 'cgpa',
            'fields_of_interest', 'bio', 'research_experience_years',
            'university_id', 'country_id',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $user->$field = $request->$field;
            }
        }

        $user->save();
        return $this->success(null, 'Profile updated');
    }
}