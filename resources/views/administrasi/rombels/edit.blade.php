@extends('layouts.template')

@section('content')
    <form action="{{ route('rombel.update', $rombels['id'])}}" method="POST" class="card p-5">
        @csrf
        @method('PATCH')
        @if (Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }}</div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h1 class="display-4">
           Edit Data Rombel
        </h1>
        <hr class="my-4">
        <p>Home/ Data Rombel / <b>Edit Data Rombel</b></p>

        <div class="mb-3 row">
            <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel" value="{{ $rombels['rombel'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection