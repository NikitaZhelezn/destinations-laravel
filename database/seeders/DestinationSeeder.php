<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;
use SQLite3;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $db_file_path = base_path('storage/app/public/destinations.sqlite');
        if(!file_exists($db_file_path) || !is_readable($db_file_path)) {
            return;
        }

        $db = new SQLite3($db_file_path);
        $result = $db->query("SELECT * FROM destinations");

        while($row = $result->fetchArray()) {
            if (Destination::where('name', $row['name'])->exists()) {
                continue;
            }

            if (empty($row['lat']) || empty($row['lon'])) {
                continue;
            }

            Destination::create([
                'name' => $row['name'],
                'lat' => $row['lat'],
                'lon' => $row['lon'],
            ]);
        }
    }
}
