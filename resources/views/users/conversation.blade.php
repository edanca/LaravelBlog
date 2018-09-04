@extends('layouts.app')

@section('content')
	{{-- Returns me all the users collections, except the logged user, and we join all this collection with implode using only the field that we passed in --}}
	<h1>Conversación con {{ $conversation->users->except($user->id)->implode('name', ', ') }}</h1>

	@foreach ($conversation->privateMessages as $message)
		<div class="card">
			<div class="card-header">
				<p>{{ $message->user->name }} dijo ...</p>
			</div>
			<div class="card-body">
				<p>{{ $message->message }}</p>
			</div>
			<div class="blockquote-footer">
				<p>{{ $message->created_at }}</p>
			</div>
		</div>
	@endforeach

@endsection
