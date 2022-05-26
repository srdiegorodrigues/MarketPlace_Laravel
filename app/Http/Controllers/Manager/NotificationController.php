<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        return view('manager.notifications', compact('unreadNotifications'));
    }

    public function readAll()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        $unreadNotifications->each(function($notification){
            $notification->markAsRead();
        });

        flash('Todas as notificações foram marcadas como lidas!')->success();
        return redirect()->back();
    }

    public function read($notification)
    {
        $notification = auth()->user()->notifications()->find($notification);
        $notification->markAsRead();

        flash('Notificação marcada como lida!')->success();
        return redirect()->back();

        //dd($notification);
    }
}
