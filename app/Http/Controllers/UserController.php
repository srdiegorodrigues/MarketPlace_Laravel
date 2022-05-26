<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use PDF;


class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function index()
    {
        $user = auth()->user();
        return view('user.my-profile', compact('user'));
    }

    public function userEdit($user)
    {
        $user = $this->user->findOrFail($user);
        return view('user.user-edit',compact('user'));
    }

    public function userUpdate(UserRequest $request, $user)
    {
        $data = $request->validated();
        $userData = $this->user->findOrFail($user);
        $update = $userData->update($data);

        if($update){
            if(auth()->user()->id == $user){
                flash('Os seus dados foram atualizados com sucesso!')->success();
                $user = auth()->user();
                return view('user.my-profile', compact('user'));
            }else{
                flash('Os dados de '.$data['name'].' foram atualizados com sucesso!')->success();
                return redirect()->route('administrator.users.list');
            }
        }else{
            flash('Falha ao atualizar o perfil do usuário ')->error();
            return view('user.user-edit',compact('user'));
        }
    }

    public function userPassword()
    {
        $user = auth()->user()->id;
        $user = $this->user->findOrFail($user);
        return view('user.user-password',compact('user'));
    }

    public function updatePassword(PasswordRequest $request)
    {

        $user = auth()->user();
        $data = $request->validated();

        if(Hash::check($data['old_password'],Auth()->user()->password)) {
            if($data['new_password'] != ''){
                $data['new_password']  = bcrypt($data['new_password']);
            }
            $update = auth()->user()->update([
                'password' => $data['new_password']
            ]);
        }else{
            flash('Valor informado em senha atual é inválido!')->error();
            return redirect()->back();
        }
        if($update){
            flash('Senha atualizada com sucesso!')->success();
            return view('user.my-profile', compact('user'));
        }else{
            flash('Falha ao tentar salvar a nova senha!')->error();
            return redirect()->back();
        }
    }

    public function userRemove($user)
    {
        $user = $this->user->findOrFail($user);
        $user->delete();
        flash('Todos os dados ligados ao seu usuário foram removidos!')->error();
        return redirect()->route('home');
    }

    public function pdfProfile()
    {
        $user = auth()->user()->id;
        $user = $this->user->findOrFail($user);
        $pdf = PDF::loadView('pdf.user.profile', compact('user'));
        return $pdf->setPaper('a4')->stream('my-profile.pdf');
    }

    public function pdfOrders()
    {
        $userOrders = auth()->user()->orders()->get();
        $pdf = PDF::loadView('pdf.user.my-orders', compact('userOrders'));
        return $pdf->setPaper('a4', 'landscape')->stream('my-orders.pdf');

    }
}
