<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use PDF;

class AdminUserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('access.control.administrator')->only(['listUsers','userEdit','userUpdate','userDestroy']);

    }

    public function listUsers()
    {
        //utilizar o comando withTrashed()->get(); para listar os usuários que não foram excluídos

        /*$users = $this->user->withTrashed()->get();*/

        $users = $this->user->orderBy('name', 'ASC')->paginate(20);

        return view('administrator.users', compact('users'));

    }

    public function profileUser($user)
    {
        $user = $this->user->find($user);
        return view('user.my-profile', compact('user'));

    }

    public function userRemove($user)
    {
        $user = $this->user->find($user);
        $name = $user['name'];
        $user->delete();
        flash('Todos os dados ligados ao usuário '.$name.' foram removidos!')->error();
        return redirect()->route('administrator.users.list');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $users = $this->user->search($request->filter);
        return view('administrator.users', compact('users','filters'));

    }

    public function pdfUsers()
    {
        $users = $this->user->get();

        /*dd($users);*/
        $pdf = PDF::loadView('pdf.administrator.users', compact('users'));
        return $pdf->setPaper('a4','landscape')->stream('report-users.pdf');

    }

    /*public function listUserRemoved(){

        //utilizado para listar os dados excluidos logicamente pelo método SoftDelete
        $user = User::onlyTrashed()->get();
    }
    public function restoreUser($id){
        //utilizado para restaurar os dados excluidos logicamente pelo método SoftDelete
        User::withoutTrashed()->findOrFail($id)->restore();
    }

    public function deletedUser($id){
        //utilizado para deletar do banco os dados excluidos logicamente
        User::withoutTrashed()->findOrFail($id)->forceDelete();
    }

    */


}



