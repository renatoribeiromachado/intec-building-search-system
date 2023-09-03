<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmailCompany;
use App\Http\Controllers\Controller; // Importante para corrigir o namespace
use Illuminate\Support\Facades\Mail as FacadesMail; // Importante para evitar conflitos de nome

class CronCompanyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function cron() {
        // Buscar informações do banco de dados
        $sql = "SELECT 
                s.appointment_date,
                s.priority,
                s.status,
                s.notes,
                u.email,
                c.trading_name
                FROM sig_companies as s
                INNER JOIN users as u
                ON u.id = s.user_id
                INNER JOIN companies as c
                ON c.id = s.company_id
                WHERE DATE(appointment_date) = CURDATE()";
        $results = \DB::select($sql);

        // Iterar sobre os resultados e enviar emails
        foreach ($results as $result) {
            $mailData = [
                'title' => 'INTEC Brasil - SIG empresa',
                'body' => 'Você tem um agendamento de SIG',
                'appointment_date' => $result->appointment_date,
                'trading_name' => $result->trading_name,
                'priority' => $result->priority,
                'status' => $result->status,
                'notes' => $result->notes
            ];

            Mail::to($result->email)->send(new SendEmailCompany($mailData));
        }

        dd("Emails enviados com sucesso.");
    }

}
