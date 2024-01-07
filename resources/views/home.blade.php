@extends('layouts.template')

@section('content')
    <div class="jumbotron py-4 px-5">
        @if (Session::get('canAccess'))
            <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
        @endif
        <h1 class="display-4">
            Dashboard
        </h1>
        <hr class="my-4">
        <p>Home/Dashboard</p>

        @if (Auth::user()->role == 'admin')
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-text">Peserta Didik </h5>
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z" />
                                </svg><b style="font-size: 30px">
                                    {{ App\Models\student::where('id', '!=', '')->count() }}</b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-text">Administrator</h5>
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z" />
                                </svg><b style="font-size: 30px;">
                                    {{ App\Models\user::where('role', '=', 'admin')->count() }}</b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-text">Pembimbing Siswa</h5>
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z" />
                                </svg><b style="font-size: 30px">
                                    {{ App\Models\user::where('role', '=', 'ps')->count() }}</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-text">Rombel</h5>
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                                    <path d="M19 24l-5-4.39-5 4.39v-20h10v20zm-12-22h8v-2h-10v20l2-1.756v-16.244z" />
                                </svg><b style="font-size: 30px">
                                    {{ App\Models\rombel::where('id', '!=', '')->count() }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-text">Rayon</h5>
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                                    <path d="M19 24l-5-4.39-5 4.39v-20h10v20zm-12-22h8v-2h-10v20l2-1.756v-16.244z" />
                                </svg><b style="font-size: 30px">
                                    {{ App\Models\rayon::where('id', '!=', '')->count() }}</b></p>
                        </div>
                    </div>
                </div>
            </div>

        @elseif (Auth::user()->role == 'ps')
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-text">Peserta Didik Rayon {{ Session::get('rayon') }}</h5>
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z" />
                                </svg><b style="font-size: 30px">
                                    {{ App\Models\student::where('rayon_id', '=', Session::get('rayon_id'))->count() }}</b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-text">Keterlambatan {{ Session::get('rayon') }} Hari ini</h5>
                            <p><svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z" />
                                </svg><b style="font-size: 30px">
                                    {{ App\Models\late::whereHas('student', function ($query) {
                                        return $query->where('rayon_id', '=', Session::get('rayon_id'));
                                    })->count() }}</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
