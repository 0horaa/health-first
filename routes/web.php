<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/data', [PatientController::class, 'patientsData'])->name('patients.data');

Route::post('/patients', [PatientController::class, 'store'])->name('patients.create');
Route::get('/patients/{id}', [PatientController::class, 'show']);
Route::put('/patients/update/{id}', [PatientController::class, 'update']);
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);
