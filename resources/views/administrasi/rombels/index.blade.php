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
        Data Rombel
    </h1>
    <hr class="my-4">
    <p>Home/ <b>Data Rombel</b></p>

    <div class="justify-content-center" style="margin-right: 20%;">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-secondary" href="{{ route('rombel.create') }}">Tambah Rombel</a>
        </div>
        <div>
            <form action="{{ route('rombel.cari') }}" method="GET">
                <input type="text" name="cari" placeholder="Cari Rombel .." value="{{ old('cari') }}">
                <input type="submit" value="cari">
            </form>
        </div>
        <br>
        <table class="table table-stripped table-bordered table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Rombel</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($rombels as $rombel)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $rombel['rombel'] }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('rombel.edit', $rombel['id']) }}" class="btn btn-primary me-3">Edit</a>
                            <form action="{{ route('rombel.destroy', $rombel['id']) }}" method="POST">
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