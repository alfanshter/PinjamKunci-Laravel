@extends('template.master')

@section('konten')


<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">KARTU RFID/RUANGAN</h1><br>

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
        <button type="button" class="btn btn-primary" id="updateMode">Ubah mode register</button>
    </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        @if(auth()->user()->role == 0)
                        <th>Uid</th>
                        @endif
                         <th>Kode</th>
                        <th>Fasilitas</th>
                        <th>Status</th>
                        @if(auth()->user()->role == 0)
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $datas)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        @if(auth()->user()->role == 0)
                        <td>{{$datas->uid}}</td>

                        @endif
                        <td>{{$datas->kode}}</td>
                        <td>
                            @if($datas->fasilitas->isEmpty())
                            Tidak ada fasilitas
                            @else
                            <ul>
                                @foreach($datas->fasilitas as $datafasilitas)
                                <li>{{ $datafasilitas->nama_fasilitas }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </td>
                        <td>@if($datas->status == 0)
                                Tidak Ready
                                @else
                                Ready
                                @endif

                        </td>
                        @if(auth()->user()->role == 0)
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-warning btn-block mx-1" style="max-height: 40px;max-width: 100px;" data-toggle="modal" data-target="#rfidModal{{$datas->id}}">Edit</button>
                                <!-- modal -->
                                <div class="modal fade" id="rfidModal{{$datas->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title fs-5" id="exampleModalLabel">Edit RFID</h2>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/rfid/{{$datas->id}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Kode:</label>
                                                        <input type="text" name="kode" value="{{$datas->kode}}" required class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Uid:</label>
                                                        <input type="text" name="uid" value="{{$datas->uid}}" required class="form-control" id="recipient-name" readonly>
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
                                <form action="/rfid/{{$datas->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block mx-1" style="max-height: 40px;max-width: 100px" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                                </form>

                                <!-- Dropdown Fasilitas -->
                                <form action="/fasilitasRfid" method="post">
                                    @csrf
                                    <input type="hidden" name="id_rfid" value="{{$datas->id}}">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-block ml-2 dropdown-toggle" style="max-height: 40px; max-width: 100px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Fasilitas
                                        </button>
                                        <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton">
                                            @foreach($fasilitas as $fasilitass)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="fasilitas[]" value="{{$fasilitass->id}}">
                                                <label class="form-check-label" for="fasilitas{{$fasilitass->id}}">
                                                    {{$fasilitass->nama_fasilitas}}
                                                </label>
                                            </div>
                                            @endforeach

                                            <div class="mt-2 text-center">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
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

<script src="{{ asset('jquery-3.7.1.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#updateMode').click(function(e) {
            e.preventDefault(); // Mencegah aksi default tombol

            $.ajax({
                url: '/api/moderfid', // URL endpoint untuk controller method Anda
                type: 'POST',
                data: {
                    mode: "register"
                },
                success: function(response) {
                    if (response.status == 1) {
                        $('#uid-input').val(response.status);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // Log error jika permintaan gagal
                }
            });
        });
    });
</script>