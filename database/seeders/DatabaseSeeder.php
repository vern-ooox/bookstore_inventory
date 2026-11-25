<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Dedicated administrator. Credentials come from .env so the real
        // password is never stored in the code on GitHub.
        $admin = User::create([
            'name' => env('ADMIN_NAME', 'Administrator'),
            'username' => env('ADMIN_USERNAME', 'bookadmin'),
            'email' => env('ADMIN_EMAIL', 'bookadmin@example.com'),
            'password' => env('ADMIN_PASSWORD', 'change-this-password'), // hashed by the User model
        ]);

        // 8 books: all 4 categories, both statuses. user_id is filled by the relationship.
        $admin->books()->createMany([
            [
                'title' => 'The Library at the End of the Road',
                'author' => 'Elena Marquez',
                'category' => 'Fiction',
                'unit_price' => 450.00,
                'description' => 'A quiet novel about a small town library and the stories hidden on its shelves.',
                'availability_status' => 'Available',
            ],
            [
                'title' => 'A Map of Quiet Places',
                'author' => 'Daniel Reyes',
                'category' => 'Fiction',
                'unit_price' => 380.00,
                'description' => 'A traveler collects the quietest corners of the world and learns what silence means.',
                'availability_status' => 'Unavailable',
            ],
            [
                'title' => 'Everyday Budgeting for Beginners',
                'author' => 'Carla Santos',
                'category' => 'Nonfiction',
                'unit_price' => 320.00,
                'description' => 'Simple steps to track spending, set savings goals and build a monthly budget.',
                'availability_status' => 'Available',
            ],
            [
                'title' => 'A Practical Guide to Urban Gardening',
                'author' => 'Miguel Torres',
                'category' => 'Nonfiction',
                'unit_price' => 410.00,
                'description' => 'How to grow vegetables and herbs in small spaces such as balconies and rooftops.',
                'availability_status' => 'Unavailable',
            ],
            [
                'title' => 'Introduction to Web Development',
                'author' => 'Ramon Dela Cruz',
                'category' => 'Academic',
                'unit_price' => 1250.00,
                'description' => 'College textbook covering HTML, CSS, JavaScript and basic server side programming.',
                'availability_status' => 'Available',
            ],
            [
                'title' => 'Fundamentals of Database Design',
                'author' => 'Liza Fernandez',
                'category' => 'Academic',
                'unit_price' => 1180.00,
                'description' => 'Textbook on data modeling, normalization, SQL and relational database design.',
                'availability_status' => 'Unavailable',
            ],
            [
                'title' => 'Mia and the Missing Kite',
                'author' => 'Bea Villanueva',
                'category' => "Children's Books",
                'unit_price' => 250.00,
                'description' => 'Picture book about Mia, who searches the whole neighborhood for her lost kite.',
                'availability_status' => 'Available',
            ],
            [
                'title' => 'Counting Stars with Lolo',
                'author' => 'Tomas Aquino',
                'category' => "Children's Books",
                'unit_price' => 220.00,
                'description' => 'A grandfather and his grandchild count the stars and learn numbers together.',
                'availability_status' => 'Unavailable',
            ],
        ]);
    }
}