<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Models\Cron;
//use Illuminate\Support\Carbon;
//use Illuminate\Support\Facades\Auth;




class CronController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function cron() {
        //dd("aqui");
        $sql = "SELECT code,
                appointment_date,
                user_email,
                priority,
                status,
                note  
                FROM sigs";
        $results = \DB::select($sql);
        dd($results);
        return $results;
    }

}
