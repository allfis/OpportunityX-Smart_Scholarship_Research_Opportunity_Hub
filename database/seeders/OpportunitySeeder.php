<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Category;
use App\Models\Opportunity;
use App\Models\Scholarship;
use App\Models\ResearchGrant;
use App\Models\Internship;
use App\Models\Fellowship;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OpportunitySeeder extends Seeder
{
    public function run(): void
    {
        $faculty = User::firstOrCreate(
            ['email' => 'faculty@opportunityx.com'],
            [
                'name' => 'Dr. Ahmed',
                'password' => bcrypt('password'),
                'role' => 'faculty',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $us = Country::where('code', 'US')->first();
        $de = Country::where('code', 'DE')->first();
        $ca = Country::where('code', 'CA')->first();
        $gb = Country::where('code', 'GB')->first();
        $bd = Country::where('code', 'BD')->first();
        $jp = Country::where('code', 'JP')->first();
        $au = Country::where('code', 'AU')->first();
        $nl = Country::where('code', 'NL')->first();

        $cs = Category::where('slug', 'computer-science')->first();
        $eng = Category::where('slug', 'engineering')->first();
        $any = Category::where('slug', 'any-field')->first();

        $opportunities = [
            [
                'type' => 'scholarship', 'title' => 'DAAD Fully Funded Scholarship 2026', 'country' => $de, 'category' => $any,
                'deadline' => now()->addMonths(3), 'funding_amount' => 18000, 'funding_currency' => 'EUR', 'funding_type' => 'full', 'degree_level' => 'masters',
                'description' => 'DAAD offers fully funded scholarships for international students to pursue masters degrees at German universities. Covers tuition, living expenses, travel, and health insurance.',
                'detail' => ['scholarship_type' => 'merit', 'min_cgpa' => 3.50, 'gpa_scale' => 4.0, 'required_departments' => null, 'covers_tuition' => true, 'covers_living' => true, 'covers_travel' => true, 'covers_insurance' => true, 'additional_benefits' => 'German language course, mentoring program'],
                'eligibility' => ['min_cgpa' => 3.50, 'degree' => 'masters', 'language' => 'English/German'],
                'featured' => true,
            ],
            [
                'type' => 'scholarship', 'title' => 'Fulbright Foreign Student Program', 'country' => $us, 'category' => $any,
                'deadline' => now()->addMonths(2), 'funding_amount' => 50000, 'funding_currency' => 'USD', 'funding_type' => 'full', 'degree_level' => 'phd',
                'description' => 'The Fulbright Program provides fully funded opportunities for graduate study, research, and teaching in the United States.',
                'detail' => ['scholarship_type' => 'research', 'min_cgpa' => 3.75, 'gpa_scale' => 4.0, 'required_departments' => null, 'covers_tuition' => true, 'covers_living' => true, 'covers_travel' => true, 'covers_insurance' => true, 'additional_benefits' => 'Cultural enrichment activities'],
                'eligibility' => ['min_cgpa' => 3.75, 'degree' => 'phd'],
                'featured' => true,
            ],
            [
                'type' => 'scholarship', 'title' => 'Vanier Canada Graduate Scholarship', 'country' => $ca, 'category' => $any,
                'deadline' => now()->addMonths(5), 'funding_amount' => 50000, 'funding_currency' => 'CAD', 'funding_type' => 'full', 'degree_level' => 'phd',
                'description' => 'Vanier CGS program attracts world-class doctoral students who demonstrate leadership skills and scholarly achievement.',
                'detail' => ['scholarship_type' => 'research', 'min_cgpa' => 3.80, 'gpa_scale' => 4.0, 'required_departments' => null, 'covers_tuition' => true, 'covers_living' => true, 'covers_travel' => false, 'covers_insurance' => true, 'additional_benefits' => 'Research support fund'],
                'eligibility' => ['min_cgpa' => 3.80, 'degree' => 'phd'],
                'featured' => false,
            ],
            [
                'type' => 'scholarship', 'title' => 'Chevening Scholarship Bangladesh', 'country' => $gb, 'category' => $any,
                'deadline' => now()->addDays(20), 'funding_amount' => 35000, 'funding_currency' => 'GBP', 'funding_type' => 'full', 'degree_level' => 'masters',
                'description' => 'Chevening Scholarships enable outstanding emerging leaders from Bangladesh to pursue a one-year masters at any UK university.',
                'detail' => ['scholarship_type' => 'merit', 'min_cgpa' => 3.50, 'gpa_scale' => 4.0, 'required_departments' => null, 'covers_tuition' => true, 'covers_living' => true, 'covers_travel' => true, 'covers_insurance' => true, 'additional_benefits' => 'Networking events, leadership program'],
                'eligibility' => ['min_cgpa' => 3.50, 'degree' => 'masters', 'country' => 'Bangladesh'],
                'featured' => true,
            ],
            [
                'type' => 'research_grant', 'title' => 'Undergraduate AI Research Grant', 'country' => $us, 'category' => $cs,
                'deadline' => now()->addMonths(4), 'funding_amount' => 5000, 'funding_currency' => 'USD', 'funding_type' => 'partial', 'degree_level' => 'undergraduate',
                'description' => 'Support for undergraduate students conducting research in artificial intelligence, machine learning, and data science.',
                'detail' => ['research_area' => 'Artificial Intelligence', 'grant_type' => 'individual', 'max_funding' => 5000, 'min_duration_months' => 3, 'max_duration_months' => 12, 'requires_proposal' => true, 'requires_supervisor' => true],
                'eligibility' => ['min_cgpa' => 3.50, 'degree' => 'undergraduate'],
                'featured' => false,
            ],
            [
                'type' => 'research_grant', 'title' => 'PhD Renewable Energy Research Fund', 'country' => $de, 'category' => $eng,
                'deadline' => now()->addMonths(6), 'funding_amount' => 25000, 'funding_currency' => 'EUR', 'funding_type' => 'full', 'degree_level' => 'phd',
                'description' => 'Funding for PhD research in renewable energy technologies, solar cells, wind energy systems, and energy storage solutions.',
                'detail' => ['research_area' => 'Renewable Energy', 'grant_type' => 'project', 'max_funding' => 25000, 'min_duration_months' => 12, 'max_duration_months' => 36, 'requires_proposal' => true, 'requires_supervisor' => true],
                'eligibility' => ['min_cgpa' => 3.70, 'degree' => 'phd'],
                'featured' => true,
            ],
            [
                'type' => 'internship', 'title' => 'Google Software Engineering Intern', 'country' => $us, 'category' => $cs,
                'deadline' => now()->addDays(45), 'funding_amount' => 9000, 'funding_currency' => 'USD', 'funding_type' => 'full', 'degree_level' => 'any',
                'description' => 'Join Google as a Software Engineering Intern. Work on real products used by billions of people. 12-14 week program.',
                'detail' => ['company_name' => 'Google', 'is_paid' => true, 'stipend_amount' => 9000, 'stipend_currency' => 'USD', 'duration_months' => 3, 'remote_allowed' => true, 'location' => 'Mountain View, CA / Remote', 'required_skills' => ['Python', 'Java', 'C++', 'Data Structures', 'Algorithms']],
                'eligibility' => ['skills' => ['programming']],
                'featured' => true,
            ],
            [
                'type' => 'internship', 'title' => 'Microsoft Explore Internship', 'country' => $us, 'category' => $cs,
                'deadline' => now()->addMonths(2), 'funding_amount' => 8000, 'funding_currency' => 'USD', 'funding_type' => 'full', 'degree_level' => 'undergraduate',
                'description' => 'Microsoft Explore Program is a 12-week summer internship designed for first and second-year students.',
                'detail' => ['company_name' => 'Microsoft', 'is_paid' => true, 'stipend_amount' => 8000, 'stipend_currency' => 'USD', 'duration_months' => 3, 'remote_allowed' => true, 'location' => 'Redmond, WA / Remote', 'required_skills' => ['C++', 'Python', 'Problem Solving']],
                'eligibility' => ['degree' => 'undergraduate', 'year' => '1st or 2nd year'],
                'featured' => false,
            ],
            [
                'type' => 'internship', 'title' => 'Samsung R&D Internship Bangladesh', 'country' => $bd, 'category' => $eng,
                'deadline' => now()->addDays(30), 'funding_amount' => 15000, 'funding_currency' => 'BDT', 'funding_type' => 'partial', 'degree_level' => 'masters',
                'description' => 'Samsung R&D Institute Bangladesh offers internship opportunities for graduate students in electronics and software.',
                'detail' => ['company_name' => 'Samsung R&D Bangladesh', 'is_paid' => true, 'stipend_amount' => 15000, 'stipend_currency' => 'BDT', 'duration_months' => 6, 'remote_allowed' => false, 'location' => 'Dhaka, Bangladesh', 'required_skills' => ['Embedded Systems', 'C/C++', 'Signal Processing']],
                'eligibility' => ['degree' => 'masters'],
                'featured' => false,
            ],
            [
                'type' => 'fellowship', 'title' => 'Erasmus Mundus Joint Master Fellowship', 'country' => $nl, 'category' => $any,
                'deadline' => now()->addMonths(3), 'funding_amount' => 25000, 'funding_currency' => 'EUR', 'funding_type' => 'full', 'degree_level' => 'masters',
                'description' => 'Erasmus Mundus offers fully funded joint master degrees across European universities with scholarship coverage.',
                'detail' => ['fellowship_provider' => 'European Commission', 'duration_months' => 24, 'includes_stipend' => true, 'includes_research_funding' => true, 'includes_mentorship' => true, 'requires_publication' => false],
                'eligibility' => ['min_cgpa' => 3.50, 'degree' => 'masters'],
                'featured' => true,
            ],
            [
                'type' => 'fellowship', 'title' => 'JSPS Research Fellowship Japan', 'country' => $jp, 'category' => $any,
                'deadline' => now()->addMonths(5), 'funding_amount' => 300000, 'funding_currency' => 'JPY', 'funding_type' => 'full', 'degree_level' => 'postdoc',
                'description' => 'Japan Society for the Promotion of Science offers fellowships for postdoctoral researchers to conduct research in Japan.',
                'detail' => ['fellowship_provider' => 'JSPS', 'duration_months' => 12, 'includes_stipend' => true, 'includes_research_funding' => true, 'includes_mentorship' => true, 'requires_publication' => true],
                'eligibility' => ['degree' => 'postdoc'],
                'featured' => false,
            ],
            [
                'type' => 'competition', 'title' => 'Google Summer of Code 2026', 'country' => $us, 'category' => $cs,
                'deadline' => now()->addDays(60), 'funding_amount' => 3000, 'funding_currency' => 'USD', 'funding_type' => 'partial', 'degree_level' => 'any',
                'description' => 'Google Summer of Code is a global program focused on bringing more student developers into open source software development.',
                'detail' => ['competition_type' => 'project', 'team_size_min' => 1, 'team_size_max' => 1, 'prizes' => ['Certificate', 'Stipend $3000-$6600', 'Mentorship'], 'rounds' => 2, 'requires_registration_fee' => false, 'registration_fee_amount' => null],
                'eligibility' => ['skills' => ['programming', 'git']],
                'featured' => true,
            ],
            [
                'type' => 'competition', 'title' => 'ICPC Asia Regional Preliminary', 'country' => $bd, 'category' => $cs,
                'deadline' => now()->addMonths(1), 'funding_amount' => 0, 'funding_currency' => 'USD', 'funding_type' => 'none', 'degree_level' => 'undergraduate',
                'description' => 'International Collegiate Programming Contest Asia Regional Preliminary. Teams of 3 solve algorithmic problems.',
                'detail' => ['competition_type' => 'other', 'team_size_min' => 3, 'team_size_max' => 3, 'prizes' => ['Advancement to Regional', 'Medals', 'Recognition'], 'rounds' => 2, 'requires_registration_fee' => false, 'registration_fee_amount' => null],
                'eligibility' => ['degree' => 'undergraduate'],
                'featured' => false,
            ],
            [
                'type' => 'scholarship', 'title' => 'MEXT Scholarship Japan', 'country' => $jp, 'category' => $any,
                'deadline' => now()->addMonths(4), 'funding_amount' => 145000, 'funding_currency' => 'JPY', 'funding_type' => 'full', 'degree_level' => 'any',
                'description' => 'Japanese Government (MEXT) Scholarship for international students to study at Japanese universities. Fully covers tuition, living, and travel.',
                'detail' => ['scholarship_type' => 'merit', 'min_cgpa' => 3.50, 'gpa_scale' => 4.0, 'required_departments' => null, 'covers_tuition' => true, 'covers_living' => true, 'covers_travel' => true, 'covers_insurance' => true, 'additional_benefits' => 'Japanese language training, cultural activities'],
                'eligibility' => ['min_cgpa' => 3.50],
                'featured' => true,
            ],
            [
                'type' => 'research_grant', 'title' => 'BUET Undergraduate Research Fund', 'country' => $bd, 'category' => $eng,
                'deadline' => now()->addDays(15), 'funding_amount' => 50000, 'funding_currency' => 'BDT', 'funding_type' => 'partial', 'degree_level' => 'undergraduate',
                'description' => 'BUET Internal Research Fund supports undergraduate students conducting research projects under faculty supervision.',
                'detail' => ['research_area' => 'Engineering', 'grant_type' => 'individual', 'max_funding' => 50000, 'min_duration_months' => 3, 'max_duration_months' => 6, 'requires_proposal' => true, 'requires_supervisor' => true],
                'eligibility' => ['min_cgpa' => 3.30, 'degree' => 'undergraduate', 'university' => 'BUET'],
                'featured' => false,
            ],
            [
                'type' => 'fellowship', 'title' => 'Australia Awards Scholarship', 'country' => $au, 'category' => $any,
                'deadline' => now()->addMonths(3), 'funding_amount' => 40000, 'funding_currency' => 'AUD', 'funding_type' => 'full', 'degree_level' => 'masters',
                'description' => 'Australia Awards Scholarships are long-term awards for students from developing countries.',
                'detail' => ['fellowship_provider' => 'Australian Government', 'duration_months' => 24, 'includes_stipend' => true, 'includes_research_funding' => false, 'includes_mentorship' => true, 'requires_publication' => false],
                'eligibility' => ['min_cgpa' => 3.40, 'degree' => 'masters'],
                'featured' => false,
            ],
        ];

        foreach ($opportunities as $data) {
            // Use title as key — model's booted() will auto-generate slug
            $opp = Opportunity::firstOrCreate(
                ['title' => $data['title']],
                [
                    'slug' => Str::slug($data['title']) . '-' . Str::random(4),
                    'description' => $data['description'],
                    'category_id' => $data['category']?->id,
                    'country_id' => $data['country']?->id,
                    'posted_by' => $faculty->id,
                    'type' => $data['type'],
                    'status' => 'active',
                    'deadline' => $data['deadline'],
                    'funding_amount' => $data['funding_amount'],
                    'funding_currency' => $data['funding_currency'],
                    'funding_type' => $data['funding_type'],
                    'degree_level' => $data['degree_level'],
                    'eligibility_criteria' => $data['eligibility'] ?? null,
                    'is_featured' => $data['featured'] ?? false,
                ]
            );

            // Only create detail if it doesn't exist
            $detail = $data['detail'];
            switch ($data['type']) {
                case 'scholarship':
                    Scholarship::firstOrCreate(['opportunity_id' => $opp->id], $detail);
                    break;
                case 'research_grant':
                    ResearchGrant::firstOrCreate(['opportunity_id' => $opp->id], $detail);
                    break;
                case 'internship':
                    Internship::firstOrCreate(['opportunity_id' => $opp->id], $detail);
                    break;
                case 'fellowship':
                    Fellowship::firstOrCreate(['opportunity_id' => $opp->id], $detail);
                    break;
                case 'competition':
                    Competition::firstOrCreate(['opportunity_id' => $opp->id], $detail);
                    break;
            }
        }
    }
}