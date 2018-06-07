<?php

Route::get('/provincia/{id}/cantones','CspAgendaTerritorialController@obtenerCantones');

Route::get('/propuestas/{id}','InstitucionController@obtenerPropuestas');
