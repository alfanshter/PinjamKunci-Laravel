@extends('template.master')

@section('konten')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('failed'))
<div class="alert alert-danger">
    {{ session('failed') }}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">

    <b><p style="color: black;">Log Peminjaman</p> </b>      
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Ruangan</th>
                        <th>Nama Peminjam</th>
                        <th>Fasilitas</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($dataBooking as $datas)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$datas->rfid->kode}}</td>
                        <td>{{$datas->user->name}}</td>
                        <td>
                            @foreach($datas->rfid->fasilitas as $fasilitas)
                            <ul>
                                <li> {{$fasilitas->nama_fasilitas}}</li>
                            </ul>
                            @endforeach
                        </td>
                        <td>{{$datas->created_at}}</td>
                        <td>{{$datas->updated_at}}</td>
                        <td>@if($datas->status == 0)
                            Pinjam
                            @else
                            Selesai
                            @endif

                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection