@extends('layouts.template')

@section('content')
    <form action="{{ route('late.update', $lates['id'] ?? '') }}" method="POST" class="card p-5" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h1 class="display-4">
            Edit Data Keterlambatan
         </h1>
         <hr class="my-4">
         <p>Home/ Data Keterlambatan / <b>Edit Data Keterlambatan</b></p>

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
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late" value="{{ $lates['date_time_late'] ?? null }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Informasi :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="information" name="information" value="{{ $lates['information'] ?? null }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label">Bukti :</label>
            <div class="col-sm-10">
                {{-- <input type="file" class="form-control" id="bukti" name="bukti" value="{{ asset('storage/' . $lates->bukti) }}"> --}}
                <input type="file" class="form-control" id="bukti" name="bukti">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="preview-bukti" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <img id="preview-bukti" src="{{ asset('storage/' . $lates['bukti'] ?? 'no.png') }}"
                alt="preview bukti" style="max-width: 200px;">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection