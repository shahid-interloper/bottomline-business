<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

use Carbon\Carbon;

class NotificationController extends Controller
{
    public $count;

    public function __construct()
    {
        $this->count = 1;
    }

    public function allNotifications(Request $request)
    {
        if ($request->ajax()) {
            $data = Auth::user()->notifications;
            return DataTables::of($data)
                ->addColumn('serialNo', function ($row) {
                    return $this->count++;
                })
       
           
                ->addColumn('created_at', function ($row) {
                    if (!isset($row->created_at)) {
                        $date = '';
                    } else {
                        $date = date('d-M-Y', strtotime($row->created_at)) . "<br /><label class='text-primary'>" . Carbon::parse($row->created_at)->diffForHumans() . "</label>";
                    }
                    return $date;
                })
                ->addColumn('read_at', function ($row) {
                    if (isset($row->read_at)) {
                        $date = date('d-M-Y', strtotime($row->read_at)) . "<br /><label class='text-primary'>" . Carbon::parse($row->read_at)->diffForHumans() . "</label>";
                    } else {
                        $date = "<label class='text-danger'>UNREAD</label>";
                    }
                    return $date;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" data-id="' . $row->id . '" class="btn btn-primary btn-sm mb-1 read-notification" data-bs-toggle="modal" data-bs-target="#read-notification">Read</a>';
                    return $btn;
                })
                ->rawColumns(['serialNo', 'action', 'data', 'created_at', 'read_at'])
                ->make(true);
        }

        return view('backend.notifications');
    }

    public function readNotification(Request $request)
    {
        $notification = Auth::user()->notifications->where('id', $request->id)->first();
        if ($notification) {
            $notification->markAsRead();
            $data['type'] = "success";

            $details = '';

            if($notification->data['reason'] == "contact")
            {
                $details .= Str::replace('\r', ' ', Str::replace('\n', '<br />', $notification->data['data']['message']));
            }
            else
            {
                $details .= '<i class="text-primary">Serial No#: </i>' . $notification->data['data']['serial_number'];
                $details .= '<br /><i class="text-primary">Name: </i>' . $notification->data['data']['name'];
                $details .= '<br /><i class="text-primary">Website: </i><a target="_blank" href="' . $notification->data['data']['website'] . '">' . $notification->data['data']['website'] . '</a>';
                $details .= '<br /><i class="text-primary">Establishment Date: </i>' . $notification->data['data']['establishment_date'];
                $details .= '<br /><i class="text-primary">Company Size: </i>' . $notification->data['data']['company_size'];
                $details .= '<br /><i class="text-primary">Status: </i>' . Status::where('id', json_decode($notification->data['data']['status_id']))->first()->title;
                $details .= '<br /><i class="text-primary">Description: </i>' . json_decode($notification->data['data']['description']);
            }

            $data['detail'] = $details;
            $data['unread'] = Auth::user()->unreadNotifications->count();
            return json_encode($data);
        } else {
            $data['type'] = "error";
            $data['message'] = "Some error occured, please try again";
            return json_encode($data);
        }
    }

    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->route('general.all.notifications');
    }
}
