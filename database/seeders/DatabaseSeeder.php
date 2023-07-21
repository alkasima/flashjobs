<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  \App\Models\User::factory(5)->create();

       $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@gmail.com'
       ]);

         Listing::factory(6)->create(
            [
                'user_id' => $user->id
            ]
         );
        //  Listing::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Boston, MA',
        //     'email' => 'email@email.com',
        //         'website' => 'https://www.acme.com',
        //         'description' => 'Lorem ipsum dolor sit amet
        //         consectetur adipicing elit. Ipsam minima et
        //         illo reprehenderit quas possium voluptas
        //         repudiande cum expedita, eveniet aliquid, quotemeta
        //         illum quaerat consequatr.'
        //  ]);

        //  Listing::create(
        //     [
        //         'title' => 'Full-Stack Engineer',
        //         'tags' => 'laravel, backend, api',
        //         'company' => 'Stark Industries',
        //         'location' => 'New York, NY',
        //         'email' => 'email@email.com',
        //         'website' => 'https://www.starkindustries.com',
        //         'description' => 'Lorem ipsum dolor sit amet
        //         consectetur adipicing elit. Ipsam minima et
        //         illo reprehenderit quas possium voluptas
        //         repudiande cum expedita, eveniet aliquid, quotemeta
        //         illum delensiti.'
        //     ]
        //  );
    }
}
