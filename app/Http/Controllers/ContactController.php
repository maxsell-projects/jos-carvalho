<?php

namespace App\Http\Controllers;

use App\Mail\ContactLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|min:3|max:255',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string',
            'message' => 'required|string|min:10|max:2000',
        ]);

        try {
            // Ao usar ShouldQueue no Mailable, o método send() 
            // automaticamente despacha para a fila configurada.
            Mail::to('geminiemail05@gmail.com')->send(new ContactLead($validated));

            return back()->with('success', 'A sua mensagem foi enviada com sucesso! Entraremos em contacto brevemente.');

        } catch (\Exception $e) {
            // Este log agora captura falhas no despacho da fila
            Log::error('Erro ao despachar e-mail para a fila: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Ocorreu um erro técnico. Por favor, tente novamente ou use o WhatsApp.');
        }
    }
}