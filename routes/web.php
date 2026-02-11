<?php

use Illuminate\Support\Facades\Route;
use App\Models\Property;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Api\ChatbotController;

/*
|--------------------------------------------------------------------------
| Web Routes - José Carvalho Real Estate
|--------------------------------------------------------------------------
*/

// --- HOME & INSTITUCIONAL ---

Route::get('/', function () {
    // Busca 3 imóveis de forma aleatória para a vitrine
    $properties = Property::where('is_visible', true)
        ->inRandomOrder()
        ->take(3)
        ->get();
        
    return view('home', compact('properties'));
})->name('home');

Route::get('/sobre', function () {
    return view('about');
})->name('about');


// --- CONTACTOS (Landing Page de Conversão) ---

Route::get('/contactos', function () {
    return view('contact');
})->name('contact');

// Processamento do Formulário (SOP Compliance)
Route::post('/contactos/enviar', [ContactController::class, 'send'])->name('contact.send');


// --- PORTFÓLIO (IMÓVEIS) ---

// [CORREÇÃO]: A rota principal agora chama-se 'properties.index' para o buscador funcionar.
Route::get('/imoveis', [PropertyController::class, 'publicIndex'])->name('properties.index');

// Rota de redundância (Alias) caso o menu do site use 'portfolio'
Route::get('/portfolio', [PropertyController::class, 'publicIndex'])->name('portfolio');

// Detalhes do Imóvel
Route::get('/imoveis/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');


// --- FERRAMENTAS (Iscas Digitais) ---

Route::get('/ferramentas/simulador-credito', function () {
    return view('tools.credit');
})->name('tools.credit');

Route::get('/ferramentas/imt', function () {
    return view('tools.imt');
})->name('tools.imt');

Route::get('/ferramentas/mais-valias', [ToolsController::class, 'showGainsSimulator'])->name('tools.gains');
Route::post('/ferramentas/mais-valias/calcular', [ToolsController::class, 'calculateGains'])->name('tools.gains.calculate');


// --- PÁGINAS LEGAIS ---

Route::get('/termos-e-condicoes', function () {
    return view('legal.terms');
})->name('terms');


// --- CHATBOT (AI Assistant) ---

Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');


// --- BACKOFFICE (ADMINISTRAÇÃO) ---

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    
    // Proteção contra Brute Force (5 tentativas/minuto)
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('admin.login.submit');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::resource('properties', PropertyController::class)->names('admin.properties');
    });
});