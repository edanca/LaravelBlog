<img class="img-thumbnail" src="{{ $message->image }}">
<p class="card-text">
    <div>
    <span class="text-muted">Escrito por <a href="/{{ $message->user->username }}">{{ $message->user->name }}</a></span>
    </div>
    {{ $message->content }}
    <a href="/messages/{{ $message->id }}">Leer más</a>
</p>

<div class="card-text text-muted float-right">
    {{ $message->created_at }}
</div>