<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmail;
use App\Http\Controllers\Controller; // Importante para corrigir o namespace
use Illuminate\Support\Facades\Mail as FacadesMail; // Importante para evitar conflitos de nome




class CronController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function cron() {
        // Buscar informações do banco de dados
        $sql = "SELECT code,
                appointment_date,
                user_email,
                priority,
                status,
                note  
                FROM sigs
                WHERE DATE(appointment_date) = CURDATE()";
        $results = \DB::select($sql);

        // Iterar sobre os resultados e enviar emails
        foreach ($results as $result) {
            $mailData = [
                'title' => 'INTEC BRASIL',
                'body' => 'Você tem um agendamento de SIG',
                'appointment_date' => $result->appointment_date,
                'priority' => $result->priority,
                'status' => $result->status,
                'note' => $result->note
            ];

            Mail::to($result->user_email)->send(new SendEmail($mailData));
        }

        dd("Emails enviados com sucesso.");
    }

}
