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
                                <label for="recipient-name" class="col-form-label">Ruangan:</label>
                                <select class="form-control" name="id_ruangan" id="">
                                    @foreach($dataruangan as $datas)
                                    <option value="{{$datas->id}}">{{$datas->nama_ruangan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Fasilitas:</label>
                                <select class="form-control" name="id_fasilitas" id="">
                                    @foreach($dataFasilitas as $datas)
                                    <option value="{{$datas->id}}">{{$datas->nama_fasilitas}}</option>
                                    @endforeach
                                </select>
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
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 30%;">Fasilitas</th>
                        <th style="width:30%">Ruangan</th>
                        <th style="width: 20%;">User</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($dataBooking as $datas)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$datas->fasilitas->nama_fasilitas}}</td>
                        <td>{{$datas->ruangan->nama_ruangan}}</td>
                        <td>{{$datas->user->name}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#bookingModal{{$datas->id}}">Edit</button>
                                <div class="modal fade" id="bookingModal{{$datas->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title fs-5" id="exampleModalLabel">Edit</h2>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/booking/{{$datas->id}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                                        <select class="form-control" name="id_user" id="">
                                                            <option value="{{$datas->user->id}}">{{$datas->user->name}}</option>
                                                            @foreach($datamahasiswa as $datamahasiswas)
                                                            <option value="{{$datamahasiswas->id}}">{{$datamahasiswas->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Ruangan:</label>
                                                        <select class="form-control" name="id_ruangan" id="">
                                                            <option value="{{$datas->ruangan->id}}">{{$datas->ruangan->nama_ruangan}}</option>
                                                            @foreach($dataruangan as $dataruangans)
                                                            <option value="{{$dataruangans->id}}">{{$dataruangans->nama_ruangan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Fasilitas:</label>
                                                        <select class="form-control" name="id_fasilitas" id="">
                                                            <option value="{{$datas->fasilitas->id}}">{{$datas->fasilitas->nama_fasilitas}}</option>
                                                            @foreach($dataFasilitas as $dataFasilitass)
                                                            <option value="{{$dataFasilitass->id}}">{{$dataFasilitass->nama_fasilitas}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <form action="/booking/{{$datas->id}}" method="post">
                                @csrf
                                @method('DELETE')
                               <button class="btn btn-danger ml-2"   onclick="return confirm('Apakah anda yakin??')">Delete</button>
                               </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection