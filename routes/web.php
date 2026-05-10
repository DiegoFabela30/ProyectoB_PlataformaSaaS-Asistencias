<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Instituciones (admin)
Route::get('/instituciones', function () {
    return view('instituciones.index');
})->name('instituciones.index');

// Membresías (admin)
Route::get('/membresias', function () {
    return view('membresias.index');
})->name('membresias.index');

// Aulas (admin, docente)
Route::get('/aulas', function () {
    return view('aulas.index');
})->name('aulas.index');

// Asistencias — vista docente (admin, docente)
Route::get('/asistencias/docente', function () {
    return view('asistencias.docente');
})->name('asistencias.docente');

// Asistencias — vista alumno (alumno)
Route::get('/asistencias/alumno', function () {
    return view('asistencias.alumno');
})->name('asistencias.alumno');

// Justificantes (todos los roles)
Route::get('/justificantes', function () {
    return view('justificantes.index');
})->name('justificantes.index');

// Reportes (admin, docente)
Route::get('/reportes', function () {
    return view('reportes.index');
})->name('reportes.index');

// Cierre de Ciclo (docente)
Route::get('/ciclo/cierre', function () {
    return view('ciclo.cierre');
})->name('ciclo.cierre');

// Edición Administrativa (admin, docente)
Route::get('/admin/edicion', function () {
    return view('admin.edicion');
})->name('admin.edicion');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

Route::get('/aviso-de-privacidad', function () {
    return view('legal.privacy');
})->name('privacy');

// Aulas (admin, docente)
Route::get('/aulas/create', function () {
    return view('aulas.create');
})->name('aulas.create');