<?php

namespace Database\Seeders;

use App\Models\SegmentSubType;
use Illuminate\Database\Seeder;

class SegmentSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $segmentSubTypes = [
            ['segment_id' => 1, 'description' => 'AGRO-INDUSTRIAL'],
            ['segment_id' => 1, 'description' => 'ENERGIA E TELECOMUNICAÇÃO'],
            ['segment_id' => 1, 'description' => 'MATERIAIS DE CONSTRUÇÃO'],
            ['segment_id' => 1, 'description' => 'SANEAMENTO BASICO/ SISTEMAS ANTI-POLUIÇÃO'],
            ['segment_id' => 1, 'description' => 'ALIMENTOS E BEBIDAS'],
            ['segment_id' => 1, 'description' => 'FERROSOS E NÃO FERROSOS'],
            ['segment_id' => 1, 'description' => 'MECÂNICA E ELÉTRICA'],
            ['segment_id' => 1, 'description' => 'CONSUMO'],
            ['segment_id' => 1, 'description' => 'GALPÕES INDUSTRIAIS'],
            ['segment_id' => 1, 'description' => 'PETRÓLEO E AFINS'],

            ['segment_id' => 2, 'description' => 'COMUNITÁRIAS'],
            ['segment_id' => 2, 'description' => 'GALPÕES COMERCIAIS'],
            ['segment_id' => 2, 'description' => 'JUSTIÇA'],
            ['segment_id' => 2, 'description' => 'TERMINAIS'],
            ['segment_id' => 2, 'description' => 'VIÁRIAS'],
            ['segment_id' => 2, 'description' => 'CULTURAL'],
            ['segment_id' => 2, 'description' => 'GRANDE COMÉRCIO'],
            ['segment_id' => 2, 'description' => 'LOTEAMENTOS'],
            ['segment_id' => 2, 'description' => 'TRANSPORTE AÉREO'],
            ['segment_id' => 2, 'description' => 'EMPREENDIMENTOS COMERCIAIS E MISTOS'],
            ['segment_id' => 2, 'description' => 'HÍDRICAS'],
            ['segment_id' => 2, 'description' => 'SAÚDE'],
            ['segment_id' => 2, 'description' => 'TURISMO'],

            ['segment_id' => 3, 'description' => 'CONDOMÍNIO DE CASAS'],
            ['segment_id' => 3, 'description' => 'EMPREENDIMENTOS VERTICAIS'],
        ];

        $segmentSupTypesQuantity = count($segmentSubTypes);
        SegmentSubType::factory($segmentSupTypesQuantity)
            ->make()
            ->each(function ($segmentSubType, $key) use ($segmentSubTypes) {
                $segmentSubTypeDescription = $segmentSubTypes[$key]['description'];
                $phaseId = $segmentSubTypes[$key]['segment_id'];
                
                $segmentSubType->segment_id = $phaseId;
                $segmentSubType->description = $segmentSubTypeDescription;
                $segmentSubType->save();
            });
    }
}
