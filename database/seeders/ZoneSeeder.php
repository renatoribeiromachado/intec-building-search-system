<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    const ADMIN_ID = 3;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zones = [
            ['description' => 'NORTE', 'created_by' => self::ADMIN_ID, 'updated_by' => self::ADMIN_ID],
            ['description' => 'NORDESTE', 'created_by' => self::ADMIN_ID, 'updated_by' => self::ADMIN_ID],
            ['description' => 'CENTRO-OESTE', 'created_by' => self::ADMIN_ID, 'updated_by' => self::ADMIN_ID],
            ['description' => 'SUDESTE', 'created_by' => self::ADMIN_ID, 'updated_by' => self::ADMIN_ID],
            ['description' => 'SUL', 'created_by' => self::ADMIN_ID, 'updated_by' => self::ADMIN_ID],
        ];

        $zonesQuantity = count($zones);
        Zone::factory($zonesQuantity)
            ->make()
            ->each(function ($zone, $key) use ($zones) {
                $zoneDescription = $zones[$key]['description'];
                $zoneCreatedBy = $zones[$key]['created_by'];
                $zoneUpdatedBy = $zones[$key]['updated_by'];
                $zone->description = $zoneDescription;
                $zone->created_by = $zoneCreatedBy;
                $zone->updated_by = $zoneUpdatedBy;
                $zone->save();
            });
    }
}
