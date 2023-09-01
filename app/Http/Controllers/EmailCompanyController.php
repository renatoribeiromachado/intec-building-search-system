<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSelectedWorksEmailCompany;
use App\Http\Requests\StoreWorkSelected;

class EmailCompanyController extends Controller
{
    public function sendEmailCompany(StoreWorkSelected $request)
    {
        $emailDestination = $request->input('emailDestination');
        $emailsArray = explode(',', $emailDestination);
        
        $data = [
            'senderName' => $request->input('senderName'),
            'senderEmail' => $request->input('senderEmail'),
            'link' => $request->input('link'),
            'notes' => $request->input('notes'),
        ];

        foreach ($emailsArray as $email) {
            Mail::to(trim($email))->send(new SendSelectedWorksEmailCompany($data)); 
        }

        return redirect()->back()->with('success', 'Link de empresa(s) selecionada(s) enviada(s) com sucesso!');
    }
}


