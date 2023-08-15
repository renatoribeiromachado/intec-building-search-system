<?php

namespace Database\Seeders;

use App\Models\Segment;
use Illuminate\Database\Seeder;

class SegmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $segments = [
            ['description' => 'INDUSTRIAL'],
            ['description' => 'COMERCIAL'],
            ['description' => 'RESIDENCIAL'],
        ];

        $segmentsQuantity = count($segments);
        Segment::factory($segmentsQuantity)
            ->make()
            ->each(function ($segment, $key) use ($segments) {
                $segmentDescription = $segments[$key]['description'];
                $segment->description = $segmentDescription;
                $segment->save();
            });
    }
}
