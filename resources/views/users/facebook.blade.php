@extends('layouts.app')

@section('content')
<form action="/auth/facebook/register" method="post">
	@csrf
	<div class="card">
		<div class="card-block">
			<img src="{{ $user->avatar }}" alt="Facebook" class="img-thumbnail">
		</div>
		<div class="card-block">

			<div class="form-group">
				<label for="name" class="form-control-label">Nombre</label>
				<input type="text" name="name" value="{{ $user->name }}" class="form-control" readonly>
			</div>

			<div class="form-group">
				<label for="email" class="form-control-label">Email</label>
				<input type="text" name="email" value="{{ $user->email }}" class="form-control" readonly>
			</div>

			<div class="form-group">
				<label for="username" class="form-control-label">Usuario</label>
				<input type="text" name="username" value="{{ old('username') }}" class="form-control">
			</div>

			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Registrarse</button>
			</div>
		</div>
	</div>
</form>
@endsection