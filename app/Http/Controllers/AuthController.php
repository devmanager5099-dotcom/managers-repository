<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Throwable;

class AuthController
{
    public function loginForm(){
        return view('users.login');
    }

    public function logout(){
        Auth()->logout();
        return redirect()->route('index');
    }

    public function loginFunc(Request $request){
        $credencias = [
            'email'=> $request->email,
            'password'=> $request->password
        ];
        if(Auth()->attempt($credencias)){
            if(Auth()->user()->is_admin){
                return redirect()->route('admin');
            }else
                return redirect()->route('home');
        }
        session()->flash("Erro", "Conta não encontrada"); 
        return redirect()->back();    
    }

    public function cadastroForm(){
        return view("users.cadastro");
    }

    public function cadastroFunc(Request $request){

        try {
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
                'telefone'=>$request->telefone,
                'is_admin'=>false
            ]);
            session()->flash('sucesso', 'Conta criada com sucesso, faça login');
            return redirect()->route('login.form'); 
        } catch (Throwable $th) {
             session()->flash('erro', 'conta já existe, faça login');
            return redirect()->back();
        }       
    }
}