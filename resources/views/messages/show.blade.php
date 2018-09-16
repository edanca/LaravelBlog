@extends('layouts.app')

@section('content')
	<h1>Mensaje id: {{ $message->id }}</h1>
@include('messages.message')

{{-- Usamos eetiquetas de Blade junto con Vue --}}
<responses :message="{{ $message->id }}"></responses>

@endsection