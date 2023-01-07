@extends('layouts.app', ['page' => 'permohonan'])

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
                    {{-- <li class="breadcrumb-item"><a href="#">Halama Utama</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Permohonan</li>
                </ol>
            </nav>
            <h2 class="h4">Senarai Permohonan</h2>
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
                {{-- <button type="button" class="btn btn-sm btn-outline-gray-600">Kongsi</button> --}}
                {{-- <button type="button" class="btn btn-sm btn-outline-gray-600">Cetak</button> --}}
             </div>
        </div>
    </div>
    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-stripe table-bordered align-middle datatables" style="width: 100%">
            <thead class="thead-light">
                <tr class="text-center align-middle">
                    <th class="border-gray-200">Bil</th>
                    <th class="border-gray-200">Jabatan</th>
                    <th class="border-gray-200 ">Jawatan Dipohon</th>
                    {{-- <th class="border-gray-200">Gred</th> --}}
                    <th class="border-gray-200">Bilangan <br> Permohonan</th>
                    <th class="border-gray-200">Status</th>
                    <th class="border-gray-200">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Item -->
                @php
                    $i = 1;
                @endphp
                @foreach ($permohonan as $permohonans)
                    @php $first = true; @endphp
                    @php $sec = true; @endphp
                    @foreach ($jawatan as $jawatans)
                        @if ($permohonans->id == $jawatans->id)
                            <tr>
                                @if ($first == true)
                                    <td rowspan="{{ $permohonans->bil_jawatan }}"> {{ $i++ }} </td>
                                    <td rowspan="{{ $permohonans->bil_jawatan }}"> {{ $permohonans->nama_jabatan }} <br> {{ $permohonans->no_rujukan_surat }}</td>
                                    @php $first = false; @endphp
                                @endif

                                <td class="flex-sm-wrap"> {{ $jawatans->nama_skim }} </td>
                                {{-- <td> {{ $jawatans->gred }}</td> --}}
                                <td class="text-center"> {{ $jawatans->bil_jawatan }} </td>
                                <td class="text-center"> {{ $jawatans->status_permohonan_jawatan }} 
                                    @if ($jawatans->status_permohonan_jawatan == 'LULUS')
                                    ({{ $jawatans->bil_diluluskan }})
                                    @endif 
                                </td>

                                @if ($sec == true)
                                    <td rowspan="{{ $permohonans->bil_jawatan }}" style="vertical-align: middle" class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="icon icon-sm">
                                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span class="visually-hidden">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu py-0">
                                                <a class="dropdown-item rounded-top" href="{{ url('permohonan-butiran', [$permohonans->id]) }}"><span
                                                        class="fas fa-eye me-2"></span>Maklumat Terperinci</a>
                                                <a class="dropdown-item" href="{{ url('permohonan-kemaskini', [$permohonans->id]) }}"><span
                                                        class="fas fa-edit me-2"></span>Kemaskini</a>
                                                <a class="dropdown-item text-danger rounded-bottom" href="{{ url('permohonan-padam', [$permohonans->id]) }}" onclick="return confirm('Padam permohonan ini?')"><span class="fas fa-trash-alt me-2"></span>Padam</a>
                                            </div>
                                        </div>
                                    </td>
                                @php $sec = false; @endphp
                                @endif
                                
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                <!-- Item -->
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script>
        $( '#basic-usage' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
 
    </script>
@endsection