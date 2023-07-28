<?php

namespace App\Imports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompaniesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd(
        //     $row['atualizacao'],
        //     \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['atualizacao']))
        // );
        // exit;
        return new Company([
            'researcher_id' => null,
            'activity_field_id' => $this->findActivityFieldId($row['descricaoatividade']),
            'company_name' => $row['razaosocial'],
            'trading_name' => $row['fantasia'],
            'city' => $row['cidade'],

            // '' => $row['codigo'],
            'trading_name' => $row['fantasia'],
            'company_name' => $row['razaosocial'],
            'address' => $row['endereco'],
            'number' => $row['numero'],
            'complement' => $row['complemento'],
            'city' => $row['cidade'],
            'state' => $row['uf'],
            // '' => $row['descricaoatividade'],
            'cnpj' => $row['cnpj'],
            'state_registration' => $row['inscricaoestadual'],
            'city_registration' => $row['inscricaomunicipal'],
            'last_review' => \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['atualizacao'])),
            'revision' => $row['nrdarevisao'],
            'home_page' => $row['website'],
            'primary_email' => $row['email'],
            'secondary_email' => $row['email2'],
            'is_active' => $row['descricaostatus'] == 'Ativo' ? 1 : 0,
            'notes' => "Pesquisador: {$row['siglapesquisador']}, Usuário: {$row['usuario']} | ".$row['observacao'],
            // '' => $row['siglapesquisador'],
            // '' => $row['usuario'],
            'created_by' => 3,
            'updated_by' => 3,
        ]);
    }

    protected function findActivityFieldId(string $activityField)
    {
        $activity = new \App\Models\ActivityField;
        $activityFound = $activity->where('description', '=', $activityField)->first();

        return $activityFound->id;
    }
}
