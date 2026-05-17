<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService{
    public function register(array $data): array
    {
        $user  = User::create([
            'name' => $data['name'],	
            'email' => $data['email'],	
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function login(array $data): array
    {
        if(!Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ])){
            throw new UnauthorizedHttpException('', 'Invalid email & password');
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return [
            'token' => $token,
            'user' => $user
        ];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }
}