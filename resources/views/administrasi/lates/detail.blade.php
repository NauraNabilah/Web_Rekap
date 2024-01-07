@extends('layouts.template')

@section('content')
    <h1 class="display-4">
        Detail Data Keterlambatan
    </h1>
    <hr class="my-4">
    <p>Home / Data Keterlambatan / <b>Detail Data Keterlambatan</b></p>

    <b>{{ $students->name }}</b> | {{ $students->nis }} | {{ $students->rayon->rayon }} |
    {{ $students->rombel->rombel }}

    @php $no = 1; @endphp
    <div class="row mt-3">
        @foreach ($lates as $late)
            <div class="col-3 border m-2 rounded-1 bg-light">
               <h5>Keterlambatan Ke-{{ $no++ }}</h5>
                <p>{{ $late->date_time_late }}</p> 
                {{ $late->information }} <br>
                <img id="bukti" src="{{ asset('storage/' . $late->bukti) }}" alt="preview bukti" style="max-width: 200px;">
            </div>
        @endforeach
    </div>
@endsection
