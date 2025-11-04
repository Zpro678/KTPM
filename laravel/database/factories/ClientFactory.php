<?php

namespace Database\Factories;

use App\Models\client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class clientFactory extends Factory
{
    protected $model = client::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('Admin@1234'), // mật khẩu mặc định để test
            'is_active' => 1, // active sẵn để test đăng nhập
        ];  
    }
}
