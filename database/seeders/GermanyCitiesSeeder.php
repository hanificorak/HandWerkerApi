<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GermanyCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Berlin','Hamburg','München','Köln','Frankfurt am Main','Stuttgart','Düsseldorf','Dortmund',
            'Essen','Leipzig','Bremen','Dresden','Hannover','Nürnberg','Duisburg','Bochum','Wuppertal',
            'Bielefeld','Bonn','Münster','Karlsruhe','Mannheim','Augsburg','Wiesbaden','Gelsenkirchen',
            'Mönchengladbach','Braunschweig','Chemnitz','Kiel','Aachen','Halle (Saale)','Magdeburg',
            'Freiburg im Breisgau','Krefeld','Lübeck','Oberhausen','Erfurt','Mainz','Rostock',
            'Kassel','Hagen','Potsdam','Saarbrücken','Hamm','Ludwigshafen','Oldenburg','Leverkusen',
            'Osnabrück','Solingen','Heidelberg','Herne','Neuss','Darmstadt','Paderborn','Regensburg',
            'Ingolstadt','Würzburg','Ulm','Heilbronn','Pforzheim','Offenbach','Reutlingen',
            'Esslingen','Tübingen','Konstanz','Villingen-Schwenningen','Friedrichshafen'
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'name' => $city,
                'country_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
