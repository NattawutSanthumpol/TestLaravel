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
                        <div class="card-header">แบบฟอร์มแก้ไขข้อมูลแผนก</div>
                        <div class="card-body">
                            <form action="{{url('/department/update/'.$dep_id->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">ชื่อแผนก</label>
                                    <input type="text" name="department_name" class="form-control" value="{{$dep_id->department_name}}">
                                </div>
                                @error('department_name')
                                <div class="alert alert-danger">
                                    <span>{{$message}}</span>
                                </div>
                                @enderror
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
