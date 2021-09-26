<div class="page-inner">
    @push('user-styles')
    <style>
        .main-panel {
            background-image: url('{{asset('assets/img/bg.jpeg')}}');
            background-repeat: no-repeat;
            background-size: cover;
            background-width: 100%;
        }
    </style>
    @endpush
    <div class="shadow-none" id="service">
        <div class="card-body">
            <div class="row mt-2 pt-4 justify-content-around">
                @foreach ($jadwals as $jadwal)
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mx-auto">
                    <a href="{{route('jadwal.user', ['jadwal_id' => $jadwal->id])}}"
                        style="text-decoration:none;color:#000;">
                        <div class="card ">
                            <img class="card-img-top" style="height: 10%;"
                                src="{{asset('storage/'.$jadwal->jadwal_logo)}}" alt="Card image cap">
                            <div class="card-body">
                                <p class="media-body mb-0 small lh-125 text-center text-capitalize">
                                    {{$jadwal->jadwal_nama}}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>