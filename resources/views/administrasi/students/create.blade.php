@extends('layouts.template')

@section('content')
    <form action="{{ route('student.store') }}" method="post" class="card p-5">
        @csrf

        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h1 class="display-4">
           Tambah Data Siswa
        </h1>
        <hr class="my-4">
        <p>Home/ Data Siswa / <b>Tambah Data Siswa</b></p>
        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">nis :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nis" id="nis">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel_id" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <select name="rombel_id" id="rombel_id" class="form-select">
                    <option selected hidden disabled>Pilih</option>
                    @foreach($rombels as $rombel)
                    <option value="{{$rombel->id}}">{{$rombel->rombel}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rayon_id" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <select name="rayon_id" id="rayon_id" class="form-select">
                    <option selected hidden disabled>Pilih</option>
                    @foreach($rayons as $rayon)
                    <option value="{{$rayon->id}}">{{$rayon->rayon}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection