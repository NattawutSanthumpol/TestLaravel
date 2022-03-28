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
                        <div class="card-header">ตารางข้อมูลแผนก</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">รหัสแผนก</th>
                                        <th scope="col">ชื่อแผนก</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dep as $row)
                                    <tr>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->department_name}}</td>
                                        <td>{{$row->user->name}}</td>
                                        <td>
                                            @if($row->created_at == null)
                                                ไม่พบเวลา
                                            @else
                                                {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                            @endif
                                        </td>
                                        <td align="center">
                                            <a href="{{url('/department/edit/'.$row->id)}}" class="btn btn-info">แก้ไข</a>
                                        </td>
                                        <td align="center">
                                            <a href="{{url('/department/softdelete/'.$row->id)}}" class="btn btn-warning">ลบข้อมูล</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$dep->links()}}
                        </div>
                    </div>
                    @if (count($trashDep)>0)
                    <div class="card my-2">
                        <div class="card-header">ถังขยะ</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">รหัสแผนก</th>
                                        <th scope="col">ชื่อแผนก</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">กู้คืนข้อมูล</th>
                                        <th scope="col">ลบข้อมูลถาวร</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashDep as $row)
                                    <tr>
                                        <td>{{$trashDep->firstItem()+$loop->index}}</td>
                                        <td>{{$row->department_name}}</td>
                                        <td>{{$row->user->name}}</td>
                                        <td>
                                            @if($row->created_at == null)
                                                ไม่พบเวลา
                                            @else
                                                {{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}
                                            @endif
                                        </td>
                                        <td align="center">
                                            <a href="{{url('/department/restore/'.$row->id)}}" class="btn btn-info">กู้คืนข้อมูล</a>
                                        </td>
                                        <td align="center">
                                            <a href="{{url('/department/delete/'.$row->id)}}" class="btn btn-danger">ลบข้อมูลถาวร</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$trashDep->links()}}
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">แบบฟอร์ม</div>
                        <div class="card-body">
                            <form action="{{route('addDepartment')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">ชื่อแผนก</label>
                                    <input type="text" name="department_name" class="form-control">
                                </div>
                                @error('department_name')
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
