@extends('layouts.app', ['page' => 'permohonan-kemaskini'])

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div>
            <div class="dropdown">
                <a href="{{ url('permohonan') }}">
                    <button class="btn btn-primary d-inline-flex align-items-center me-2">
                        Kembali
                    </button>
                </a>

            </div>
        </div>
        <div class="float-end">
            <a href="{{ route('permohonan.kemaskini', [$permohonan->id]) }}">
                <button class="btn btn-info d-inline-flex align-items-center me-2">
                    Kemaskini
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Butiran Permohonan</h2>
                <form method="POST" action="{{ route('kemaskini-permohonan', [$permohonan->id]) }}" class="form-control">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="jabatan">Jabatan/Agensi</label>
                                <select class="form-select w-100 mb-0 select2-bs5" disabled name="jabatan"
                                    aria-label="State select example" required>
                                    <option value="">Jabatan/Agensi</option>
                                    @foreach ($jabatan as $jbtn)
                                        <option value="{{ $jbtn->jabatan_id }}"
                                            {{ $jbtn->jabatan_id == $permohonan->jabatan ? 'selected' : '' }}>
                                            {{ $jbtn->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="no_rujukan_surat">No. Rujukan Surat</label>
                                <input class="form-control" id="no_rujukan_surat" disabled name="no_rujukan_surat"
                                    type="text" placeholder="No Ruj Surat" value="{{ $permohonan->no_rujukan_surat }}"
                                    required>
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
                                <input data-datepicker="" class="form-control" disabled id="tarikh_surat"
                                    name="tarikh_surat" type="text" placeholder="dd/mm/yyyy"
                                    value="{{ \Carbon\Carbon::parse($permohonan->tarikh_surat)->format('d-m-Y') }}"
                                    required>
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
                                <input data-datepicker="" class="form-control" id="tarikh_terima_surat"
                                    name="tarikh_terima_surat" type="text" placeholder="dd/mm/yyyy" disabled
                                    value="{{ \Carbon\Carbon::parse($permohonan->tarikh_terima_surat)->format('d-m-Y') }}"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="tarikh_terima_surat">Catatan</label>
                            <textarea class="form-control" disabled name="catatan" id="catatan" rows="3">{{ $permohonan->catatan }}</textarea>
                        </div>
                    </div>
                    <h2 class="h5 my-4">Jawatan Dimohon</h2>
                    <div class="text-end">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dynamicAddRemove">
                            <thead>
                                <tr class="align-middle text-center">
                                    <th rowspan="2" style="width: 50%">Jawatan Dimohon</th>
                                    <th rowspan="2" style="width: 15%">Gred</th>
                                    <th colspan="2" style="width: 13%">Bilangan</th>
                                    <th rowspan="2" style="width: 20%">Penempatan</th>
                                    <th rowspan="2" style="width: 20%">Status Terkini</th>
                                    <th rowspan="2">Tindakan</th>
                                </tr>
                                <tr>
                                    <th>Dimohon</th>
                                    <th>diluluskan</th>
                                </tr>
                            </thead>
                            @php
                                $k = 0;
                            @endphp
                            @foreach ($jawatan as $jwtn)
                                <tr class="align-middle text-center">
                                    <td>
                                        <input type="hidden" name="addMoreInputFields[{{ $k }}][id_jawatan]"
                                            value="{{ $jwtn->id_jawatan_dimohon }}">
                                        <textarea class="form-control" style="resize: none" disabled cols="35" rows="3" ad>{{ $jwtn->nama_skim }}</textarea>
                                    </td>
                                    <td>
                                        {{ $jwtn->gred }}
                                    </td>
                                    <td>
                                        {{ $jwtn->bil_jawatan }}
                                    </td>
                                    <td>
                                        {{ $jwtn->bil_diluluskan }}
                                    </td>
                                    <td>
                                        {{ $jwtn->penempatan }}
                                    </td>
                                    <td class="text-center">
                                        <div class="mb-1">
                                            @if ($jwtn->status_permohonan_jawatan == 'LULUS')
                                                <span
                                                    class="badge bg-success">{{ $jwtn->status_permohonan_jawatan }}</span>
                                            @elseif ($jwtn->status_permohonan_jawatan == 'DITOLAK')
                                                <span
                                                    class="badge bg-danger">{{ $jwtn->status_permohonan_jawatan }}</span>
                                            @else
                                                <span
                                                    class="badge bg-info">{{ $jwtn->status_permohonan_jawatan }}</span>
                                            @endif
                                        </div>
                                        @foreach ($tindakan as $tindak)
                                            @if ($jwtn->id_jawatan_dimohon == $tindak->id_jawatan_dipohon)
                                                <strong>
                                                    {{ $tindak->status_jawatan }} <br>
                                                    {{ \Carbon\Carbon::parse($tindak->tarikh)->format('d-m-Y') }} <br>
                                                    {{ $tindak->catatan }}
                                                </strong>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="mb-2">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-tertiary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailjawatan-{{ $jwtn->id_jawatan_dimohon }}"
                                                    data-bs-jawatan="{{ $jwtn->nama_skim }}">Butiran</button>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#kemaskinijawatan-{{ $jwtn->id_jawatan_dimohon }}"
                                                    data-bs-jawatan="{{ $jwtn->nama_skim }}">Kemaskini</button>
                                            </div>
                                            <!-- Modal Butiran Jawatan-->
                                            <div class="modal fade" id="detailjawatan-{{ $jwtn->id_jawatan_dimohon }}"
                                                tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Maklumat Jawatan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">

                                                                <div class="mb-2">
                                                                    <label for="jawatan">Jawatan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="jawatan" value="{{ $jwtn->nama_skim }}"
                                                                        disabled>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="gred">Gred</label>
                                                                    <input type="text" class="form-control"
                                                                        id="gred" value="{{ $jwtn->gred }}"
                                                                        disabled>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xl-6">
                                                                        <div class="mb-2">
                                                                            <label for="bil_permohonan">Bil.
                                                                                Dimohon</label>
                                                                            <input type="text" class="form-control"
                                                                                id="bil_permohonan"
                                                                                value="{{ $jwtn->bil_jawatan }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-6">
                                                                        <div class="mb-2">
                                                                            <label for="bil_lulus">Bil. Diluluskan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="bil_lulus"
                                                                                value="{{ $jwtn->bil_diluluskan }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="penempatan">Penempatan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="penempatan" value="{{ $jwtn->penempatan }}"
                                                                        disabled>
                                                                </div>
                                                                <div class="table-responsive ">
                                                                    <table class="table table-bordered mt-4">
                                                                        <thead class="thead-default">
                                                                            <tr>
                                                                                <th>Tindakan</th>
                                                                                <th>Tarikh</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($tindakan_jawatan as $tj)
                                                                                @if ($tj->id_jawatan_dipohon == $jwtn->id_jawatan_dimohon)
                                                                                    <tr>
                                                                                        <td scope="row">
                                                                                            {{ $tj->tindakan }}
                                                                                        </td>
                                                                                        <td>{{ \Carbon\carbon::parse($tj->tarikh)->format('d-m-Y') }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal kemaskini Jawatan-->
                                            <div class="modal fade"
                                                id="kemaskinijawatan-{{ $jwtn->id_jawatan_dimohon }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Maklumat Jawatan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <input type="hidden" name="id"
                                                                    value="{{ $jwtn->id_jawatan_dimohon }}">
                                                                <div class="mb-2">
                                                                    <label for="jawatan">Jawatan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="jawatan" value="{{ $jwtn->nama_skim }}">
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="gred">Gred</label>
                                                                    <input type="text" class="form-control"
                                                                        id="gred" value="{{ $jwtn->gred }}">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xl-6">
                                                                        <div class="mb-2">
                                                                            <label for="bil_permohonan">Bil.
                                                                                Dimohon</label>
                                                                            <input type="text" class="form-control"
                                                                                id="bil_permohonan"
                                                                                value="{{ $jwtn->bil_jawatan }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-6">
                                                                        <div class="mb-2">
                                                                            <label for="bil_lulus">Bil. Diluluskan</label>
                                                                            <input type="text" class="form-control"
                                                                                id="bil_lulus"
                                                                                value="{{ $jwtn->bil_diluluskan }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label for="penempatan">Penempatan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="penempatan"
                                                                        value="{{ $jwtn->penempatan }}">
                                                                </div>
                                                                <div class="table-responsive ">
                                                                    <table class="table table-bordered mt-4">
                                                                        <thead class="thead-default">
                                                                            <tr>
                                                                                <th>Tindakan</th>
                                                                                <th>Tarikh</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($tindakan_jawatan as $tj)
                                                                                @if ($tj->id_jawatan_dipohon == $jwtn->id_jawatan_dimohon)
                                                                                    <tr>
                                                                                        <td scope="row">
                                                                                            {{ $tj->tindakan }}
                                                                                        </td>
                                                                                        <td>{{ \Carbon\carbon::parse($tj->tarikh)->format('d-m-Y') }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($jwtn->status_permohonan_jawatan == 'LULUS')
                                            <button type="button" class="btn btn-outline-info btn-sm"
                                                data-bs-toggle="modal" data-bs-id="{{ $jwtn->id_jawatan_dimohon }}"
                                                data-bs-target="#statusTerkiniJawatan">Tindakan Terkini</button>
                                        @else
                                            <button type="button" class="btn btn-outline-tertiary btn-sm"
                                                data-bs-toggle="modal" data-bs-id="{{ $jwtn->id_jawatan_dimohon }}"
                                                data-bs-target="#statusJawatan">Ubah Status</button>
                                        @endif
                                    </td>
                                </tr>

                                @php
                                    $k++;
                                @endphp
                            @endforeach
                        </table>
                    </div>
                </form>
                <div class="mt-3 text-end">
                    <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Status Terkini Jawatan-->
    <div class="modal fade" id="statusTerkiniJawatan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tindakan Terkini Permohonan Jawatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('kemaskini-status-tindakan-jawatan') }}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="container-fluid">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="mb-3">
                                <select onchange="checkOptions(this)" class="form-select" name="status_tindakan"
                                    id="status_tindakan" required>
                                    <option value="">SILA PILIH</option>
                                    @foreach ($senarai_tindakan as $st)
                                    <option value="{{  $st->id }}">{{  $st->tindakan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 mb-3">
                                    <input data-datepicker="" class="form-control" id="tarikh_tindakan"
                                        name="tarikh_tindakan" type="text" placeholder="dd/mm/yyyy" required>
                                </div>
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <textarea class="form-control" name="catatan_tindakan" id="catatan_tindakan" rows="3" placeholder="Catatan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Status Kelulusan Jawatan-->
    <div class="modal fade" id="statusJawatan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kemaskini Status Permohonan Jawatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('kemaskini-status-jawatan') }}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="container-fluid">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="mb-3">
                                <select onchange="checkOptions(this)" class="form-select" name="status" id="status"
                                    required>
                                    <option value="">SILA PILIH</option>
                                    <option value="LULUS">LULUS</option>
                                    <option value="DITOLAK">DITOLAK</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <input data-datepicker="" class="form-control" id="tarikh_lulus" name="tarikh_lulus"
                                        style="display: none" type="text" placeholder="dd/mm/yyyy">
                                </div>
                                <div class="col-xl-6">
                                    <input type="number" class="form-control" name="bilLulus" id="bilLulus"
                                        style="display: none" placeholder="Bilangan diluluskan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var statusJawatan = document.getElementById('statusJawatan');

        statusJawatan.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // var id = button.data('id');
            // Extract info from data-bs-* attributes
            let recipient = button.getAttribute('data-bs-whatever');
            let id = button.getAttribute('data-bs-id');

            // Use above variables to manipulate the DOM
            $(".modal-body #id").val(id);
        });
    </script>

    <script>
        var statusTerkiniJawatan = document.getElementById('statusTerkiniJawatan');

        statusTerkiniJawatan.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            let recipient = button.getAttribute('data-bs-whatever');
            let id = button.getAttribute('data-bs-id');

            // Use above variables to manipulate the DOM
            $(".modal-body #id").val(id);
        });
    </script>
    <script>
        var bilLulus;
        var tarikh_lulus;

        var serviceTypeInput = $('#status');

        serviceTypeInput.on('change', function() {

            bilLulus = $('#bilLulus');
            tarikh_lulus = $('#tarikh_lulus');

            if (serviceTypeInput.val() == "LULUS") {
                bilLulus.show();
                tarikh_lulus.show();
            } else {
                bilLulus.hide();
                tarikh_lulus.hide();
            }
        });
    </script>
@endsection
