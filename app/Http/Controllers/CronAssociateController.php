<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmailAssociate;
use App\Http\Controllers\Controller; // Importante para corrigir o namespace
use Illuminate\Support\Facades\Mail as FacadesMail; // Importante para evitar conflitos de nome

class CronAssociateController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function cron() {
        // Buscar informações do banco de dados
        $sql = "SELECT 
                s.appointment_date,
                s.code_associate,
                s.notes,
                u.email
                FROM sig_associates as s
                INNER JOIN users as u
                ON u.id = s.user_id
                WHERE DATE(appointment_date) = CURDATE()";
        $results = \DB::select($sql);

        // Iterar sobre os resultados e enviar emails
        foreach ($results as $result) {
            $mailData = [
                'title' => 'INTEC Brasil - SIG associados',
                'body' => 'Você tem um agendamento de SIG',
                'appointment_date' => $result->appointment_date,
                'code_associate' => $result->code_associate,
                'notes' => $result->notes
            ];

            Mail::to($result->email)->send(new SendEmailAssociate($mailData));
        }

        dd("Emails enviados com sucesso.");
    }

}
