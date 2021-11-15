<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
use App\Type;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        $types = Type::all();
        return view('auth.register', compact('types'));
    }

    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('show', Auth::user()->id);
        }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }


    public function postRegistration(Request $request)
    {
        // dd($request -> all());

        request()->validate([
        'name' => 'required',
        'cognome' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'nome_attivita'=>'required','string','max:64',
        'via'=>['required','string','max:64'],
        'n_civico'=>['required','string','max:8'],
        'citta'=>['required','string','max:64'],
        'cap'=>['required','string','max:16'],
        'p_iva'=>['required','string','max:16'],
        'types_id' => 'required|exists:types,id|array',
        'types_id.*' => 'integer',
        ]);

        $request->validate([
            'image' => 'mimes:jpeg,bmp,png',
        ]);

        $request->file->store('restaurantImages', 'public');

        // dd($validated)
        $data = $request->all();
        $check = $this -> create($data);
        $check -> save();

        $check -> types() -> attach($request -> get('types_id'));

        $check -> save();
        Auth::login($check);
        return redirect() ->route('show', Auth::user()->id);
        // return redirect() -> route('getLogin');

    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'cognome' => $data['cognome'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nome_attivita'=>$data['nome_attivita'],
            'via'=>$data['via'],
            'n_civico'=>$data['n_civico'],
            'citta'=>$data['citta'],
            'cap'=>$data['cap'],
            'p_iva'=>$data['p_iva'],
            'file_path' =>$data['file']->hashName(),
        ]);
    }
}
