<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Role;
use App\Models\Token;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::firstOrCreate(['name' => Role::ROLE_EDITOR]);
        $roleAdmin = Role::firstOrCreate(['name' => Role::ROLE_ADMIN]);

        $user = User::firstOrCreate(
            ['email' => 'root@localhost'],
            [
                'name' => 'Lord Of Bastards',
                'password' => Hash::make('46801346rtgedf!'),
                'email_verified_at' => now()
            ]
        );

        $user->roles()->sync([$roleAdmin->id]);

        User::where('api_token', null)->get()->each->update([
            'api_token' => Token::generate()
        ]);
    }
}
