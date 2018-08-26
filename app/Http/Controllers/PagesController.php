<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function home() {

    	// $messages = Message::all();
    	$messages = Message::latest()->paginate(6);

    	// var_dump() en laravel dd()
    	// dd($messages);

    	return view('welcome', [
    		'messages' => $messages,
    	]);
    }

}
