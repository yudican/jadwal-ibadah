<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3"></i>tbl jadwal ibadah</span>
                        </a>
                        <div class="pull-right">
                            @if ($form_active)
                            <button class="btn btn-danger btn-sm" wire:click="toggleForm(false)"><i
                                    class="fas fa-times"></i> Cancel</button>
                            @else
                            <button class="btn btn-primary btn-sm" wire:click="toggleForm(true)"><i
                                    class="fas fa-plus"></i>
                                Add
                                New</button>
                            @endif
                        </div>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @if ($form_active)
            <div class="card">
                <div class="card-body">
                    <x-text-field type="text" name="key" label="key" />
                    <x-text-field type="date" name="tanggal" label="tanggal" />
                    <x-select name="jadwal_id" label="Jadwal {{count($singers)}}" handleChange="selectJadwal"
                        type="jadwal">
                        <option value="">Select Jadwal</option>
                        @foreach ($jadwals as $jadwal)
                        <option value="{{$jadwal->id}}">{{$jadwal->jadwal_nama}}</option>
                        @endforeach
                    </x-select>
                    <x-select name="tempat_ibadah_id" label="Tempat Ibadah">
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
                        @if (count($singers) > 0)
                        <div>
                            <x-select name="penyanyi_id" id="choices-multiple-remove-button" class="w-100"
                                label="Penyanyi" multiple ignore handleChange="handleSelect" type="singer">
                                @foreach ($singers as $singer)
                                <option value="{{$singer->id}}">{{$singer->petugas_nama}}</option>
                                @endforeach
                            </x-select>
                        </div>
                        @endif
                        @if (count($tamborins) > 0)
                        <div>
                            <x-select name="tamborin_id" id="choices-multiple-remove-button-2" class="w-100"
                                label="Tamborin" multiple ignore handleChange="handleSelect" type="tamborin">
                                @foreach ($tamborins as $tamborin)
                                <option value="{{$tamborin->id}}">{{$tamborin->petugas_nama}}</option>
                                @endforeach
                            </x-select>
                        </div>
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
                        <x-select name="pembaca_kitab_id" label="Pembaca 3 Kitab" handleChange="handleSelect"
                            type="pembaca_kitab">
                            <option value="">Select Pembaca 3 Kitab</option>
                            @foreach ($pembaca_kitab as $kitab)
                            <option value="{{$kitab->id}}">{{$kitab->petugas_nama}}</option>
                            @endforeach
                        </x-select>
                        <x-select name="pembaca_doa_id" label="Doa 3 komponen" handleChange="handleSelect"
                            type="pembaca_doa">
                            <option value="">Select Doa 3 komponen</option>
                            @foreach ($pembaca_doa as $kitab)
                            <option value="{{$kitab->id}}">{{$kitab->petugas_nama}}</option>
                            @endforeach
                        </x-select>
                        @if (count($singers) > 0)
                        <div>
                            <x-select name="penyanyi_id" id="choices-multiple-remove-button" class="w-100"
                                label="Penyanyi" multiple ignore>
                                @foreach ($singers as $singer)
                                <option value="{{$singer->id}}">{{$singer->petugas_nama}}</option>
                                @endforeach
                            </x-select>
                        </div>
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

                    <div class="form-group">
                        <button class="btn btn-primary pull-right"
                            wire:click="{{$update_mode ? 'update' : 'store'}}">Simpan</button>
                    </div>
                </div>
            </div>
            @else
            <livewire:table.jadwal-ibadah-table />
            @endif

        </div>

        {{-- Modal confirm --}}
        <div id="confirm-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog"
            aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" permission="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Konfirmasi Hapus</h5>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin hapus data ini.?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:click='delete' class="btn btn-danger btn-sm"><i
                                class="fa fa-check pr-2"></i>Ya, Hapus</button>
                        <button class="btn btn-primary btn-sm" wire:click='_reset'><i
                                class="fa fa-times pr-2"></i>Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/js/plugin/select2/select2.full.min.js') }}"></script>

    <script>
        document.addEventListener('livewire:load', function(e) {
            window.livewire.on('loadForm', (data) => {
                    $('#choices-multiple-remove-button').select2({
                        theme: "bootstrap",
                    });
                
                $('#choices-multiple-remove-button').on('change', function (e) {
                    let data = $(this).val();
                    console.log(data)
                    @this.set('penyanyi_id', data);
                    @this.call('handleSelect', 'singer', data);
                });

                    $('#choices-multiple-remove-button-2').select2({
                        theme: "bootstrap",
                    });
                
                $('#choices-multiple-remove-button-2').on('change', function (e) {
                    let data = $(this).val();
                    console.log(data)
                    @this.set('tamborin_id', data);
                    @this.call('handleSelect', 'tamborin', data);
                });
            });
            window.livewire.on('showModal', (data) => {
                $('#form-modal').modal('show')
            });

            window.livewire.on('closeModal', (data) => {
                $('#confirm-modal').modal('hide')
                $('#form-modal').modal('hide')
            });
        })
    </script>
    @endpush
</div>