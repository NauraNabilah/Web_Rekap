@extends('layouts.template')
@section('content')
    <form action="{{ route('late.store') }}" method="POST" class="card p-5" enctype="multipart/form-data">
        @csrf
        {{-- @csrf harus ada jika memakai method POST untuk kepentingan security website  --}}

        @if (Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }}</div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h1 class="display-4">
           Tambah Data Keterlambatan
        </h1>
        <hr class="my-4">
        <p>Home/ Data Keterlambatan / <b>Tambah Data Keterlambatan</b></p>
        
        <div class="mb-3 row">
            <label for="student_id" class="col-sm-2 col-form-label">Siswa :</label>
            <div class="col-sm-10">
                <select class="form-control" name="student_id" id="student_id">
                    @foreach($students as $student)
                      <option value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach
                  </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-label">Tanggal :</label>
            <div class="col-sm-10">
            <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Keterangan Keterlambatan :</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="information" name="information" rows="4" cols="50">
                </textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label">Bukti :</label>
            <div class="col-sm-10">
            <input type="file" class="form-control" id="bukti" name="bukti">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
@endsection