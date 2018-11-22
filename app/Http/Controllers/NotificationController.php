<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
//        $user_ses = $_SESSION['admin_master'];
//        $user = AdminModel::find($user_ses->id);
        return view('notification.view_noti')->with(['Notifications' => Notification::GetNotification()]);
    }

    public function edit($id)
    {
        $notification = Notification::find($id);
        return view('notification.edit_noti')->with(['notification' => $notification]);
    }

    public function update($id, Request $request)
    {
        $ads = Notification::find($id);
        $ads->notification = request('notification');
        $ads->save();
        return redirect('notificn')->with('message', 'Notification has been updated...!');
    }

    public
    function destroy($id)
    {
        $Units = Notification::find($id);
        $Units->is_active = 0;
        $Units->save();
        return redirect('notificn')->with('message', 'Notification has been Inactivated...!');

    }

    public
    function active($id)
    {
        $Units = Notification::find($id);
        $Units->is_active = 1;
        $Units->save();
        return redirect('notificn')->with('message', 'Notification has been Activated...!');

    }
    //ALTER TABLE `users` ADD `is_show_notification` TINYINT NOT NULL DEFAULT '1' COMMENT '1-For show notification, 0-For hide' AFTER `is_block`;
}
