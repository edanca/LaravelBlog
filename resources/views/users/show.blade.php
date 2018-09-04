@extends('layouts.app')

@section('content')

<h1>{{ $user->name }}</h1>

<div class="mb-3">
	<a href="/{{ $user->username }}/follows" class="btn">
		Sigue a <span class="badge badge-secondary">{{ $user->follows->count() }}</span>
	</a>
	
	<a href="/{{ $user->username }}/followers" class="btn">
		Seguidores <span class="badge badge-secondary">{{ $user->followers->count() }}</span>
	</a>	
</div>


@if (Auth::check())

	@if (Gate::allows('dms', $user))
		{{-- dms is direc messages --}}
		<form action="/{{ $user->username }}/dms" method="post" class="form-inline">
			@csrf
			<label class="sr-only" for="inlineFormInputGroupUsername">Message</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<button type="submit" class="input-group-text">Enviar</button>
				</div>
				<input type="text" name="message" class="form-control" id="inlineFormInputGroupUsername" placeholder="Direct Message">
			</div>
			{{-- <input type="text" name="message" class="form-control mb-2 col col-md-8">
			<button type="submit" class="btn btn-success col col-md-4">Enviar DM</button> --}}
		</form>
	@endif


	{{-- user is the Model --}}
	@if (Auth::user()->isFollowing($user))
		<form action="/{{ $user->username }}/unfollow" method="post" class="mb-3">
			@csrf()
			<button class="btn btn-danger">Dejar de seguir</button>
			@if(session('success'))
				<span class="text-success ml-4">{{ session('success') }}</span>
			@endif
		</form>
	@else
		<form action="/{{ $user->username }}/follow" method="post" class="mb-3">
			@csrf()
			<button class="btn btn-primary">Seguir</button>
			@if(session('success'))
				<span class="text-success ml-4">{{ session('success') }}</span>
			@endif
		</form>
	@endif
@endif

<div class="row">
	@foreach ($messages as $message)
		<div class="col-6">
			@include('messages.message')
		</div>
	@endforeach
</div>

<div class="row">
	@if(count($messages))
		<div class="mt-2 mx-auto">
			{{-- Este método solo estará disponible si estamos usando el metodo de Paginacion --}}
			{{ $messages->links() }}
			{{-- En caso de que los links aparescan sin estilización, hay que agregar como parametro a links() el string 'bootstrap-4' para que utilice el template de bootstrap4 --}}
		</div>
	@endif
</div>
    
@endsection