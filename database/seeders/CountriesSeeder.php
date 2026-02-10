<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CountriesSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $countries = [
            ['name' => 'Turkey', 'code' => 'TR'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'Italy', 'code' => 'IT'],
            ['name' => 'Spain', 'code' => 'ES'],
            ['name' => 'Netherlands', 'code' => 'NL'],
            ['name' => 'Belgium', 'code' => 'BE'],
            ['name' => 'Switzerland', 'code' => 'CH'],
            ['name' => 'Austria', 'code' => 'AT'],
            ['name' => 'Sweden', 'code' => 'SE'],
            ['name' => 'Norway', 'code' => 'NO'],
            ['name' => 'Denmark', 'code' => 'DK'],
            ['name' => 'Finland', 'code' => 'FI'],
            ['name' => 'Poland', 'code' => 'PL'],
            ['name' => 'Czech Republic', 'code' => 'CZ'],
            ['name' => 'Portugal', 'code' => 'PT'],
            ['name' => 'Greece', 'code' => 'GR'],
            ['name' => 'Hungary', 'code' => 'HU'],
            ['name' => 'Romania', 'code' => 'RO'],
            ['name' => 'Bulgaria', 'code' => 'BG'],
            ['name' => 'Serbia', 'code' => 'RS'],
            ['name' => 'Croatia', 'code' => 'HR'],
            ['name' => 'Bosnia and Herzegovina', 'code' => 'BA'],
            ['name' => 'Albania', 'code' => 'AL'],
            ['name' => 'North Macedonia', 'code' => 'MK'],
            ['name' => 'Montenegro', 'code' => 'ME'],
            ['name' => 'Russia', 'code' => 'RU'],
            ['name' => 'Ukraine', 'code' => 'UA'],
            ['name' => 'Georgia', 'code' => 'GE'],
            ['name' => 'Azerbaijan', 'code' => 'AZ'],
            ['name' => 'Armenia', 'code' => 'AM'],
            ['name' => 'Iran', 'code' => 'IR'],
            ['name' => 'Iraq', 'code' => 'IQ'],
            ['name' => 'Saudi Arabia', 'code' => 'SA'],
            ['name' => 'United Arab Emirates', 'code' => 'AE'],
            ['name' => 'Qatar', 'code' => 'QA'],
            ['name' => 'Kuwait', 'code' => 'KW'],
            ['name' => 'Israel', 'code' => 'IL'],
            ['name' => 'Jordan', 'code' => 'JO'],
            ['name' => 'Lebanon', 'code' => 'LB'],
            ['name' => 'Egypt', 'code' => 'EG'],
            ['name' => 'Morocco', 'code' => 'MA'],
            ['name' => 'Tunisia', 'code' => 'TN'],
            ['name' => 'Algeria', 'code' => 'DZ'],
            ['name' => 'Libya', 'code' => 'LY'],
            ['name' => 'South Africa', 'code' => 'ZA'],
            ['name' => 'Nigeria', 'code' => 'NG'],
            ['name' => 'Kenya', 'code' => 'KE'],
            ['name' => 'Ethiopia', 'code' => 'ET'],
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'Japan', 'code' => 'JP'],
            ['name' => 'South Korea', 'code' => 'KR'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Pakistan', 'code' => 'PK'],
            ['name' => 'Indonesia', 'code' => 'ID'],
            ['name' => 'Malaysia', 'code' => 'MY'],
            ['name' => 'Thailand', 'code' => 'TH'],
            ['name' => 'Vietnam', 'code' => 'VN'],
            ['name' => 'Philippines', 'code' => 'PH'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'New Zealand', 'code' => 'NZ'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'Mexico', 'code' => 'MX'],
            ['name' => 'Brazil', 'code' => 'BR'],
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'Chile', 'code' => 'CL'],
            ['name' => 'Colombia', 'code' => 'CO'],
            ['name' => 'Peru', 'code' => 'PE'],
            ['name' => 'Venezuela', 'code' => 'VE'],
        ];

        DB::table('countries')->insert(
            collect($countries)->map(fn ($c) => [
                'name' => $c['name'],
                'locale' => $c['code'],
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ])->toArray()
        );
    }
}
