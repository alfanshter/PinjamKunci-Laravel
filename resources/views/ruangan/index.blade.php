@extends('template.master')

@section('konten')


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ruangan</h1><br>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('berhasil'))
<div class="alert alert-success">
    {{ session('berhasil') }}
</div>
@endif


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        @if(auth()->user()->role == 0)
        <button class="btn btn-primary" data-toggle="modal" data-target="#ruanganModal">Tambah</button>
        <!-- MODAL TAMBAH RUANGAN -->
        <div class="modal fade" id="ruanganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="exampleModalLabel">Tambah Ruangan</h2>
                    </div>
                    <div class="modal-body">
                        <form action="/ruangan" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nama Ruangan:</label>
                                <input type="text" name="nama_ruangan" required class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Status:</label>
                                <input type="text" name="status" required class="form-control" id="recipient-name">
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
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 40%;">Nama Ruangan</th>
                        <th style="width: 40%">Status</th>
                        @if(auth()->user()->role == 0)
                        <th style="width: 10%;">Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach($dataruangan as $datas)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$datas->nama_ruangan}}</td>
                        <td>{{$datas->status}}</td>
                        @if(auth()->user()->role == 0)
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#ruanganModal{{$datas->id}}">Edit</button>
                                <!-- modal -->
                                <div class="modal fade" id="ruanganModal{{$datas->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title fs-5" id="exampleModalLabel">Edit Ruangan</h2>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/ruangan/{{$datas->id}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Nama Ruangan:</label>
                                                        <input type="text" name="nama_ruangan" value="{{$datas->nama_ruangan}}" required class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Status:</label>
                                                        <input type="text" name="status" value="{{$datas->status}}" required class="form-control" id="recipient-name">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->
                                <form action="/ruangan/{{$datas->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ml-2" onclick="return confirm('Apakah anda yakin??')">Delete</button>

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