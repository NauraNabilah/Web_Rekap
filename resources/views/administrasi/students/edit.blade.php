@extends('layouts.template')

@section('content')
    <form action="{{ route('student.update', $students['id']) }}" method="POST" class="card p-5">
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
           Edit Data Siswa
        </h1>
        <hr class="my-4">
        <p>Home/ Data Siswa / <b>Edit Data Siswa</b> </p>

        <div class="mb-3 row">
            <div class="mb-3 row">
                <label for="nis" class="col-sm-2 col-form-label">nis :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nis" id="nis"  value="{{ $students['nis'] }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name"  value="{{ $students['name'] }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
                <div class="col-sm-10">
                    <select name="rombel_id" id="rombel_id" class="form-select">
                        <option selected hidden disabled>Pilih</option>
                        @foreach($rombels as $rombel)
                        <option value="{{ $rombel->id }}" {{ $rombel->id == ($students['rombel_id'] ?? null) ? 'selected' : '' }}>
                            {{ $rombel->rombel }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
                <div class="col-sm-10">
                    <select name="rayon_id" id="rayon_id" class="form-select">
                        <option selected hidden disabled>Pilih</option>
                        @foreach($rayons as $rayon)
                        <option value="{{ $rayon->id }}" {{ $rayon->id == ($students['rayon_id'] ?? null) ? 'selected' : '' }}>
                            {{ $rayon->rayon }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection