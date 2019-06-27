<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->userTesting();
        $users = factory(App\User::class, 20)->create();
        $members = factory(App\Models\Member::class, 200)->create();
        $categorys = factory(App\Models\BookCategory::class, 500)->create();
        $faker = new Faker;
        $faker->addProvider(new \Faker\Provider\Lorem($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new \Faker\Provider\DateTime($faker));
        $this->createBook($faker, $categorys, $members);
    }
    private function createBook($faker, $categorys, $members){
        for ($i = 0; $i < 2000; $i++) {
            $category = $categorys->random();
            $book = Book::create([
                'name' => $faker->sentence,
                'author' => $faker->name,
                'published_date' => $faker->dateTime,
                'book_category_id' => $category->id
            ]);
            if (rand(1, 100) > 70) {
                $member = $members->random();
                $book->borrowing()->create([
                    'member_id' => $member->id
                ]);
            }
        }
    }
    private function userTesting(){
        User::create([
            'name' => 'TESTING',
            'email' => 'lambetdelta@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'), // password
            'remember_token' => Str::random(10),
            'active' => 1
        ]);
    }
}
