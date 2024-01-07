@extends('layouts.template')
@section('content')

<div class="page-content">

    @if (Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    @if (Session::get('gagal'))
    <div class="alert alert-warning">{{ Session::get('gagal') }}</div>
    @endif

    <h1 class="display-4">
        Data User
    </h1>
    <hr class="my-4">
    <p>Home/Data User</p>

    <div class="justify-content-center" style="margin-right: 20%;">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-secondary" href="{{ route('user.create') }}">Tambah Pengguna</a>
    </div>      
    <div>
        <form action="{{ route('user.cari') }}" method="GET">
            <input type="text" name="cari" placeholder="Cari Pengguna .." value="{{ old('cari') }}">
            <input type="submit" value="cari">
        </form>
    </div>
    <br>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Tipe Pengguna</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($users as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['email'] }}</td>
                <td>{{ $item['role'] }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                    <form action="{{ route('user.destroy', $item['id']) }}" method="POST">
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
</div>
@endsection