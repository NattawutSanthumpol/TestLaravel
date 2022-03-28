<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        //แสดงข้อมูลโดยดึงจาก Model
        // $dep = Department::all();
        $dep = Department::paginate(10);

        //แสดงข้อมูลโดยดึงจาก DB::table
        //ใช้ softdelete ไม่ได้
        // $dep = DB::table('departments')->paginate(3);
        // $dep = DB::table('departments')->get();
        // $dep = DB::table('departments')
        // ->join('users','departments.user_id','users.id')
        // ->select('departments.*','users.name')
        // ->paginate(3);

        //แสดงข้อมูลที่ถูกลบโดย SoftDelete ข้อมูลไม่ได้หายไปจริง
        $trashDep = Department::onlyTrashed()->paginate(5);

        return view('admin.department.index',compact('dep','trashDep'));
    }
    public function store(Request $request){
        $request->validate([
            'department_name'=>'required|unique:departments|max:100'
        ],
        [
            'department_name.required'=>"กรุณาป้อนชื่อแผนก",
            'department_name.max' => "ห้ามเกิน 100 ตัวอักษร",
            'department_name.unique' => "ชื่อแผนกซ้ำ"

        ]);
        //บันทึกข้อมูล
        $data = array();
        $data["department_name"] = $request->department_name;
        $data['user_id'] = Auth::user()->id;

        //query builder
        DB::table('departments')->insert($data);
        // $department = new Department;
        // $department->department_name = $request->department_name;
        // $department->user_id = Auth::user()->id;
        // $department->save();
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
        //ดูสิ่งที่ส่งมา
        // dd($request->department_name);
    }

    // ทำงานเมื่อกดปุ่มแก้ไข แล้วส่งข้อมูลไปยังหน้า edit
    public function edit($id){
        $dep_id = Department::find($id);
        return view('admin.department.edit',compact('dep_id'));
    }

    // ทำการ Update ข้อมูล
    public function update(Request $request,$id){
        //ตรวจสอบข้อมูล
        $request->validate([
            'department_name'=>'required|unique:departments|max:100'
        ],
        [
            'department_name.required'=>"กรุณาป้อนชื่อแผนก",
            'department_name.max' => "ห้ามเกิน 100 ตัวอักษร",
            'department_name.unique' => "ชื่อแผนกซ้ำ"

        ]);

        $dep_update = Department::find($id)->update([
            'department_name'=>$request->department_name,
            'user_id'=>Auth::user()->id
        ]);

        return redirect()->route('department')->with('success',"อัพเดตข้อมูลเรียบร้อย");

    }

    // ลบข้อมูลแบบ SoftDelete โดยข้อมูลจะไปอยู่ในถังขยะ ไม่ได้ลบจริง ไม่ได้ลบจากฐานข้อมูล
    public function softdelete($id){
        $dep_Sdelete = Department::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }

    // เรียกคืนข้อมูลที่อยู่ในถังขยะ
    public function restore($id){
        $dep_restore = Department::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success',"กู้คืนข้อมูลเรียบร้อย");
    }

    // ลบข้อมูลในถังขยะออก ลบออกจากฐานข้อมูล
    public function delete($id){
        Department::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success',"ลบข้อมูลถาวรเรียบร้อย");
    }

}
