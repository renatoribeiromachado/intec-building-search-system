<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    const ADMIN_ID = 3;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zones = (new \App\Models\Zone)->get();

        if ($zones) {
            foreach ($zones as $zone) {
                $this->findTheZoneAndInsertStates($zone->description);
            }
        }
    }

    protected function findTheZoneAndInsertStates(string $zoneDescription): array
    {
        $zonesFound = [];
        switch ($zoneDescription) {

            case 'NORTE':
                $zoneId = \App\Models\Zone::where('description', '=', 'NORTE')->first()->id;
                $insert = [
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'AC',
                        'description' => 'Acre',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'AM',
                        'description' => 'Amazonas',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'AP',
                        'description' => 'Amapá',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'PA',
                        'description' => 'Pará',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'RO',
                        'description' => 'Rondônia',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'RR',
                        'description' => 'Roraima',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'TO',
                        'description' => 'Tocantins',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                ];
                DB::table('states')->insert($insert);
                break;

            case 'NORDESTE':
                $zoneId = \App\Models\Zone::where('description', '=', 'NORDESTE')->first()->id;
                $insert = [
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'AL',
                        'description' => 'Alagoas',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'BA',
                        'description' => 'Bahia',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'CE',
                        'description' => 'Ceará',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'MA',
                        'description' => 'Maranhão',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'PB',
                        'description' => 'Paraíba',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'PE',
                        'description' => 'Pernambuco',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'PI',
                        'description' => 'Piauí',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'RN',
                        'description' => 'Rio Grande do Norte',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'SE',
                        'description' => 'Sergipe',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                ];
                DB::table('states')->insert($insert);
                break;

            case 'CENTRO-OESTE':
                $zoneId = \App\Models\Zone::where('description', '=', 'CENTRO-OESTE')->first()->id;
                $insert = [
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'DF',
                        'description' => 'Distrito Federal',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'GO',
                        'description' => 'Goiás',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'MT',
                        'description' => 'Mato Grosso',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'MS',
                        'description' => 'Mato Grosso do Sul',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                ];
                DB::table('states')->insert($insert);
                break;

            case 'SUDESTE':
                $zoneId = \App\Models\Zone::where('description', '=', 'SUDESTE')->first()->id;
                $insert = [
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'ES',
                        'description' => 'Espírito Santo',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'MG',
                        'description' => 'Minas Gerais',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'RJ',
                        'description' => 'Rio de Janeiro',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'SP',
                        'description' => 'São Paulo',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                ];
                DB::table('states')->insert($insert);
                break;

            case 'SUL':
                $zoneId = \App\Models\Zone::where('description', '=', 'SUL')->first()->id;
                $insert = [
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'PR',
                        'description' => 'Paraná',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'RS',
                        'description' => 'Rio Grande do Sul',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                    [
                        'zone_id' => $zoneId,
                        'state_acronym' => 'SC',
                        'description' => 'Santa Catarina',
                        'created_by' => self::ADMIN_ID,
                        'updated_by' => self::ADMIN_ID
                    ],
                ];
                DB::table('states')->insert($insert);
                break;

            default:
                break;
        }

        return $zonesFound;
    }
}
