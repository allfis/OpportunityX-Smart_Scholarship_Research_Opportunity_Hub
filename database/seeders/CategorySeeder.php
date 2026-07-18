<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name'=>'Computer Science & IT','slug'=>'computer-science','icon'=>'fa-laptop-code','description'=>'Software engineering, AI, data science, cybersecurity'],
            ['name'=>'Engineering','slug'=>'engineering','icon'=>'fa-gears','description'=>'Electrical, mechanical, civil, and other engineering fields'],
            ['name'=>'Business & Finance','slug'=>'business-finance','icon'=>'fa-chart-pie','description'=>'MBA, accounting, economics, marketing'],
            ['name'=>'Medical & Health Sciences','slug'=>'medical-health','icon'=>'fa-heart-pulse','description'=>'Medicine, public health, pharmacy, nursing'],
            ['name'=>'Natural Sciences','slug'=>'natural-sciences','icon'=>'fa-atom','description'=>'Physics, chemistry, biology, mathematics'],
            ['name'=>'Social Sciences','slug'=>'social-sciences','icon'=>'fa-users','description'=>'Sociology, psychology, political science, anthropology'],
            ['name'=>'Arts & Humanities','slug'=>'arts-humanities','icon'=>'fa-palette','description'=>'Literature, history, philosophy, languages'],
            ['name'=>'Law','slug'=>'law','icon'=>'fa-scale-balanced','description'=>'International law, human rights, corporate law'],
            ['name'=>'Agriculture & Environment','slug'=>'agriculture-environment','icon'=>'fa-leaf','description'=>'Agronomy, environmental science, forestry'],
            ['name'=>'Education','slug'=>'education','icon'=>'fa-chalkboard-user','description'=>'Teaching, educational leadership, curriculum development'],
            ['name'=>'Any Field','slug'=>'any-field','icon'=>'fa-globe','description'=>'Open to all academic disciplines'],
        ];

        foreach ($categories as $c) {
            Category::firstOrCreate(['slug' => $c['slug']], $c);
        }
    }
}