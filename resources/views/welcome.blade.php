@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Laratter</h1>
        <nav>
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            </ul>
        </nav>
    </div>

    {{-- VALIDATION EXAMPLE --}}
    <div class="row">
        <form action="/messages/create" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="form-group @if($errors->has('message')) was-validated @endif">
                {{-- {{ csrf_field() }} --}}
                @csrf
                <input type="text" name="message" class="form-control @if($errors->has('message')) is-invalid @endif" placeholder="Qué estás pensando?" required>
                {{-- @if ($errors->any()) --}}
                @if ($errors->has('message')) {{-- validamos especificamente si el campo mensaje tiene error --}}
                    @foreach($errors->get('message') as $error)
                        <span class="invalid-feeback text-danger">
                            {{ $error }}
                        </span>
                    @endforeach
				@endif
				<input type="file" name="image" class="form-control-file">
            </div>
        </form>
    </div>

    <div class="row">
        @forelse ($messages as $message)
            <div class="col-6">
                {{-- Incluyo indicando carpeta y archivo --}}
                @include('messages.message')
            </div>
        @empty
            <p>No hay mensajes destacados.</p>
        @endforelse
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