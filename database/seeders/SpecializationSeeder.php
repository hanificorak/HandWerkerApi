<?php

namespace Database\Seeders;

use App\Models\specialization;
use App\Models\SpecializationTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            [
                'slug' => 'electrician',
                'translations' => [
                    'tr' => 'Elektrikçi',
                    'en' => 'Electrician',
                    'de' => 'Elektriker',
                ],
            ],
            [
                'slug' => 'plumber',
                'translations' => [
                    'tr' => 'Tesisatçı',
                    'en' => 'Plumber',
                    'de' => 'Installateur',
                ],
            ],
            [
                'slug' => 'painter',
                'translations' => [
                    'tr' => 'Boya Ustası',
                    'en' => 'Painter',
                    'de' => 'Maler',
                ],
            ],
            [
                'slug' => 'carpenter',
                'translations' => [
                    'tr' => 'Marangoz',
                    'en' => 'Carpenter',
                    'de' => 'Tischler',
                ],
            ],
            [
                'slug' => 'locksmith',
                'translations' => [
                    'tr' => 'Çilingir',
                    'en' => 'Locksmith',
                    'de' => 'Schlüsseldienst',
                ],
            ],
            [
                'slug' => 'hvac-technician',
                'translations' => [
                    'tr' => 'Kombi & Klima Servisi',
                    'en' => 'HVAC Technician',
                    'de' => 'Heizungs- und Klimatechniker',
                ],
            ],
            [
                'slug' => 'appliance-repair',
                'translations' => [
                    'tr' => 'Beyaz Eşya Servisi',
                    'en' => 'Appliance Repair',
                    'de' => 'Hausgeräte-Reparatur',
                ],
            ],
            [
                'slug' => 'tiler',
                'translations' => [
                    'tr' => 'Fayans Ustası',
                    'en' => 'Tiler',
                    'de' => 'Fliesenleger',
                ],
            ],
            [
                'slug' => 'roofer',
                'translations' => [
                    'tr' => 'Çatı Ustası',
                    'en' => 'Roofer',
                    'de' => 'Dachdecker',
                ],
            ],
            [
                'slug' => 'handyman',
                'translations' => [
                    'tr' => 'Genel Tamirci',
                    'en' => 'Handyman',
                    'de' => 'Hausmeister',
                ],
            ],
        ];

        foreach ($specializations as $item) {
            $specialization = specialization::create([
                'slug' => $item['slug'],
                'is_active' => true,
            ]);

            foreach ($item['translations'] as $locale => $title) {
                SpecializationTranslation::create([
                    'specialization_id' => $specialization->id,
                    'locale' => $locale,
                    'title' => $title,
                ]);
            }
        }
    }
}
