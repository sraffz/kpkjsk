@extends('layouts.app', ['page' => 'pengguna'])

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
                    <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
                </ol>
            </nav>
            <h2 class="h4">Senarai Pengguna</h2>
            {{-- <p class="mb-0">Your web analytics dashboard template.</p> --}}
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="#" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Pengguna Baru
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                {{-- <button type="button" class="btn btn-sm btn-outline-gray-600">Kongsi</button> --}}
                {{-- <button type="button" class="btn btn-sm btn-outline-gray-600">Cetak</button> --}}
            </div>
        </div>
    </div>

    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-stripe table-bordered align-middle w-auto">
            <thead>
                <tr class="text-center align-middle ">
                    <th class="border-gray-200">#</th>
                    <th class="border-gray-200">Nama</th>
                    <th class="border-gray-200 ">Email</th>
                    <th class="border-gray-200  w-100">Jawatan <br> gred</th>
                    <th class="border-gray-200">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Item -->
                @php
                    $i = 1;
                @endphp
                @foreach ($users as $pengguna)
                    <tr class="text-center">
                        <td>
                            {{ $i++ }}
                        </td>
                        <td class="text-start">
                            {{ $pengguna->name }} <br>
                            {{ $pengguna->nokp }}
                        </td>
                        <td>
                            {{ $pengguna->email }}
                        </td>
                        <td>
                            {{ $pengguna->nama_jawatan }}
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-tertiary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#kemaskini" data-bs-id="{{ $pengguna->id }}"
                                    data-bs-id="{{ $pengguna->id }}" data-bs-gred="{{ $pengguna->gred }}"
                                    data-bs-nama="{{ $pengguna->name }}" data-bs-nokp="{{ $pengguna->nokp }}"
                                    data-bs-email="{{ $pengguna->email }}"
                                    data-bs-jawatan="{{ $pengguna->jawatan }}">Kemaskini</button>
                                <button type="button" class="btn btn-outline-danger btn-sm">Padam</button>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="kemaskini" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kemaskini-pengguna') }}" method="post">
                    <div class="modal-body">
                        <div class="container-fluid">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id" value="">
                            <div class="mb-2">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    aria-describedby="helpId" placeholder="Nama" value="">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    aria-describedby="helpId" placeholder="Nama" value="">
                            </div>
                            <div class="mb-2">
                                <label for="nokp" class="form-label">No Kad Pengenalan</label>
                                <input type="text" class="form-control" name="nokp" id="nokp"
                                    aria-describedby="helpId" placeholder="No Kad Pengenalan" value="">
                            </div>
                            <div class="mb-2">
                                <label for="jawatan" class="form-label">Jawatan</label>
                                <select class="form-select select2bs4" name="jawatan" id="jawatan"
                                      required>
                                    <option value="">Sila Pilih</option>
                                    @foreach ($skim as $skims)
                                        <option value="{{ $skims->id }}">
                                            {{ $skims->diskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="gred" class="form-label">Gred</label>
                                <select class="form-select select2bs4" name="gred" id="gred"
                                  required>
                                    <option value="">Sila Pilih</option>
                                    @foreach ($gred as $greds)
                                        <option value="{{ $greds->kod }}">
                                            {{ $greds->kod }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
   

    <script>
        var kemaskini = document.getElementById('kemaskini');

        kemaskini.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            let id = button.getAttribute('data-bs-id');
            let nama = button.getAttribute('data-bs-nama');
            let email = button.getAttribute('data-bs-email');
            let nokp = button.getAttribute('data-bs-nokp');
            let jawatan = button.getAttribute('data-bs-jawatan');
            let gred = button.getAttribute('data-bs-gred');

            // Use above variables to manipulate the DOM
            $(".modal-body #id").val(id);
            $(".modal-body #nama").val(nama);
            $(".modal-body #email").val(email);
            $(".modal-body #nokp").val(nokp);
            $(".modal-body #jawatan").val(jawatan);
            $(".modal-body #gred").val(gred);


        });
    </script>
@endsection
