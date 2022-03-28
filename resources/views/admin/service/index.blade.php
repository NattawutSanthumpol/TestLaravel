<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            ยินดีตอนรับ {{Auth::user()->name}}

        </h2>

    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="row">
                <div class="col-md-8">
                    @if (session("success"))
                        <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">ตารางข้อมูลบริการ</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ภาพประกอบ</th>
                                        <th scope="col">ชื่อบริการ</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service as $row)
                                    <tr>
                                        <td>{{$service->firstItem()+$loop->index}}</td>
                                        <td align="center"><img src="{{asset($row->service_image)}}" width="150px"></td>
                                        <td>{{$row->service_name}}</td>
                                        <td>
                                            @if($row->created_at == null)
                                                ไม่พบเวลา
                                            @else
                                                {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                            @endif
                                        </td>
                                        <td align="center">
                                            <a href="{{url('/service/edit/'.$row->id)}}" class="btn btn-info">แก้ไข</a>
                                        </td>
                                        <td align="center">
                                            <a href="{{url('/service/delete/'.$row->id)}}" class="btn btn-warning" onclick="return confirm('คุณต้องการลบข้อมูลบริการนี้หรือไหม?')">ลบข้อมูล</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{//$service->links()}} --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">แบบฟอร์ม</div>
                        <div class="card-body">
                            <form action="{{route('addService')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="service_name">ชื่อบริการ</label>
                                    <input type="text" name="service_name" class="form-control">
                                </div>
                                @error('service_name')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label for="service_image">รูปภาพประกอบ</label>
                                    <input type="file" name="service_image" class="form-control">
                                </div>
                                @error('service_image')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                                @enderror
                                <br>
                                <input type="submit" value="บันทึก" class="btn btn-primary ">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
