<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            ยินดีตอนรับ {{Auth::user()->name}}

            <b class="float-end">จำนวนผู้ใช้งานระบบ {{count($user)}} คน</b>

        </h2>

    </x-slot>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="row">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>อีเมล</th>
                            <th>เข้าสู่ระบบ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach ($user as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            {{-- <td>{{$row->created_at->diffForHumans()}}</td> --}}
                            <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{$user}}
                <x-jet-welcome />
            </div>
        </div> --}}
    </div>
</x-app-layout>
