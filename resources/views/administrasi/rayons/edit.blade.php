    @extends('layouts.template')

    @section('content')
        <form action="{{ route('rayon.update', $rayons['id'] ?? '')}}" method="post" class="card p-5">
            @csrf
            @method('PATCH')
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
               Edit Data Rayon
            </h1>
            <hr class="my-4">
            <p>Home/ Data Rayon / <b>Edit Data Rayon</b></p>
            <div class="mb-3 row">
                <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="rayon" id="rayon" value="{{ $rayons['rayon'] ?? ''}}">
                </div>
            </div>
            <div class="mb-3 row">
                <div class="mb-3 row">
                    <select name="user_id" id="user_id" class="form-select">
                        <option selected hidden disabled>Pilih</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == ($rayons['user_id'] ?? null) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>                        
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
        </form>
    @endsection