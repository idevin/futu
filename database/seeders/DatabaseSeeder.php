<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\MediaLibrary;
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

        MediaLibrary::firstOrCreate([]);

        $user = User::firstOrCreate(
            ['email' => 'blog@domain'],
            [
                'name' => 'author',
                'password' => Hash::make('4nak1n'),
                'email_verified_at' => now()
            ]
        );

        $user->roles()->sync([$roleAdmin->id]);

        $post = Post::firstOrCreate(
            [
                'title' => 'Hello World',
                'author_id' => $user->id
            ],
            [
                'posted_at' => now(),
                'slug' => Hash::make(now()),
                'content' =>
                    "
                    Welcome to Laravel-blog !<br><br>
                    Don't forget to read the README before starting.<br><br>
                    Feel free to add a star on Laravel-blog on Github !<br><br>
                    You can open an issue or (better) a PR if something went wrong.
                    "
            ]
        );

        Comment::firstOrCreate(
            [
                'author_id' => $user->id,
                'post_id' => $post->id
            ],
            [
                'posted_at' => now(),
                'content' => "Hey ! I'm a comment as example."
            ]
        );

        User::where('api_token', null)->get()->each->update([
            'api_token' => Token::generate()
        ]);
    }
}
