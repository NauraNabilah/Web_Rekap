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
        Data Keterlambatan
    </h1>
    <hr class="my-4">
    <p>Home/ <b>Data Keterlambatan</b></p>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        @if (Auth::user()->role == 'admin')
            <a class="btn btn-secondary" href="{{ route('late.create') }}">Tambah Data</a>
        @endif
        <a class="btn btn-primary" href="{{ route('late.export.excel') }}">Export Data Keterlambatan (Excel)</a>
    </div>
    <div>
        <form action="{{ route('late.cari') }}" method="GET">
            <input type="text" name="cari" placeholder="Cari Data .." value="{{ old('cari') }}">
            <input type="submit" value="cari">
        </form>
    </div>
    <br>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#semua">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#rekap">Rekapitulasi Data</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="semua" class="tab-pane fade show active">
            <table class="table table-stripped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Informasi</th>
                        @if (Auth::user()->role == 'admin')
                            <th class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($lates as $late)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $late->student->nis }} <br>{{ $late->student->name }}</td>
                            <td>{{ $late->date_time_late }}</td>
                            <td>{{ $late->information }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('late.edit', $late->id) }}" class="btn btn-primary me-3">Edit</a>
                                    <form action="{{ route('late.destroy', $late->id) }}" method="POST">
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
            @if ($lates->count())
                {{ $lates->links() }}
            @endif
        </div>
        <div id="rekap" class="tab-pane fade">
            <table class="table table-stripped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Jumlah Keterlambatan</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($rekap as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->student->nis }}</td>
                            <td>{{ $item->student->name }}</td>
                            <td>{{ $item->jumlah_keterlambatan }}</td>
                            <td class="justify-content-center">
                                <a href="{{ route('late.detail', $item->student_id) }}">Lihat</a>
                            </td>
                            <td>
                                @csrf
                                @if ($item->jumlah_keterlambatan >= 3)
                                    <a href="{{ route('late.downloadPDF', ['id' => $item->id]) }}" class="btn btn-primary"
                                        style="margin-left: 25px;">Cetak Surat Pernyataan</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
