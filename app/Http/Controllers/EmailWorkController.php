<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSelectedWorksEmail;
use App\Http\Requests\StoreWorkSelected;

class EmailWorkController extends Controller
{
    public function sendEmailWork(StoreWorkSelected $request)
    {
        $emailDestination = $request->input('emailDestination');
        $emailsArray = explode(',', $emailDestination);
        
        $data = [
            'senderName' => $request->input('senderName'),
            'senderEmail' => $request->input('senderEmail'),
            'selectedWorks' => $request->input('selectedWorks'),
        ];

        foreach ($emailsArray as $email) {
            Mail::to(trim($email))->send(new SendSelectedWorksEmail($data)); 
        }

        return redirect()->back()->with('success', 'Obras selecionada(s) enviada(s) com sucesso!');
    }
}


