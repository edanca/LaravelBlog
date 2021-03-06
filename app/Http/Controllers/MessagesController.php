<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Requests\CreateMessageRequest;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    //ES IMPORTANTE QUE EL NOMBRE DEL MESSAGE SEA EL MISMO QUE EL QUE ESTAMOS PONIENDO EN \routes\web.php
    // De lo contrario no entrará  esta función
    public function show(Message $message) {
    	// Ir a buscar el Message por ID
    	// $message = Message::find($id);

    	// Una view de un message
    	// Siempre que en los view usemos punto, estamos indicando una carpeta
    	return view('messages.show', [
    		'message' => $message
    	]);
    }

    /*// DE ESTA MANERA SE PUEDE VALIDAR DE FORMA INDIVIDUAL
    public function create(Request $request) {
    	// dd($request->all());
    	$this->validate($request, [
    		'message' => ['required', 'max:160']
    	], [
    		'message.required' => 'Por favor, escribe tu mensaje.',
    		'message.max' => 'El mensaje no puede superar los 160 caracteres.'
    	]);
    	return 'Llegó';
    }*/

    // LA OTRA MANERA DE VALIDAR ES MEDIANTES VALIDADORES DE REQUEST DE LA CARPETA App\http\Request
    // Se utiliza el nombre del validador y se lo importa con los namespaces
    public function create(CreateMessageRequest $request) {

		// Since we already validate with the middleware auth that the user is looged-in we directly use the USER that came in the request
		$user = $request->user();
		$image = $request->file('image');

    	$message = Message::create([
			'user_id' => $user->id,
    		'content' => $request->input('message'),
    		// 'image' => 'http://lorempixel.com/600/338?' . mt_rand(0, 1000)
			// 'image' => 'https://picsum.photos/600/338?image=' . mt_rand(0, 1000) //picsum only has 1000 images
			'image' => $image->store('messages', 'public'), // Para public se creó un enlace simbólico en la raíz del projecto
    	]);

    	// dd($message);
    	return redirect('/messages/' . $message->id);
    }


	public function search(Request $request) {
		
		$query = $request->input('query');

		// This way the query will acompplish the WHERE and will bring us all the users for that query
		// $messages = Message::with('user')->where('content', 'LIKE', "%$query%")->get(); // Replaced by laravel scout and algolia
		$messages = Message::search($query)->get();
		$messages->load('user');

		return view('messages.index', [
			'messages' => $messages,
		]);
	}


	public function responses(Message $message) {

		return $message->responses;
	}
}
