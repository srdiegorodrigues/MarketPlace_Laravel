<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;


class StoreController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create','store']);
        $this->middleware('user.has.one.store')->only(['edit','update']);
    }


    public function index()
    {
        $store = auth()->user()->store;

        return view('manager.stores.index', compact('store'));
    }

    public function create()
    {
        $users = \App\User::all(['id','name']);
        return view('manager.stores.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        if($user->role =="ROLE_OWNER" || $user->role =="ADMINISTRATOR"){
            if($request->hasFile('logo')){
                $data['logo'] = $this->imageUpload($request->file('logo'));
            }
            $store = $user->store()->create($data);
            flash('Loja Criada com sucesso')->success();
        }
        return redirect()->route('manager.stores.index');
    }

    public function edit($store)
    {
        $store = \App\Store::find($store);

        return view('manager.stores.edit',compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
        $data = $request->validated();
        $store = \App\Store::find($store);


        if ($request->hasFile('logo')) {
            if (Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }
            $data['logo'] = $this->imageUpload($request->file('logo'));

        }


        $store->update($data);

        if (auth()->user()->role === 'ROLE_OWNER') {
            flash('Os dados da loja '.$store->name.' foram atualizados com sucesso')->success();
            return redirect()->route('manager.stores.index');
        } else {
            flash('Os dados da loja '.$store->name.' foram atualizados com sucesso')->success();
            return redirect()->route('administrator.stores.list');
        }
    }


    public function remove($store)
    {
        $store = \App\Store::find($store);
        $name = $store['name'];
        $store->delete();
        flash('A loja '.$name. ' foi excluída com sucesso!')->error();
        return redirect()->back();

    }
}
