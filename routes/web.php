<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\HayonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\TypeHayonController;
use App\Http\Controllers\TypePanneController;
use App\Http\Controllers\TypeVehiculeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\VilleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);// Route::get('login',[AuthController::class , 'login']);
// Route::post('auth/login',[AuthController::class , 'auth']);

Route::middleware('auth:sanctum')->group(function(){

    // Route::post('logout',[AuthController::class , 'logout'])->name('logout');
    Route::get('/',[HomeController::class, 'index'])->name('home');


    Route::get('/Status',[StatusController::class, 'index']);
    Route::get('/Permission',[PermissionController::class, 'index']);

    //passed
    Route::resource('User',UserController::class);
    Route::get('/deleted/User',[UserController::class, 'deleted'])->name('User.deleted');
    Route::post('/restore/User/{id}',[UserController::class, 'restore'])->name('User.restore');

    Route::resource('Role',RoleController::class);
    Route::get('/deleted/Role',[RoleController::class, 'deleted'])->name('Role.deleted');
    Route::post('/restore/{id}/Role',[RoleController::class, 'restore'])->name('Role.restore');
    Route::post('/Role/add',[RoleController::class, 'add'])->name('Role.add');
    //rec
    Route::resource('Reclamation',ReclamationController::class);
    Route::get('/deleted/Reclamation',[ReclamationController::class, 'deleted'])->name('Reclamation.deleted');
    Route::post('/restore/Reclamation/{id}',[ReclamationController::class, 'restore'])->name('Reclamation.restore');

    //passed
    Route::apiResource('Configuration',ConfigurationController::class);
    Route::get('/Configuration/deleted',[ConfigurationController::class, 'deleted']);
    Route::post('/Configuration/restore/{id}',[ConfigurationController::class, 'restore']);

    Route::resource('Societe',SocieteController::class);
    Route::get('/deleted/societe',[SocieteController::class, 'deleted'])->name('Societe.deleted');
    Route::post('/restore/societe/{id}',[SocieteController::class, 'restore'])->name('Societe.restore');

    Route::resource('Vehicule',VehiculeController::class);
    Route::get('/deleted/vehicule/',[VehiculeController::class, 'deleted'])->name('Vehicule.deleted');
    Route::post('restore/vehicule/{id}',[VehiculeController::class, 'restore'])->name('Vehicule.restore');
    Route::get('GetVehicule/{id}',[VehiculeController::class, 'getvehicule'])->name('Vehicule.getvehicule');
    Route::post('Vehicule/upload/{id}',[VehiculeController::class, 'upload'])->name('Vehicule.upload');
    Route::post('Vehicule/{id}/contrat/detach',[VehiculeController::class, 'detach'])->name('Vehicule.detach');
    Route::post('Vehicule/contrat/attach',[VehiculeController::class, 'attach'])->name('Vehicule.attach');


    Route::get('Document/create/{id}',[DocumentController::class, 'create'])->name('Document.create');
    Route::post('Document/store/{id}',[DocumentController::class, 'store'])->name('Document.store');

    Route::resource('TypeVehicule',TypeVehiculeController::class);
    Route::get('/deleted/typeVehicule',[TypeVehiculeController::class, 'deleted'])->name('TypeVehicule.deleted');
    Route::post('/TypeVehicule/restore/{id}',[TypeVehiculeController::class, 'restore'])->name('TypeVehicule.restore');

    Route::resource('TypePanne',TypePanneController::class);
    Route::get('deleted/TypePanne',[TypePanneController::class, 'deleted'])->name('TypePanne.deleted');
    Route::post('/TypePanne/restore/{id}',[TypePanneController::class, 'restore'])->name('TypePanne.restore');

    Route::resource('Ville',VilleController::class);
    Route::get('deleted/Ville',[VilleController::class, 'deleted'])->name('Ville.deleted');
    Route::post('/Ville/restore/{id}',[VilleController::class, 'restore'])->name('Ville.restore');

    Route::resource('TypeHayon',TypeHayonController::class);
    Route::get('deleted/TypeHayon',[TypeHayonController::class, 'deleted'])->name('TypeHayon.deleted');
    Route::post('/TypeHayon/restore/{id}',[TypeHayonController::class, 'restore'])->name('TypeHayon.restore');

    Route::resource('TypeDocument',TypeDocumentController::class);
    Route::get('deleted/TypeDocument',[TypeDocumentController::class, 'deleted'])->name('TypeDocument.deleted');
    Route::post('/TypeDocument/restore/{id}',[TypeDocumentController::class, 'restore'])->name('TypeDocument.restore');

    Route::resource('Hayon',HayonController::class);
    Route::get('deleted/Hayon',[HayonController::class, 'deleted'])->name('Hayon.deleted');
    Route::post('/Hayon/restore/{id}',[HayonController::class, 'restore'])->name('Hayon.restore');

    Route::resource('Contrat',ContratController::class);
    Route::get('/Contrat/deleted',[ContratController::class, 'deleted'])->name('Contrat.deleted');
    Route::post('/Contrat/restore/{id}',[ContratController::class, 'restore'])->name('Contrat.restore');

    Route::resource('Examen',ExamenController::class);
    Route::get('/deleted/Examen',[ExamenController::class, 'deleted'])->name('Examen.deleted');
    Route::post('/Examen/restore/{id}',[ExamenController::class, 'restore'])->name('Examen.restore');

    Route::resource('Question',QuestionController::class)->except('show','index');
    Route::get('/deleted/Question',[QuestionController::class, 'deleted'])->name('Question.deleted');
    Route::post('/Question/restore/{id}',[QuestionController::class, 'restore'])->name('Question.restore');

    Route::resource('Rapport',RapportController::class);
    Route::get('/deleted/Rapport',[RapportController::class, 'deleted'])->name('Rapport.deleted');
    Route::post('/Rapport/restore/{id}',[RapportController::class, 'restore'])->name('Rapport.restore');

    Route::get('Contact/create/{id}',[ContactController::class, 'create'])->name('Contact.create');
    Route::post('Contact/store',[ContactController::class, 'store'])->name('Contact.store');
    Route::get('Contact/edit/{id}',[ContactController::class, 'edit'])->name('Contact.edit');
    Route::put('Contact/update/{id}',[ContactController::class, 'update'])->name('Contact.update');
    Route::delete('Contact/destroy/{id}',[ContactController::class, 'destroy'])->name('Contact.destroy');
    Route::get('/deleted/Contact/{id}',[ContactController::class, 'deleted'])->name('Contact.deleted');
    Route::post('/Contact/restore/{id}',[ContactController::class, 'restore'])->name('Contact.restore');




    // Route::resource('Contrat',ContratController::class);
    // Route::get('/Contrat/deleted',[ContratController::class, 'deleted'])
    // Route::post('/Contrat/restore/{id}',[ContratController::class, 'restore']);

    Route::get('/Intervention/{date}',[InterventionController::class, 'index']);
    Route::get('/Intervention/calendar',[InterventionController::class, 'calendar'])->name('Intervention.calendar');
    Route::get('/GetHayon/{id}',[InterventionController::class, 'gethayon'])->name('Intervention.gethayon');
    Route::get('/List/Intervention',[InterventionController::class, 'list'])->name('Intervention.list');
    Route::get('/create/Intervention',[InterventionController::class, 'create'])->name('Intervention.create');
    Route::post('/Intervention',[InterventionController::class, 'store'])->name('Intervention.store');
    Route::get('/Intervention/edit/{id}',[InterventionController::class, 'edit'])->name('Intervention.edit');
    Route::put('/Intervention/Update/{id}',[InterventionController::class, 'update'])->name('Intervention.update');


    Route::get('/filter/Intervention',[InterventionController::class, 'filter']);
    Route::get('/show/Intervention/{id}',[InterventionController::class, 'show'])->name('interv.show');
    Route::post('/cancel/Intervention/{id}',[InterventionController::class, 'cancel'])->name('interv.cancel');

    // Route::resource('Intervention',InterventionController::class)->except(['index','show']);
    Route::resource('Permission',PermissionController::class)->only(['index','store']);

});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
