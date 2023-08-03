<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddZoneFieldInWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->string('zone')->nullable()->after('zip_code');
        });

        $works = (new \App\Models\Work)->select('id', 'state')->get();

        if ($works) {
            $zone = null;

            foreach ($works as $work) {
                $zone = $this->findZone($work->state);

                DB::table('works')
                    ->where('id', $work->id)
                    ->update([
                        'zone' => $zone
                    ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn('zone');
        });
    }

    protected function findZone(string $state): ?string
    {
        $zone = null;
        switch ($state) {
            // REGIÃO NORTE
            case 'AC':
            case 'AM':
            case 'AP':
            case 'PA':
            case 'RO':
            case 'RR':
            case 'TO':
                $zone = 'NORTE';
                break;

            // REGIÃO NORDESTE
            case 'AL':
            case 'BA':
            case 'CE':
            case 'MA':
            case 'PB':
            case 'PE':
            case 'PI':
            case 'RN':
            case 'SE':
                $zone = 'NORDESTE';
                break;

            // REGIÃO CENTRO-OESTE
            case 'DF':
            case 'GO':
            case 'MT':
            case 'MS':
                $zone = 'CENTRO-OESTE';
                break;

            // REGIÃO SUDESTE
            case 'ES':
            case 'MG':
            case 'RJ':
            case 'SP':
                $zone = 'SUDESTE';
                break;

            // REGIÃO SUL
            case 'PR':
            case 'RS':
            case 'SC':
                $zone = 'SUL';
                break;
        }

        return $zone;
    }
}
