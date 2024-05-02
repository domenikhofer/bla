<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Entry;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        CategoryType::factory()->createMany([
            ['name' => 'Movie/TV Show'],
            ['name' => 'Game'],
            ['name' => 'Book'],
            ['name' => 'Location'],
        ]);

        Category::factory()->createMany([
            ['name' => 'Activities', 'emoji' => null, 'parent_id' => null],
            ['name' => 'Summer', 'emoji' => '☀️', 'parent_id' => 1, 'category_type_id' => 4],
            ['name' => 'Winter', 'emoji' => '❄️', 'parent_id' => 1, 'category_type_id' => 4],
            ['name' => 'Media', 'emoji' => null, 'parent_id' => null],
            ['name' => 'Movies', 'emoji' => '🎬', 'parent_id' => 4, 'category_type_id' => 1],
            ['name' => 'Series', 'emoji' => '📺', 'parent_id' => 4, 'category_type_id' => 1 ],
            ['name' => 'Games', 'emoji' => '🎮', 'parent_id' => 4, 'category_type_id' => 2],
            ['name' => 'Books', 'emoji' => '📘', 'parent_id' => 4, 'category_type_id' => 3],
            ['name' => 'Food', 'emoji' => null, 'parent_id' => null],
            ['name' => 'Restaurants ZH', 'emoji' => '🍽️', 'parent_id' => 9, 'category_type_id' => 4],
            ['name' => 'Restaurants Elsewhere', 'emoji' => '🍜', 'parent_id' => 9, 'category_type_id' => 4],
            ['name' => 'Recipes', 'emoji' => '📄', 'parent_id' => 9],
            ['name' => 'Cooking / Baking Ideas', 'emoji' => '🥐', 'parent_id' => 9],
            ['name' => 'Projects', 'emoji' => null, 'parent_id' => null],
            ['name' => 'General', 'emoji' => '🪚', 'parent_id' => 14],
            ['name' => 'Programming', 'emoji' => '💻', 'parent_id' => 14],
            ['name' => 'Other', 'emoji' => null, 'parent_id' => null],
            ['name' => 'Gift-Ideas', 'emoji' => '🎁', 'parent_id' => 17],
            ['name' => 'Miscellaneous', 'emoji' => '✨', 'parent_id' => 17],

        ]);

        Entry::factory()->createMany([
            ['value' => 'Klima Plexiglass', 'category_id' => 2],
            ['value' => 'Pink Apple', 'category_id' => 2],
            ['value' => 'Velo Keller', 'category_id' => 2],
            ['value' => 'Raffi Theater Tix', 'category_id' => 2],
            ['value' => 'Abdeckplanen', 'category_id' => 2],
            ['value' => 'Kleider Org', 'category_id' => 2],
            ['value' => 'Wäsche', 'category_id' => 2],
            ['value' => 'Creme', 'category_id' => 2],
            ['value' => 'Kitchen utensils', 'category_id' => 2],
            ['value' => 'Bewerbung Garten', 'category_id' => 2],
            ['value' => 'Brille Kratzer', 'category_id' => 2],
            ['value' => 'Baum schneiden', 'category_id' => 2],
            ['value' => 'Pflanzen züchten', 'category_id' => 2],
            ['value' => 'Pflanzen pflanzen', 'category_id' => 2],
            ['value' => 'Saisonabo bäder', 'category_id' => 2],
            ['value' => 'Ausflüge planen', 'category_id' => 2],
            ['value' => 'Pflanzen ricardo', 'category_id' => 2],
            ['value' => 'Sachen Verkaufen/Vergeben', 'category_id' => 2],
            ['value' => 'Job', 'category_id' => 2],
            ['value' => 'Face yoga', 'category_id' => 2],
            ['value' => 'Better List App', 'category_id' => 2],
            ['value' => 'DataAnnotation', 'category_id' => 2],
            ['value' => 'Hide Klima', 'category_id' => 2],
            ['value' => 'Ahv DataAnnotation', 'category_id' => 2],
            ['value' => 'Terasse putzen', 'category_id' => 2],
            ['value' => 'Sofa putzen', 'category_id' => 2],
            ['value' => 'Reduit ausmisten', 'category_id' => 2],
            ['value' => 'Keller ausmisten', 'category_id' => 2],
            ['value' => 'Umtopfen', 'category_id' => 2],
            ['value' => 'Dropbox aufräumen', 'category_id' => 2],
            ['value' => 'Disney Paris', 'category_id' => 2],
            ['value' => 'Monstera umtopfen + Bambusstab', 'category_id' => 2],
            ['value' => 'Produkte aufbrauchen', 'category_id' => 2],
            ['value' => 'ÖV Abo überprüfen', 'category_id' => 2],
            ['value' => 'Luftbefeuchter Keller', 'category_id' => 2],
            ['value' => 'Pflanzen giessen wöchentlich', 'category_id' => 2],
            ['value' => 'Balkon pflanze verschieben', 'category_id' => 2],
            ['value' => 'Pflanzen Balkon', 'category_id' => 2],
            ['value' => 'Stretching routine', 'category_id' => 2],
            ['value' => 'Meditation?', 'category_id' => 2],
            ['value' => 'Folie Rückwand Küche', 'category_id' => 2],
            ['value' => 'Gampel Tickets', 'category_id' => 2],
            ['value' => 'Raiffeisen wechseln', 'category_id' => 2],
            ['value' => 'Checkup / Blutbild', 'category_id' => 2],
            ['value' => 'Badi Abo ZH', 'category_id' => 2]
        ]);

    }
}
