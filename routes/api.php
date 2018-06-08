<?php

Route::get('/provincia/{id}/cantones','CspAgendaTerritorialController@obtenerCantones');

Route::get('/propuestas/{id}','InstitucionController@obtenerPropuestas');

Route::get('/zona/{id}/provincias','MesaDialogoController@obtenerProvincias');
Route::get('/canton/{id}/parroquias','MesaDialogoController@obtenerParroquias');
