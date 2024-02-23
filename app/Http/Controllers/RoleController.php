<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(auth()->user()->can('role-list'), redirect()->route('user.dashboard')->with(['error' => 'You do not have permission to view Roles!']));


        if ($request->ajax()) {
            $data = Role::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $user = Auth::user();
                    $btn = ($user->hasPermissionTo('edit-role')  ? '<a href="' . route('roles.edit', $row->id) . '" target="_blank"><i title="Edit" class="fas fa-edit font-size-16"></i></a>&nbsp;&nbsp;' : '')
                        . ($user->hasPermissionTo('delete-role') ? '<a href="javascript:void(0);" onclick="trashRecord(' . $row->id . ')" class="text-danger remove" data-id="' . $row->id . '"><i title="Delete" class="fas fa-trash-alt font-size-16"></i></a>' : '');
                    $btn = $btn ?: '-';

                    return $btn;
                })
                ->addColumn('permissions', function ($row) {

                    $permission = '';
                    foreach ($row->permissions->pluck('name') as $permissionName) {
                        $permission .= '<span class="badge bg-info px-2 py-2 fs-6 text mb-2">' . Str::of($permissionName)->replace('-', ' ') . '</span> ';
                    }
                    return $permission;
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })
                ->rawColumns(['action', 'created_at', 'permissions'])
                ->make(true);
        }
        $user = Auth::user();

        $buttons = '';
        $user->hasPermissionTo('role-list')   ?  $buttons .= '<a href="' . route("roles.index") . '" class="btn btn-sm btn-success">ALL ROLES</a> &nbsp;' : '';
        $user->hasPermissionTo('add-role')    ?  $buttons .= '<a href="' . route("roles.create") . '" class="btn btn-sm btn-primary">ADD NEW</a> &nbsp;' : '';
        // $user->hasPermissionTo('view-product-trash')  ?  $buttons .= '<a href="' . route("roles.trash") . '" class="btn btn-sm btn-danger">TRASH</a>' : '';
        $data['shortcut_buttons'] = $buttons;
        $data['page_title'] = "All Roles";

        return view('backend.roles.all', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->hasPermissionTo('add-role')) {
            $data['permissions'] = Permission::get();
            $user = Auth::user();
            $buttons = '';
            $user->hasPermissionTo('role-list')    ?  $buttons .= '<a href="' . route("roles.index") . '" class="btn btn-sm btn-success">ALL ROLES</a> &nbsp;' : '';
            $user->hasPermissionTo('add-role')     ?  $buttons .= '<a href="' . route("roles.create") . '" class="btn btn-sm btn-primary">ADD NEW</a> &nbsp;' : '';
            // $user->hasPermissionTo('delete-role')  ?  $buttons .= '<a href="' . route("roles.trash") . '" class="btn btn-sm btn-danger">TRASH</a>' : '';
            $data['shortcut_buttons'] = $buttons;
            $data['shortcut_buttons'] = $buttons;
            $data['page_title'] = "Add New Role";

            return view('backend.roles.add', $data);
        }
        return redirect()->route('user.dashboard')->with(['error' => 'You do not have permission to add new role !..']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:roles|max:124',
            'permissions' => 'required',
        ], [
            'permissions.required' => 'please select some permissions'
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = "web";
        if ($role->save()) {
            $role->syncPermissions($request->permissions);
            $data['type'] = "success";
            $data['message'] = "Role Added Successfuly!.";
            $data['icon'] = 'mdi-check-all';

            return redirect()->route('roles.index')->with($data);
        } else {
            $data['type'] = "danger";
            $data['message'] = "Failed to Add Role, please try again.";
            $data['icon'] = 'mdi-block-helper';

            return redirect()->route('roles.create')->withInput()->with($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->hasPermissionTo('edit-role')) {
            $data['permissions'] = Permission::get();
            $data['rolePermissions'] = DB::table('role_has_permissions')
                ->where('role_has_permissions.role_id', $id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all();

            $user = Auth::user();
            $buttons = '';
            $user->hasPermissionTo('role-list')  ? $buttons .= '<a href="' . route("roles.index") . '" class="btn btn-sm btn-success">ALL ROLES</a> &nbsp;' : '';
            $user->hasPermissionTo('add-role')   ? $buttons .= '<a href="' . route("roles.create") . '" class="btn btn-sm btn-primary">ADD NEW</a> &nbsp;' : '';
            $data['shortcut_buttons'] = $buttons;

            $data['shortcut_buttons'] = $buttons;
            $data['page_title'] = "Edit & Update Role";
            $data['role'] = Role::find($id);

            return view('backend.roles.edit', $data);
        }
        return redirect()->route('user.dashboard')->with(['error' => 'You do not have permission to edit role !..']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }

        $request->validate([
            'permissions' => 'required'
        ], [
            'permissions.required' => 'please select some permissions'
        ]);

        if ($role->save()) {
            $role->syncPermissions($request->permissions);

            $data['type'] = "success";
            $data['message'] = "Role Updated Successfuly!.";
            $data['icon'] = 'mdi-check-all';

            return redirect()->route('roles.index')->with($data);
        } else {
            $data['type'] = "danger";
            $data['message'] = "Failed to Update Role, please try again.";
            $data['icon'] = 'mdi-block-helper';

            return redirect()->route('roles.edit', $id)->withInput()->with($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            $notification['type'] = "success";
            $notification['message'] = "Role Moved to Trash Successfuly!.";
            $notification['icon'] = 'mdi-check-all';
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Remove Role, please try again.";
            $notification['icon'] = 'mdi-block-helper';
        }
        return response($notification);
    }

    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::onlyTrashed()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0);" class="text-primary restore" data-id="' . $row->id . '"><i title="Restore" class="fas fa-trash-restore-alt font-size-18"></i></a>';
                    return $btn;
                })
                ->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })
                ->rawColumns(['action', 'deleted_at'])
                ->make(true);
        }
        $user = Auth::user();
        $buttons = '';
        $user->hasPermissionTo('role-list')   ?  $buttons .= '<a href="' . route("roles.index")   . '" class="btn btn-sm btn-success">ALL ROLES</a> &nbsp;' : '';
        $user->hasPermissionTo('add-role') ?  $buttons .= '<a href="' . route("roles.create")     . '" class="btn btn-sm btn-primary">ADD NEW</a> &nbsp;' : '';
        $user->hasPermissionTo('view-product-trash') ?  $buttons .= '<a href="' . route("roles.trash") . '" class="btn btn-sm btn-danger">TRASH</a>' : '';
        $data['shortcut_buttons'] = $buttons;

        $data['shortcut_buttons'] = $buttons;
        $data['page_title'] = "Trash Roles";

        return view('backend.roles.trash', $data);
    }

    public function restoreRole(Request $request)
    {
        $role = Role::withTrashed()->find($request->id);
        if ($role) {
            $role->restore();
            $notification['type'] = "success";
            $notification['message'] = "Role Restored Successfuly!.";
            $notification['icon'] = 'mdi-check-all';

            echo json_encode($notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Restore Role, please try again.";
            $notification['icon'] = 'mdi-block-helper';

            echo json_encode($notification);
        }
    }
}
