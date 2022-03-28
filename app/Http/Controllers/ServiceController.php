<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::paginate(10);
        return view('admin.service.index', compact('service'));
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'service_name' => 'required|max:255'
            ],
            [
                'service_name.required' => "กรุณาป้อนชื่อบริการ",
                'service_name.max' => "ห้ามเกิน 255 ตัวอักษร"
            ]
        );
        $service_image = $request->file('service_image');

        //อัพเดตภาพและชื่อ
        if ($service_image) {
            //Generate ชื่อภาพ
            $name_gen = hexdec(uniqid());

            //ดึงนามสกุลไฟล์ภาพ
            $img_ext = strtolower($service_image->getClientOriginalExtension());

            //รวมชื่อ+นามกสุลไฟล์ภาพ
            $img_name = $name_gen . '.' . $img_ext;

            // Upload and save image
            $upload_location = 'image/services/';
            $full_path = $upload_location . $img_name;

            // Update Data
            Service::find($id)->update([
                'service_name' => $request->service_name,
                'service_image' => $full_path
            ]);

            //ลบภาพเก่าและอัพภายใหม่แทนที่
            $old_image= $request->old_image;
            unlink($old_image);
            $service_image->move($upload_location, $img_name);

            return redirect()->route('service')->with('success', "อัพเดตชื่อและรูปภาพเรียบร้อย");
        } else {
            //อัพเดตชื่อ
            Service::find($id)->update([
                'service_name'=>$request->service_name
            ]);
            return redirect()->route('service')->with('success', "อัพเดตชื่อบริการเรียบร้อย");
        }

        // return redirect()->route('service')->with('success', "อัพเดตชื่อและรูปภาพเรียบร้อย");

    }

    public function delete($id)
    {
        //ลบรูปภาพ
        $img = Service::find($id)->service_image;
        unlink($img);
        
        //ลบข้อมูลจากฐานข้อมูล
        Service::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'service_name' => 'required|unique:services|max:255',
                'service_image' => 'required|mimes:png,jpg,jpeg'
            ],
            [
                'service_name.required' => "กรุณาป้อนชื่อบริการ",
                'service_name.max' => "ห้ามเกิน 255 ตัวอักษร",
                'service_name.uniqid' => "ชื่อบริการซ้ำ",
                'service_image.required' => "กรุณาใส่ภาพประกอบ",
                'service_image.mimes' => "UpFile เป็น PNG,JPG,JPEG เท่านั้น"
            ]
        );

        //การเข้ารหัสรูปภาพ
        $service_image = $request->file('service_image');

        //Generate ชื่อภาพ
        $name_gen = hexdec(uniqid());

        //ดึงนามสกุลไฟล์ภาพ
        $img_ext = strtolower($service_image->getClientOriginalExtension());

        //รวมชื่อ+นามกสุลไฟล์ภาพ
        $img_name = $name_gen . '.' . $img_ext;

        // Upload and save image
        $upload_location = 'image/services/';
        $full_path = $upload_location . $img_name;

        Service::insert([
            'service_name' => $request->service_name,
            'service_image' => $full_path,
            'created_at' => Carbon::now()
        ]);

        $service_image->move($upload_location, $img_name);
        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");
    }
}
