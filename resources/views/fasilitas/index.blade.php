@extends('template.master')

@section('konten')


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
<div class="card shadow mb-4">
    <div class="card-header py-3">

        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#fasilitasModal">Tambah</button> -->
        <!-- MODAL TAMBAH RUANGAN -->
        <!-- <div class="modal fade" id="fasilitasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5" id="exampleModalLabel">Tambah Fasilitas</h2>
                    </div>
                    <div class="modal-body">
                        <form action="/fasilitas" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nama Fasilitas:</label>
                                <input type="text" name="nama_fasilitas" required class="form-control" id="recipient-name">
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div> -->
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 10%;">No</th>
                        <th style="width: 80%;">Nama Fasilitas</th>
                        <!-- <th style="width: 10%;">Action</th> -->
                    </tr>
                </thead>

                <tbody>
                    @foreach($datafasilitas as $datas)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$datas->nama_fasilitas}}</td>
                        <!-- <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#fasilitasModal{{$datas->id}}">Edit</button>
                                <div class="modal fade" id="fasilitasModal{{$datas->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title fs-5" id="exampleModalLabel">Edit Fasilitas</h2>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/fasilitas/{{$datas->id}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Nama Ruangan:</label>
                                                        <input type="text" name="nama_fasilitas" value="{{$datas->nama_fasilitas}}" required class="form-control" id="recipient-name">
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
                                <form action="/fasilitas/{{$datas->id}}" method="post">

                                    @csrf
                                    @method('DELETE')
                                <button class="btn btn-danger ml-2"  onclick="return confirm('Apakah anda yakin??')">Delete</button>

                                </form>
                               
                            </div>
                        </td> -->

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection