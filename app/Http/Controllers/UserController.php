<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::with('roles')->where('id', '<>', Auth::id())->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $user = Auth::user();
                    $btn =  '<a href="' . route('users.edit', $row->id) . '" target="_blank"><i title="Edit" class="fas fa-edit font-size-16"></i></a>';
                    $btn .= '<a href="javascript:void(0);" onclick="trashRecord(' . $row->id . ')" class="text-danger remove" data-id="' . $row->id . '"><i title="Delete" class="fas fa-trash-alt font-size-16"></i></a>';
                    $btn = $btn ?: '-';


                    return $btn;
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })
                ->addColumn('is_active', function ($row) {
                    $user = Auth::user();
                    if ($row->is_active == '0') {
                        $btn0 = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="user_status" switch="bool" data-id="' . $row->id . '" value="1"/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                        return $btn0;
                    } elseif ($row->is_active == '1') {

                        $btn1 = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="user_status" switch="bool" data-id="' . $row->id . '" value="0" checked/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                        return $btn1;
                    }
                    return '-';
                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        $image = '<img src=' . asset('assets/frontend/images/users/' . $row->image) . ' class="avatar-sm" />';
                    } else {
                        $image = '<img src=' . asset('assets/backend/images/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })
                ->addColumn('updated', function ($row) {
                    if (isset($row->updated_at)) {
                        return date('d-M-Y', strtotime($row->updated_at));
                    } else {
                        return  '-';
                    }
                })
                ->addColumn('name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('permissions', function ($row) {
                })
                ->rawColumns(['action', 'created_at', 'is_active', 'image',  'updated', 'name', 'email', 'permissions'])
                ->make(true);
        }

        $user = Auth::user();
        $buttons = '';
        $buttons .= '<a href="' . route("users.index") . '" class="btn btn-sm btn-success">ALL Users</a> &nbsp;';
        $buttons .= '<a href="' . route("users.create") . '" class="btn btn-sm btn-primary">ADD NEW</a> &nbsp;';
        $buttons .= '<a href="#" class="btn btn-sm btn-danger">TRASH</a>';
        $data['shortcut_buttons'] = $buttons;
        $data['section'] = 'Users';
        $data['page_title'] = 'All Users';

        return view('backend.users.index', $data);
    }

    public function create()
    {
        $user = Auth::user();
        $buttons = '';
        $user = Auth::user();
        $buttons .= '<a href="' . route("users.index") . '" class="btn btn-sm btn-success">ALL Users</a> &nbsp;';
        $buttons .= '<a href="' . route("users.trash") . '" class="btn btn-sm btn-danger">TRASH</a>&nbsp;&nbsp;';
        $buttons .= '<a href="' . route("users.index") . '" class="btn btn-sm btn-primary">Back</a>';
        $data['shortcut_buttons'] = $buttons;
        $data['page_title'] = 'Add New User';
        $data['section'] = 'Users';
        $data['roles'] = Role::pluck('name', 'name')->all();
        return view('backend.users.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required',
            'roles'      => 'required'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            $user->assignRole($request->roles);
            $data['type'] = "success";
            $data['message'] = "User Added Successfuly!.";
            $data['icon'] = 'mdi-check-all';

            return redirect()->route('users.index')->with($data);
        } else {
            $data['type'] = "danger";
            $data['message'] = "Failed to Add User, please try again.";
            $data['icon'] = 'mdi-block-helper';

            return redirect()->route('users.index')->withInput()->with($data);
        }
    }

    public function show(User $category)
    {
        abort(404);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $data['user'] = User::find($id);
        $data['roles'] = Role::pluck('name', 'name')->all();
        $data['userRole'] = $data['user']->roles->pluck('name', 'name')->all();

        $buttons  = '';
        $buttons .= '<a href="' . route("users.index") . '" class="btn btn-sm btn-success">ALL Users</a> &nbsp;';
        $buttons .= '<a href="' . route("users.index") . '" class="btn btn-sm btn-success">View All</a> &nbsp;';
        $buttons .= '<a href="' . route("users.trash") . '" class="btn btn-sm btn-danger">TRASH</a>';
        $buttons .= '<a href="' . route("users.index") . '" class="btn btn-sm btn-primary">Back</a>';
        $data['shortcut_buttons'] = $buttons;
        $data['page_title'] = "Edit & Update Users";

        return view('backend.users.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'  => 'required|max:125',
            'email'       => 'required|email|unique:users,email,' . $id,
            'image'       => 'image|mimes:jpg,jpeg,png',
            'phone'       => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:11'

        ]);

        $data = User::findOrFail($id);
        $data->first_name = $request->first_name;
        $data->last_name  = $request->last_name;
        $data->email      = $request->email;
        $data->phone      = $request->phone;

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|max:1024'
            ]);

            $image = $request->file('image');

            if ($image->move('assets/frontend/images/users/', $image->getClientOriginalName())) {
                $data->image = $image->getClientOriginalName();
            }
        }

        if ($data->save()) {
            DB::table('model_has_roles')
                ->where('model_id', $id)
                ->delete();

            $data->assignRole($request->roles);
            $res['type'] = "success";
            $res['message'] = "User Id '" . $id . "' Updated Successfuly!.";
            $res['icon'] = 'mdi-check-all';
            return redirect()->route('users.index')->with($res);
        } else {
            $res['type'] = "danger";
            $res['message'] = "Failed to update User id '" . $id . "', please try again.";
            $res['icon'] = 'mdi-block-helper';

            return redirect()->route('users.edit', $id)->withInput()->with($res);
        }
    }

    public function destroy($id)
    {
        $object = User::find($id);
        if ($object) {
            $object->delete();
            $notification['type'] = "success";
            $notification['message'] = "Record id '" . $object->id . "' Moved to Trash Successfuly!.";
            $notification['icon'] = 'mdi-check-all';

            echo json_encode($notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Remove Record, please try again.";
            $notification['icon'] = 'mdi-block-helper';

            echo json_encode($notification);
        }
    }

    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $data = User::onlyTrashed()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn  = '<a href="javascript:void(0);" onClick="restoreRecord(' . $row->id . ')"><i title="Restore" class="fas fa-trash-restore-alt font-size-18"></i></a>&nbsp;&nbsp;';
                    $btn  .= '<a href="javascript:void(0);" class="text-danger" onClick="forceDelete(' . $row->id . ')"><i title="Delete Permanently" class="fas fa-trash-alt font-size-18"></i></a>';

                    return $btn;
                })
                ->addColumn('name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('deleted', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at));
                })
                ->rawColumns(['action', 'deleted', 'name'])
                ->make(true);
        }

        $buttons = '';
        $buttons   .= '<a href="' . route("users.index") . '" class="btn btn-sm btn-success">ALL Users</a> &nbsp;';
        $buttons   .= '<a href="' . route("users.index") . '" class="btn btn-sm btn-success">View All</a> &nbsp;';
        $buttons   .= '<a href="' . route("users.trash") . '" class="btn btn-sm btn-danger">TRASH</a>';
        $buttons   .= '<a href="'   . route("users.index") . '" class="btn btn-sm btn-primary">Back</a>';
        $data['shortcut_buttons'] = $buttons;
        $data['section'] = "Trashed Users";
        $data['page_title'] = 'Trashed Users';

        return view('backend.users.trash', $data);
    }

    public function restore(Request $request)
    {
        $user = User::withTrashed()->find($request->id);
        if ($user) {
            $user->restore();
            $notification['type'] = "success";
            $notification['message'] = "Record id '" . $user->id . "' Restored Successfuly!.";
            $notification['icon'] = 'mdi-check-all';

            echo json_encode($notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Restore Record, please try again.";
            $notification['icon'] = 'mdi-block-helper';

            echo json_encode($notification);
        }
    }


    public function forceDelete($id)
    {
        if (User::where('id', $id)->forceDelete()) {
            $notification = array(
                'message' => "User with ID ( $id ) Deleted permanently .",
                'type'    => "success",
                'icon'    => 'mdi-check-all'
            );
        } else {
            $notification = array(
                'message' => "Failed to delete User with ID ( $id ) please try again later .",
                'type'    => "danger",
                'icon'    => 'mdi-check-all'
            );
        }

        echo json_encode($notification);
    }



    public function updateStatus(Request $request)
    {
        $page = User::findOrFail($request->id);
        $page->is_active = $request->is_active;

        if ($page->save()) {
            $request->is_active == '1' ? $alertType = 'success' : $alertType = 'info';
            $request->is_active == '1' ? $message = 'Record "' . $page->id . '" Activated Successfuly!' : $message = 'Record "' . $page->id . '" Deactivated Successfuly!';

            $notification = array(
                'message' => $message,
                'type'    => $alertType,
                'icon'    => 'mdi-check-all'
            );
        } else {
            $notification = array(
                'message' => 'Some Error Occured, Try Again!',
                'type'    => 'error',
                'icon'    => 'mdi-block-helper'
            );
        }

        echo json_encode($notification);
    }
}
