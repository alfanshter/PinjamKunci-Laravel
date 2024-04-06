@extends('template.master')

@section('konten')

<div class="card shadow mb-4">
    <div class="card-header py-3">


    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 45%;">Name</th>
                        <th style="width:45%">email</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach($datamahasiswa as $datas)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$datas->name}}</td>
                        <td>{{$datas->email}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection