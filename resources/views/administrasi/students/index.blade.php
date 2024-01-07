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
        Data Siswa
    </h1>
    <hr class="my-4">
    <p>Home/ <b>Data Siswa</b></p>
    <div class="justify-content-center" style="margin-right: 20%;">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            @if (Auth::user()->role == 'admin')
                <a class="btn btn-secondary" href="{{ route('student.create') }}">Tambah Siswa</a>
            @endif
        </div>
        <div>
            <form action="{{ route('student.cari') }}" method="GET">
                <input type="text" name="cari" placeholder="Cari Siswa .." value="{{ old('cari') }}">
                <input type="submit" value="cari">
            </form>
        </div>
        <br>
        <table class="table table-stripped table-bordered table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Rombel</th>
                    <th>Rayon</th>
                    @if (Auth::user()->role == 'admin')
                        <th class="text-center">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $student['nis'] }}</td>
                        <td>{{ $student['name'] }}</td>
                        <td>{{ $student->rombel->rombel }}</td>
                        <td>{{ $student->rayon->rayon }}</td>
                        @if (Auth::user()->role == 'admin')
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('student.edit', $student['id']) }}" class="btn btn-primary me-3">Edit</a>
                                <form action="{{ route('student.destroy', $student['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
