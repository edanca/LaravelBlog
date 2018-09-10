@extends('layouts.app')

@section('content')

	<div class="form-group pb-4">
		<span class="text-muted float-left">
			Encontrados <span class="badge badge-primary">{{ $messages->count() }}</span> resultados.
		</span>
	</div>
	

	@foreach ($messages as $message)
		@include('messages.message')
	@endforeach
@endsection