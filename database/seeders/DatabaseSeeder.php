<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin: email/password .env se aayenge (code me nahi likhte)
        $email    = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (!$email || !$password) {
            $this->command->error('Set ADMIN_EMAIL and ADMIN_PASSWORD in .env first.');
            return;
        }

        $admin = User::firstOrNew(['email' => $email]);
        $admin->name     = 'Admin';
        $admin->password = Hash::make($password);
        $admin->role     = 'admin';   // fillable me nahi, direct set
        $admin->save();

        // Categories
        $haircut = Category::updateOrCreate(['name' => 'Haircut'], ['description' => 'Classic and modern haircuts']);
        $beard   = Category::updateOrCreate(['name' => 'Beard'],   ['description' => 'Beard styling and shaving']);
        $combo   = Category::updateOrCreate(['name' => 'Combo'],   ['description' => 'Hair and beard packages']);

        // Services: [category, name, price, minutes]  <-- apni asli prices likhein
        $services = [
            [$haircut, 'Classic Haircut',     50,  30],
            [$haircut, 'Fade Haircut',        60,  40],
            [$haircut, 'Kids Haircut',        35,  25],
            [$beard,   'Beard Styling',       40,  25],
            [$beard,   'Hot Towel Shave',     45,  30],
            [$beard,   'Beard Trim',          30,  20],
            [$combo,   'Hair & Beard Combo',  80,  60],
            [$combo,   'Premium Grooming',   120,  90],
        ];

        $created = [];
        foreach ($services as [$cat, $name, $price, $mins]) {
            $created[] = Service::updateOrCreate(
                ['name' => $name],
                [
                    'category_id'      => $cat->id,
                    'description'      => $name . ' at Golden Blade',
                    'price'            => $price,
                    'duration_minutes' => $mins,
                ]
            );
        }

        // Staff: apne asli barbers likhein
        $staff = [
            Staff::updateOrCreate(['email' => 'ali@goldenblade.test'],    ['name' => 'Ali Khan',     'phone' => '55110001']),
            Staff::updateOrCreate(['email' => 'rizwan@goldenblade.test'], ['name' => 'Rizwan Ahmed', 'phone' => '55110002']),
            Staff::updateOrCreate(['email' => 'hassan@goldenblade.test'], ['name' => 'Hassan Raza',  'phone' => '55110003']),
            Staff::updateOrCreate(['email' => 'sami@goldenblade.test'],   ['name' => 'Sami Ullah',   'phone' => '55110004']),
        ];

        // Staff-service assignment (duplicate nahi banega)
        foreach ($created as $i => $service) {
            $service->staff()->syncWithoutDetaching([
                $staff[$i % 4]->id,
                $staff[($i + 1) % 4]->id,
            ]);
        }
    }
}