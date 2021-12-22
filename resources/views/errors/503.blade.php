@extends('errors::illustrated-layout')


@section('code', '503')
@section('title', __('Servidor No Disponible'))
@section('message', __($exception->getMessage() ?: 'Servidor no disponible, pruebe nuevamente en unos minutos.'))