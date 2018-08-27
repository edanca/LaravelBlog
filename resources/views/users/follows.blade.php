@extends('layouts.app')

@section('content')

<h1>{{ $user->name }}</h1>

<ul class="list-unstyled">
	@foreach ($follows as $follow)
	<li>{{ $follow->name }}: <a href="/{{ $follow->username }}">{{ $follow->username }}</a></li>
	@endforeach	
</ul>

@endsection