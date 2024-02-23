<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Mail;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;



class StudentController extends Controller
{

    public $buttons;
    public $section;
    public function __construct()
    {
        // $this->buttons = '';
        $this->buttons .= '<a href="' . route("admin.view.all.students") . '" class="btn btn-sm btn-success">VIEW ALL STUDENTS</a> &nbsp;';
        // $this->buttons .= '<a href="' . route("banners.create") . '" class="btn btn-sm btn-primary">ADD NEW</a> &nbsp;';
        // $this->buttons .= '<a href="' . route('banners.trash') . '" class="btn btn-sm btn-danger">TRASH</a>';
        $this->section = "Students";
    }


    public function index(Request $request)
    {
        $adminRole = Role::where('name', 'admin')->first();
        $data['students'] = Student::where('is_active', 1)->get();
        $data['users'] =  User::whereDoesntHave('roles', function ($query) use ($adminRole) {
            $query->where('id', $adminRole->id);
        })->whereNull('deleted_at')
            ->get();
        $data['page_title'] = 'students';
        $data['section'] = 'All students';
        $data['shortcut_buttons'] = $this->buttons;
        return view('backend.students.index', $data);
    }


    public function allStudents(Request $request)
    {
        if ($request->ajax()) {
            $data = Student:: all();
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     $user = Auth::user();
                //     $btn =  '<a href="' . route('users.edit', $row->id) . '" target="_blank"><i title="Edit" class="fas fa-edit font-size-16"></i></a>';
                //     $btn .= '<a href="javascript:void(0);" onclick="trashRecord(' . $row->id . ')" class="text-danger remove" data-id="' . $row->id . '"><i title="Delete" class="fas fa-trash-alt font-size-16"></i></a>';
                //     $btn = $btn ?: '-';


                //     return $btn;
                // })
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
       
                ->rawColumns([ 'name', 'email', 'is_active', 'created_at', 'updated'])
                ->make(true);
        }

        $data['students'] = Student::all();
        $data['page_title'] = 'students';
        $data['section'] = 'All students';
        $data['shortcut_buttons'] = "<a href = ".route('admin.all.students')."><button class= 'btn btn-primary btn-sm'> Back </button><a>";
        return view('backend.students.all', $data);
    }



    public function findStudents(Request $request)
    {
        $request->validate(['user' => 'required', 'dates' => 'required']);
        $date = explode(',', $request->dates);
        // dd($request->dates);
        // dd($date);
        $data['students'] = Student::all();
        $course = Course::where('start_date', trim($date[0]))->where('user_id', $request->user)->where('end_date', trim($date[1]))->first();

        if (!empty($course)) {
            $studentCourses  = Student::where('course_id', $course->id)->get();
            // dd($studentCourses);
            $data['courseStudents'] = $studentCourses;
        } else {
            $data['message'] = "No Data Found";
            $data['type']    = "danger";
        }
        $adminRole = Role::where('name', 'admin')->first();

        $data['users'] =  User::whereDoesntHave('roles', function ($query) use ($adminRole) {
            $query->where('id', $adminRole->id);
        })->whereNull('deleted_at')
            ->get();
        $data['page_title'] = 'students';
        $data['section'] = 'All students';
        $data['shortcut_buttons'] = $this->buttons;

        return view('backend.students.index', $data);
    }


    public function updateStatus(Request $request)
    {
        $student = Student::findOrFail($request->id);
        $student->is_active = $request->is_active;

        if ($student->save()) {
            $request->is_active == '1' ? $alertType = 'success' : $alertType = 'info';
            $request->is_active == '1' ? $message = 'Record "' . $student->id . '" Activated Successfuly!' : $message = 'Record "' . $student->id . '" Deactivated Successfuly!';

            $notification = array(
                'message' => $message,
                'type' => $alertType,
                'icon' => 'mdi-check-all'
            );
        } else {
            $notification = array(
                'message' => 'Some Error Occured, Try Again!',
                'type' => 'error',
                'icon'  => 'mdi-block-helper'
            );
        }

        echo json_encode($notification);
    }


    public function addLocation(Request $request)
    {
        // dd($request->all());
        $studentIds = $request->students;
        // Make sure $studentIds is an array and not null before using it in the query\
        $dates = explode(',', $request->dates);
        // $start_date  = trim($dates[0]);
        // $end_date    = trim($dates[1]);
        if (is_array($studentIds)) {
             $locations[] =  $request->except(['_token', 'students']);
            $students = Student::whereIn('id', $studentIds)->get();
            foreach ($students as $key => $student) {
                Student::where('id', $student->id)->update(['event_address' => $request->event_address, 'location' => $request->location, 'event_city' => $request->city, 'event_state' => $request->state]);
                try {
                    Mail::send('emails.locationNotification', ['data' => $student, 'locations' => $locations, 'dates' => $student->courses->start_date .  $student->courses->end_date], function ($message) use ($student) {
                        $message->to($student['email'])->subject("Course Location");
                    });
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            // Perform any other actions with the $students collection as needed
        }
        return redirect()->back()->with(['message' => 'location assigned to users', 'type' => 'success']);
    }



    public function changeCourseDates(Request $request)
    {
        // dd($request->all());
        $studentIds = $request->studentsCourse;
        // Make sure $studentIds is an array and not null before using it in the query\
        $dates = explode(',', $request->dates);
        $start_date  = trim($dates[0]);
        $end_date    = trim($dates[1]);
        if (is_array($studentIds)) {
            $students = Student::whereIn('id', $studentIds)->get();
            foreach ($students as $key => $student) {
                Student::where('id', $student->id)->update(['class_start_date' => $start_date, 'class_end_date' => $end_date]);
                try {
                    Mail::send('emails.courseChangeLocation', ['data' => $student, 'dates' => $request->dates], function ($message) use ($student) {
                        $message->to($student['email'])->subject("Class dates Changes alert");
                    });
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }

            // Perform any other actions with the $students collection as needed
        }
        return redirect()->back()->with(['message' => 'location assigned to users', 'type' => 'success']);
    }
}
