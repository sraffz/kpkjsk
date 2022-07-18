<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Permohonan Jawatan</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<style>
    .table thead th {
        background-color: #437786;
        color: white;
        font-size: 13px;
        vertical-align: middle;
    }

    .table tfoot th {
        font-size: 14px;
    }

    .table tbody td {
        font-size: 12px;
    }
</style>

<body>
    <div class="text-center">
        <h4><strong> LAPORAN PERMOHONAN KEPERLUAN JAWATAN</strong></h4>
    </div>
    <div class="text-center" style="text-transform: uppercase">
        <h5><strong></strong></h5>
    </div> <br>
    <table class="table table-stripe table-bordered" style="width: 100%">
        <thead>
            <tr class="text-center text-uppercase">
                <th class="border-gray-200">Bil</th>
                <th class="border-gray-200">Jabatan</th>
                <th class="border-gray-200 ">Jawatan Dipohon</th>
                {{-- <th class="border-gray-200">Gred</th> --}}
                <th class="border-gray-200">Bilangan <br> Permohonan</th>
                <th class="border-gray-200">Status</th>
                <th class="border-gray-200">Bilangan <br> Diluluskan</th>
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
                                <td rowspan="{{ $permohonans->bil_jawatan }}"> {{ $permohonans->nama_jabatan }} <br> 
                                    No. Ruj : {{ $permohonans->no_rujukan_surat }} <br> Tarikh Permohonan :
                                    {{ \Carbon\Carbon::parse($permohonans->tarikh_surat)->format('d-m-Y') }}<br>
                                    Tarikh Terima :
                                    {{ \Carbon\Carbon::parse($permohonans->tarikh_terima_surat)->format('d-m-Y') }}
                                </td>
                                @php $first = false; @endphp
                            @endif
                            <td class="flex-sm-wrap"> {{ $jawatans->nama_skim }} </td>
                            {{-- <td> {{ $jawatans->gred }}</td> --}}
                            <td class="text-center"> {{ $jawatans->bil_jawatan }} </td>
                            <td class="text-center"> {{ $jawatans->status_permohonan_jawatan }} </td>
                            <td class="text-center">
                                {{ $jawatans->bil_diluluskan }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            <!-- Item -->
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
