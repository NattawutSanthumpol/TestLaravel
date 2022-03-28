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
                    <div class="card">
                        <div class="card-header">แบบฟอร์มแก้ไขข้อมูลบริการ</div>
                        <div class="card-body">
                            <form action="{{url('/service/update/'.$service->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="service_name">ชื่อบริการ</label>
                                    <input type="text" name="service_name" class="form-control" value="{{$service->service_name}}">
                                </div>
                                @error('service_name')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label for="service_image">รูปภาพประกอบ</label>
                                    <input type="file" name="service_image" class="form-control" value="{{$service->service_image}}">
                                </div>
                                @error('service_image')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                                @enderror
                                <br>
                                <input type="hidden" name="old_image" value="{{$service->service_image}}">
                                <div class="form-group">
                                    <img src="{{asset($service->service_image)}}" width="150px">
                                </div>
                                <br>
                                <input type="submit" value="อัพเดต" class="btn btn-primary ">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
