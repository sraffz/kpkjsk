@extends('layouts.app', ['page' => 'Laporan Tindakan'])

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Permohonan</li>
                </ol>
            </nav>
            <h2 class="h4">Laporan Permohonan</h2>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('permohonan.baru') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Permohonan Baru
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Cetak</button>
            </div>
        </div>
    </div>

    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-stripe table-bordered align-middle datatables" style="width: 100%">
            <thead class="thead-light">
                <tr class="text-center align-middle">
                    <th class="border-gray-200">#</th>
                    <th class="border-gray-200 ">Jabatan/Agensi</th>
                    <th class="border-gray-200">Jawatan</th>
                    <th class="border-gray-200 ">Jumlah <br> Permohonan</th>
                    <th class="border-gray-200 ">Jumlah <br> Diluluskan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($jawatan as $jawatans)
                    <tr>
                        <td> {{ $i++ }} </td>
                        <td> {{ $jawatans->nama_jabatan }} <br>
                            No. Ruj : {{ $jawatans->no_rujukan_surat }} <br> Tarikh Permohonan :
                            {{ \Carbon\Carbon::parse($jawatans->tarikh_surat)->format('d-m-Y') }}<br>
                            Tarikh Terima :
                            {{ \Carbon\Carbon::parse($jawatans->tarikh_terima_surat)->format('d-m-Y') }}
                        </td>
                        <td class="flex-sm-wrap"> {{ $jawatans->nama_skim }} </td>
                        {{-- <td> {{ $jawatans->gred }}</td> --}}
                        <td class="text-center"> {{ $jawatans->bil_jawatan }} </td>
                        <td class="text-center">
                            {{-- {{ $jawatans->status_permohonan_jawatan }} --}}
                            @if ($jawatans->status_permohonan_jawatan == 'LULUS')
                                {{ $jawatans->bil_diluluskan }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                {{-- @foreach ($permohonan as $permohonans)
                    @php $first = true; @endphp
                    @php $sec = true; @endphp
                    @foreach ($jawatan as $jawatans)
                        @if ($permohonans->id == $jawatans->id)
                            <tr>
                                @if ($first == true)
                                    <td rowspan="{{ $permohonans->bil_jawatan }}"> {{ $i++ }} </td>
                                    <td rowspan="{{ $permohonans->bil_jawatan }}"> {{ $permohonans->nama_jabatan }} <br>
                                        No. Ruj : {{ $permohonans->no_rujukan_surat }} <br> Tarikh Permohonan :
                                        {{ \Carbon\Carbon::parse($permohonans->tarikh_surat)->format('d-m-Y') }}<br>
                                        Tarikh Terima :
                                        {{ \Carbon\Carbon::parse($permohonans->tarikh_terima_surat)->format('d-m-Y') }}
                                    </td>
                                    @php $first = false; @endphp
                                @endif
                                <td class="flex-sm-wrap"> {{ $jawatans->nama_skim }} </td>
                <td class="text-center"> {{ $jawatans->bil_jawatan }} </td>
                <td class="text-center">
                    @if ($jawatans->status_permohonan_jawatan == 'LULUS')
                        {{ $jawatans->bil_diluluskan }}
                    @endif
                </td>
                </tr>
                @endif
                @endforeach
                @endforeach  --}}
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script>
        $('#basic-usage').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@endsection
