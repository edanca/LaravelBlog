@extends('layouts.app')

@section('content')

	<h1>{{ $user->name }}</h1>
	
	<form action="/{{ $user->username }}/follow" method="post" class="mb-3">
		@csrf()
		<button class="btn btn-primary">Follow</button>
		@if(session('success'))
			<span class="text-success ml-4">{{ session('success') }}</span>
		@endif
	</form>

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