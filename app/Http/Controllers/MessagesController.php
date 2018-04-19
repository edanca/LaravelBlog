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

    	$message = Message::create([
    		'content' => $request->input('message'),
    		'image' => 'http://lorempixel.com/600/338?' . mt_rand(0, 1000)
    	]);

    	// dd($message);
    	return redirect('/messages/' . $message->id);

    }


}
