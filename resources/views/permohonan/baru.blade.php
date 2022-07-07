@extends('layouts.app', ['page' => 'permohonan-baru'])

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div>
            <div class="dropdown">
                <a href="{{ url('permohonan') }}">
                    <button class="btn btn-primary d-inline-flex align-items-center me-2">
                        Kembali
                    </button>
                </a>
                {{-- <button class="btn btn-secondary d-inline-flex align-items-center me-2 dropdown-toggle"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    New
                </button>
                <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Document
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Message
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                            </path>
                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                        </svg>
                        Product
                    </a>
                    <div role="separator" class="dropdown-divider my-1"></div>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <svg class="dropdown-icon text-danger me-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                clip-rule="evenodd"></path>
                        </svg>
                        My Plan
                    </a>
                </div> --}}
            </div>
        </div>
 
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Butiran Permohonan</h2>
                 <form method="POST"  action="{{ route('simpan-permohonan-baru') }}" class="form-control" autocomplete="off">
                    {{ csrf_field() }}
                     <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="jabatan">Jabatan/Agensi</label>
                                <select class="form-select w-100 mb-0 select2append" name="jabatan" aria-label="State select example" required>
                                    <option value="">Jabatan/Agensi</option>
                                    @foreach ($jabatan as $jbtn)
                                        <option value="{{ $jbtn->jabatan_id }}">{{ $jbtn->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="no_rujukan_surat">No. Rujukan Surat</label>
                                <input class="form-control" id="no_rujukan_surat" name="no_rujukan_surat" type="text"
                                    placeholder="No Ruj Surat" required>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="tarikh_surat">Tarikh Surat</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input data-datepicker="" class="form-control" id="tarikh_surat" name="tarikh_surat"
                                    type="text" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tarikh_terima_surat">Tarikh Terima</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input data-datepicker="" class="form-control" id="tarikh_terima_surat" name="tarikh_terima_surat"
                                    type="text" placeholder="dd/mm/yyyy" required>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="tarikh_terima_surat">Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
                        </div>
                     </div>
                    <h2 class="h5 my-4">Jawatan Dimohon</h2>
                    {{-- <div class="row">
                        <div class="col-sm-5 mb-3">
                            <div class="form-group">
                                <label for="jawatan">Jawatan</label>
                                <select class="form-select mb-0" id="jawatan" name="jawatan"
                                    aria-label="Jawatan select example" required>
                                    <option value="">Jawatan</option>
                                    @foreach ($skim as $skims)
                                        <option value="{{ $skims->id }}">{{ $skims->diskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <div class="form-group">
                                <label for="gred">Gred</label>
                                <select class="form-select mb-0" name="gred" id="gred"
                                    aria-label="Gred select example" required>
                                    <option value="">Gred</option>
                                    @foreach ($gred as $gredd)
                                        <option value="{{ $gredd->id }}">{{ $gredd->kod }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <div class="form-group">
                                <label for="bilangan">Bil Permohonan</label>
                                <input class="form-control" id="bilangan" name="bilangan" type="number"
                                    placeholder="Bilangan" required>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <div class="form-group">
                                <label for="penempatan">Penempatan</label>
                                <input class="form-control" id="penempatan" name="penempatan" type="text"
                                    placeholder="Penempatan" required>
                            </div>
                        </div>
                    </div> --}}
                    <div class="text-end">
                        {{-- <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah Jawatan</button> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamicAddRemove">
                            <tr>
                                <th style="width: 50%">Jawatan Dimohon</th>
                                <th style="width: 15%">Gred</th>
                                <th style="width: 13%">Bil</th>
                                <th style="width: 20%">Penempatan</th>
                                <th >Tindakan</th>
                            </tr>
                            <tr>
                                <td>
                                    <select style="width: 100%" class="form-select mb-0 select2append" name="addMoreInputFields[0][jawatan]"
                                        aria-label="Jawatan" required>
                                        <option value="">Jawatan</option>
                                        @foreach ($skim as $skims)
                                            <option value="{{ $skims->id }}">{{ $skims->diskripsi }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select style="width: 100%" class="form-select mb-0 select2append" name="addMoreInputFields[0][gred]"
                                        aria-label="Gred" required>
                                        <option value="">Gred</option>
                                        @foreach ($gred as $gredd)
                                            <option value="{{ $gredd->id }}">{{ $gredd->kod }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" id="bilangan" name="addMoreInputFields[0][bilangan]" type="number" required>
                                </td>
                                <td>
                                    <input class="form-control" id="penempatan" name="addMoreInputFields[0][penempatan]" type="text"
                                        placeholder="Penempatan" required>
                                </td>
                                <td>
                                    <button type="button" name="add" id="dynamic-ar"
                                        class="btn btn-outline-primary">Tambah</button>
                                </td>
                            </tr>
                          
                        </table>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('script')

    <script type="text/javascript">
        $('.select2append').select2( { theme: "bootstrap-5" } );

        var i = 0;
        $("#dynamic-ar").click(function() {
             ++i;
            
            $("#dynamicAddRemove").append(
                '<tr><td><select class="form-select mb-0 select2append" name="addMoreInputFields['
                    + i +'][jawatan]"aria-label="Pilih Jawatan" required> <option value="">Jawatan</option> @foreach ($skim as $skims) <option value="{{ $skims->id }}">{{ $skims->diskripsi }}</option>@endforeach</select></td> <td> <select class="form-select mb-0 select2append" name="addMoreInputFields['
                        + i +'][gred]" id="gred" aria-label="Gred select example" required><option value="">Gred</option>@foreach ($gred as $gredd)<option value="{{ $gredd->id }}">{{ $gredd->kod }}</option>@endforeach</select></td><td><input class="form-control" id="bilangan" name="addMoreInputFields['
                            + i +'][bilangan]" type="number" placeholder=" " required></td><td><input class="form-control" id="penempatan" name="addMoreInputFields['
                            + i +'][penempatan]" type="text" placeholder="Penempatan" required></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
            $("#dynamicAddRemove .select2append").select2({ theme: "bootstrap-5" });
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
        
    </script>

    <script>
        // $(document).ready(function() {
        //     $('.select2-bs5').select2( {
        //         theme: "bootstrap-5",
        //         width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        //      } );
        // });
    </script>
 
@endsection
