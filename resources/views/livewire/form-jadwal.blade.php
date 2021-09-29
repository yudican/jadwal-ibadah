<div>
    <x-text-field type="text" name="key" label="key" />
    <x-text-field type="date" name="tanggal" label="tanggal" />
    <x-select name="jadwal_id" label="Jadwal" handleChange="selectJadwal" type="jadwal">
        <option value="">Select Jadwal</option>
        @foreach ($jadwals as $jadwal)
        <option value="{{$jadwal->id}}">{{$jadwal->jadwal_nama}}</option>
        @endforeach
    </x-select>
    <x-select name="tempat_ibadah_id" label="Tempat Ibadah ">
        <option value="">Select Tempat Ibadah</option>
        @foreach ($tempats as $tempat)
        <option value="{{$tempat->id}}">{{$tempat->tempat_ibadah_nama}}</option>
        @endforeach
    </x-select>
    @if ($jadwal_id == 1)
    <div>
        <x-select name="leader_id" label="Worhsip Leader" handleChange="handleSelect" type="leader">
            <option value="">Select Worhsip Leader</option>
            @foreach ($leaders as $leader)
            <option value="{{$leader->id}}">{{$leader->petugas_nama}}</option>
            @endforeach
        </x-select>
        @if ($singers)
        <x-select name="penyanyi_id" id="choices-multiple-remove-button" class="w-100" label="Penyanyi" multiple ignore
            handleChange="handleSelect" type="singer">
            @foreach ($singers as $singer)
            <option value="{{$singer->id}}">{{$singer->petugas_nama}}</option>
            @endforeach
        </x-select>
        @endif
        @if ($tamborins)
        <x-select name="tamborin_id" id="choices-multiple-remove-button-2" class="w-100" label="Tamborin" multiple
            ignore handleChange="handleSelect" type="tamborin">
            @foreach ($tamborins as $tamborin)
            <option value="{{$tamborin->id}}">{{$tamborin->petugas_nama}}</option>
            @endforeach
        </x-select>
        @endif
    </div>
    @endif
    @if ($jadwal_id == 2)
    <div>
        <x-select name="leader_id" label="Worhsip Leader" handleChange="handleSelect" type="leader">
            <option value="">Select Worhsip Leader</option>
            @foreach ($leaders as $leader)
            <option value="{{$leader->id}}">{{$leader->petugas_nama}}</option>
            @endforeach
        </x-select>
        <x-select name="pembaca_kitab_id" label="Pembaca 3 Kitab" handleChange="handleSelect" type="pembaca_kitab">
            <option value="">Select Pembaca 3 Kitab</option>
            @foreach ($pembaca_kitab as $kitab)
            <option value="{{$kitab->id}}">{{$kitab->petugas_nama}}</option>
            @endforeach
        </x-select>
        <x-select name="pembaca_doa_id" label="Doa 3 komponen" handleChange="handleSelect" type="pembaca_doa">
            <option value="">Select Doa 3 komponen</option>
            @foreach ($pembaca_doa as $kitab)
            <option value="{{$kitab->id}}">{{$kitab->petugas_nama}}</option>
            @endforeach
        </x-select>

        @if ($singers)
        <x-select name="penyanyi_id" id="choices-multiple-remove-button" class="w-100" label="Penyanyi" multiple ignore>
            @foreach ($singers as $singer)
            <option value="{{$singer->id}}">{{$singer->petugas_nama}}</option>
            @endforeach
        </x-select>
        @endif
    </div>
    @endif
    @if ($jadwal_id == 3)
    <div>
        <x-text-field type="time" name="waktu_ibadah" label="Waktu Ibadah" />
        <x-text-field type="text" name="lagu" label="Musik" />
        <x-select name="leader_id" label="Worhsip Leader" handleChange="handleSelect" type="leader">
            <option value="">Select Worhsip Leader</option>
            @foreach ($leaders as $leader)
            <option value="{{$leader->id}}">{{$leader->petugas_nama}}</option>
            @endforeach
        </x-select>
    </div>
    @endif
    @if ($jadwal_id == 4)
    <x-text-field type="time" name="waktu_ibadah" label="Waktu Ibadah" />
    @endif

    @push('scripts')
    <script src="{{ asset('assets/js/plugin/select2/select2.full.min.js') }}"></script>

    <script>
        document.addEventListener('livewire:load', function(e) {
            window.livewire.on('loadForm', (data) => {
                if (data?.singer > 0) {
                $('#choices-multiple-remove-button').select2({
                    theme: "bootstrap",
                });
                }
                $('#choices-multiple-remove-button').on('change', function (e) {
                    let data = $(this).val();
                    console.log(data)
                    @this.set('penyanyi_id', data);
                    @this.call('handleSelect', 'singer', data);
                });

                if (data?.tamborin > 0) {
                $('#choices-multiple-remove-button-2').select2({
                    theme: "bootstrap",
                });
                }
                $('#choices-multiple-remove-button-2').on('change', function (e) {
                    let data = $(this).val();
                    console.log(data)
                    @this.set('tamborin_id', data);
                    @this.call('handleSelect', 'tamborin', data);
                });
            });
        })
    </script>
    @endpush
</div>