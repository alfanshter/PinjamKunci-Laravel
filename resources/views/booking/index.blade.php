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
        @if(auth()->user()->role == 0)
        <button class="btn btn-primary" data-toggle="modal" data-target="#bookingModal">Tambah</button>
        <!-- MODAL TAMBAH RUANGAN -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="exampleModalLabel">Tambah Ruangan</h2>
                    </div>
                    <div class="modal-body">
                        <form action="/booking" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <select class="form-control" name="id_user" id="">
                                    @foreach($datamahasiswa as $datas)
                                    <option value="{{$datas->id}}">{{$datas->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <select class="form-control" name="id_rfid" id="">
                                    @foreach($dataRfid as $dataRfids)
                                    <option value="{{$dataRfids->id}}">{{$dataRfids->kode}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Keterangan:</label>
                                <input type="text" name="keterangan" required class="form-control" id="recipient-name">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal-waktu" class="col-form-label">Waktu Mulai:</label>
                                <input type="datetime-local" name="waktu_mulai" required class="form-control" id="tanggal-waktu">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal-waktu" class="col-form-label">Waktu Selesai:</label>
                                <input type="datetime-local" name="waktu_selesai" required class="form-control" id="tanggal-waktu">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @elseif(auth()->user()->role == 1)
        <p>Daftar Booking <b style="color: black;">{{auth()->user()->name}} !</b></p>
        @endif


    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th>Ruangan</th>
                        <th>Nama Peminjam</th>
                        <th>Fasilitas</th>
                        <th>Keterangan</th>
                        <th>Tanggal Mulai</th>
                        @if(auth()->user()->role == 0)
                        <th>Action</th>
                        @endif
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
                        <td>{{$datas->keterangan}}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($datas->waktu_mulai)->format('d/m/Y H:i') }}
                            <b style="color: black;">-</b>
                            {{ \Carbon\Carbon::parse($datas->waktu_selesai)->format('d/m/Y H:i') }}
                        </td>
                        @if(auth()->user()->role == 0)
                        <td>
                            <div class="d-flex justify-content-center">
                                <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#bookingModal{{$datas->id}}">Edit</button> -->
                                <!-- modal untuk edit -->
                                <form action="/booking/{{$datas->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger ml-2" onclick="return confirm('Apakah anda yakin??')">Delete</button>
                                </form>

                                <form action="/bookingDone" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$datas->id}}">
                                    <input type="hidden" name="id_rfid" value="{{$datas->id_rfid}}">
                                    <button class="btn btn-primary ml-2" onclick="return confirm('Apakah anda yakin??')">Done</button>
                                </form>
                            </div>
                        </td>

                        @endif
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection