<?php

namespace App\Http\Controllers;

use App\lops;
use App\teachers;
use Illuminate\Http\Request;

class nhanvienController extends Controller
{
    public function NhanVien(){
//        $teachers = teachers::select(["teacher_id",
//            "teacher_name","teacher_age","teacher_gender",""])
//
//        ->get();
        $teachers = teachers::orderBy("teacher_age","asc")->paginate(10);
        return view("nhanvien", compact("teachers"));
    }
    public function  NVCreate(){
        $lops = lops::where("active",1)->orderBy("lop_name","asc")
            ->select(["lop_id","lop_name"])->get();
        return view("AddNV",compact("lops"));
    }
    public function NVSave(Request $request){
            $this->validate($request, [
                "teacher_name" => "required|min:6|max:100",
                "teacher_age" => "required|numeric|min:1|max:100",
                "teacher_gender" => "required|min:4|max:10",
                "lop_id" => "required|numeric|min:1",
            ]);

        teachers::create([
            "teacher_name"=> $request->get("teacher_name"),
            "teacher_age"=> $request->get("teacher_age"),
            "teacher_gender"=> $request->get("teacher_gender"),
            "lop_id"=> $request->get("lop_id"),
        ])->save();
        return redirect("nhan-vien");
    }
    public function NVEdit(Request $request){
        $id = $request->get("teacher_id");
        $teacher = teachers::find($id);
        if($teacher){
            $lops = lops::where("active",1)->orderBy("lop_name","asc")
                ->select(["lop_id","lop_name"])->get();
            return view("EditNV",compact("teacher","lops"));
        }
        echo "không có giáo viên";

    }
    public function NVUpdate(Request $request)
    {
        $this->validate($request, [
            "teacher_name" => "required|min:6|max:100|unique:teachers,teacher_name,".$request->get("teacher_id") . ",teacher_id",
            "teacher_age" => "required|numeric|min:1|max:100",
            "teacher_gender" => "required|min:4|max:10",
            "lop_id" => "required|numeric|min:1",
        ]);

        $teacher = teachers::find($request->get("teacher_id"));
        if ($teacher) {
            $teacher->update([
                "teacher_name" => $request->get("teacher_name"),
                "teacher_age" => $request->get("teacher_age"),
                "teacher_gender" => $request->get("teacher_gender"),
                "lop_id" => $request->get("lop_id"),
            ]);
            return redirect("nhan-vien")->with("message", "Đã lưu thông tin");
        }
        return "Book not found";
    }

    public function NVDelete($teacher_id){
        $teacher = teachers::find($teacher_id);
        $teacher-> delete();
        return redirect("nhan-vien")->with("message","Đã xóa thành công");
    }

}
