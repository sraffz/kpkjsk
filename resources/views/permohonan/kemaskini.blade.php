@extends('layouts.app', ['page' => 'permohonan-kemaskini'])

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div>
                 <a href="{{ url('permohonan') }}">
                    <button class="btn btn-primary d-inline-flex align-items-center me-2">
                        Kembali
                    </button>
                </a>
         </div>
         <div class="float-end">
             
         </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Butiran Permohonan</h2>
                 <form method="POST"  action="{{ route('kemaskini-permohonan', [$permohonan->id]) }}" class="form-control">
                    {{ csrf_field() }}
                     <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="jabatan">Jabatan/Agensi</label>
                                <select class="form-select w-100 mb-0 select2bs4" name="jabatan" aria-label="State select example" required>
                                    <option style="width: 100%" value="">Jabatan/Agensi</option>
                                    @foreach ($jabatan as $jbtn)
                                        <option value="{{ $jbtn->jabatan_id }}" {{ $jbtn->jabatan_id == $permohonan->jabatan ? 'selected' : '' }}>{{ $jbtn->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="no_rujukan_surat">No. Rujukan Surat</label>
                                <input class="form-control" id="no_rujukan_surat" name="no_rujukan_surat" type="text"
                                    placeholder="No Ruj Surat" value="{{ $permohonan->no_rujukan_surat }}" required>
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
                                    type="text" placeholder="dd/mm/yyyy" value="{{ \Carbon\Carbon::parse($permohonan->tarikh_surat)->format('d-m-Y')  }}" required>
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
                                    type="text" placeholder="dd/mm/yyyy" value="{{ \Carbon\Carbon::parse($permohonan->tarikh_terima_surat)->format('d-m-Y')  }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="tarikh_terima_surat">Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" rows="3">{{ $permohonan->catatan }}</textarea>
                        </div>
                     </div>
                    <h2 class="h5 my-4">Jawatan Dimohon</h2>
                    <div class="text-end">
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
                            @php
                                $k = 0;
                            @endphp
                            @foreach ($jawatan as $jwtn)
                                <tr>
                                    <td>
                                        <input type="hidden" name="addMoreInputFields[{{ $k }}][id_jawatan]" value="{{ $jwtn->id_jawatan_dimohon }}">
                                        <select style="width: 100%" class="form-select mb-0 select2bs4" id="jawatan" name="addMoreInputFields[{{ $k }}][jawatan]"
                                            aria-label="Jawatan" required>
                                            <option value="">Jawatan</option>
                                            @foreach ($skim as $skims)
                                                <option value="{{ $skims->id }}" {{ $skims->id == $jwtn->nama_jawatan ? 'selected' : '' }}>{{ $skims->diskripsi }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select style="width: 100%" class="form-select mb-0 select2bs4" name="addMoreInputFields[{{ $k }}][gred]" id="gred"
                                            aria-label="Gred" required>
                                            <option value="">Gred</option>
                                            @foreach ($gred as $gredd)
                                                <option value="{{ $gredd->id }}" {{ $gredd->id == $jwtn->gred_jawatan ? 'selected' : '' }}>{{ $gredd->kod }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control" id="bilangan" name="addMoreInputFields[{{ $k }}][bilangan]" type="number" value="{{ $jwtn->bil_jawatan  }}" required>
                                    </td>
                                    <td>
                                        <input class="form-control" id="penempatan" name="addMoreInputFields[{{ $k }}][penempatan]" type="text"
                                            placeholder="Penempatan" value="{{ $jwtn->penempatan  }}" required>
                                    </td>
                                    <td>
                                        @if ($k == 0)
                                            <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Tambah</button>
                                        @elseif ($k > 0)
                                            <button type="button" class="btn btn-outline-danger remove-input-field">Delete</button>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                 $k++ ;
                                @endphp
                                @endforeach
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
        var i = {{$k-1}};
        $("#dynamic-ar").click(function() {
            ++i;
            $(document).ready(function() {
            $('#select2-.i.').select2( {
                theme: "bootstrap-5",
                    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                } );
            });
            $("#dynamicAddRemove").append('<tr><td><select class="form-select mb-0" id="select2-'+ i +'" name="addMoreInputFields['+ i +'][jawatan]"aria-label="Pilih Jawatan" required><option value="">Jawatan</option>@foreach ($skim as $skims)<option value="{{ $skims->id }}">{{ $skims->diskripsi }}</option>@endforeach</select></td><td> <select class="form-select mb-0 selectitems" name="addMoreInputFields['+ i +'][gred]" id="gred" aria-label="Gred select example" required><option value="">Gred</option>@foreach ($gred as $gredd)<option value="{{ $gredd->id }}">{{ $gredd->kod }}</option>@endforeach</select></td><td><input class="form-control" id="bilangan" name="addMoreInputFields['+ i +'][bilangan]" type="number" placeholder=" " required></td><td><input class="form-control" id="penempatan" name="addMoreInputFields['+ i +'][penempatan]" type="text" placeholder="Penempatan" required></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
   
        // $(document).ready(function() {
        //     $('.select2bs4').select2( {
        //         theme: "bootstrap-5",
        //         width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        //         placeholder: $( this ).data( 'placeholder' ),
        //     } );
        // });
    </script>
 
@endsection
