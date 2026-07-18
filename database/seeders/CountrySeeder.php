<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name'=>'Bangladesh','code'=>'BD','flag_emoji'=>'🇧🇩'],
            ['name'=>'India','code'=>'IN','flag_emoji'=>'🇮🇳'],
            ['name'=>'Pakistan','code'=>'PK','flag_emoji'=>'🇵🇰'],
            ['name'=>'Sri Lanka','code'=>'LK','flag_emoji'=>'🇱🇰'],
            ['name'=>'Nepal','code'=>'NP','flag_emoji'=>'🇳🇵'],
            ['name'=>'United States','code'=>'US','flag_emoji'=>'🇺🇸'],
            ['name'=>'Canada','code'=>'CA','flag_emoji'=>'🇨🇦'],
            ['name'=>'United Kingdom','code'=>'GB','flag_emoji'=>'🇬🇧'],
            ['name'=>'Germany','code'=>'DE','flag_emoji'=>'🇩🇪'],
            ['name'=>'France','code'=>'FR','flag_emoji'=>'🇫🇷'],
            ['name'=>'Netherlands','code'=>'NL','flag_emoji'=>'🇳🇱'],
            ['name'=>'Sweden','code'=>'SE','flag_emoji'=>'🇸🇪'],
            ['name'=>'Denmark','code'=>'DK','flag_emoji'=>'🇩🇰'],
            ['name'=>'Norway','code'=>'NO','flag_emoji'=>'🇳🇴'],
            ['name'=>'Finland','code'=>'FI','flag_emoji'=>'🇫🇮'],
            ['name'=>'Switzerland','code'=>'CH','flag_emoji'=>'🇨🇭'],
            ['name'=>'Australia','code'=>'AU','flag_emoji'=>'🇦🇺'],
            ['name'=>'New Zealand','code'=>'NZ','flag_emoji'=>'🇳🇿'],
            ['name'=>'Japan','code'=>'JP','flag_emoji'=>'🇯🇵'],
            ['name'=>'South Korea','code'=>'KR','flag_emoji'=>'🇰🇷'],
            ['name'=>'China','code'=>'CN','flag_emoji'=>'🇨🇳'],
            ['name'=>'Singapore','code'=>'SG','flag_emoji'=>'🇸🇬'],
            ['name'=>'Malaysia','code'=>'MY','flag_emoji'=>'🇲🇾'],
            ['name'=>'Turkey','code'=>'TR','flag_emoji'=>'🇹🇷'],
            ['name'=>'Saudi Arabia','code'=>'SA','flag_emoji'=>'🇸🇦'],
            ['name'=>'UAE','code'=>'AE','flag_emoji'=>'🇦🇪'],
            ['name'=>'Egypt','code'=>'EG','flag_emoji'=>'🇪🇬'],
            ['name'=>'South Africa','code'=>'ZA','flag_emoji'=>'🇿🇦'],
            ['name'=>'Brazil','code'=>'BR','flag_emoji'=>'🇧🇷'],
            ['name'=>'Ireland','code'=>'IE','flag_emoji'=>'🇮🇪'],
            ['name'=>'Italy','code'=>'IT','flag_emoji'=>'🇮🇹'],
            ['name'=>'Spain','code'=>'ES','flag_emoji'=>'🇪🇸'],
            ['name'=>'Belgium','code'=>'BE','flag_emoji'=>'🇧🇪'],
            ['name'=>'Austria','code'=>'AT','flag_emoji'=>'🇦🇹'],
            ['name'=>'Poland','code'=>'PL','flag_emoji'=>'🇵🇱'],
            ['name'=>'Thailand','code'=>'TH','flag_emoji'=>'🇹🇭'],
            ['name'=>'Mexico','code'=>'MX','flag_emoji'=>'🇲🇽'],
            ['name'=>'Hungary','code'=>'HU','flag_emoji'=>'🇭🇺'],
            ['name'=>'Czech Republic','code'=>'CZ','flag_emoji'=>'🇨🇿'],
        ];

        foreach ($countries as $c) {
            Country::firstOrCreate(['code' => $c['code']], $c);
        }
    }
}