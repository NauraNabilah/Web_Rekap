@extends('layouts.template')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    @if (Session::get('gagal'))
    <div class="alert alert-warning">{{ Session::get('gagal') }}</div>
    @endif

    <h1 class="display-4">
        Data Rayon
    </h1>
    <hr class="my-4">
    <p>Home/ <b>Data Rayon</b></p>
    <div class="justify-content-center" style="margin-right: 20%;">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-secondary" href="{{ route('rayon.create') }}">Tambah Rayon</a>
        </div>
        <div>
            <form action="{{ route('rayon.cari') }}" method="GET">
                <input type="text" name="cari" placeholder="Cari Rayon .." value="{{ old('cari') }}">
                <input type="submit" value="cari">
            </form>
        </div>
        <br>
        <table class="table table-stripped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Rayon</th>
                    <th>Pembimbing Siswa</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($rayons as $rayon)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $rayon['rayon'] }}</td>
                        <td>{{ $rayon->user->name }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('rayon.edit', $rayon['id']) }}" class="btn btn-primary me-3">Edit</a>
                            <form action="{{ route('rayon.destroy', $rayon['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
