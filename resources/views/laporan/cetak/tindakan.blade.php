<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Tindakan</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<style>
    .table thead th {
        background-color: #437786;
        color: white;
        font-size: 13px;
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
        <h4><strong> LAPORAN TINDAKAN TERKINI </strong></h4>
    </div>
    <div class="text-center" style="text-transform: uppercase">
        <h5><strong>PERMOHONAN JAWATAN</strong></h5>
    </div> <br>
    <table class="table table-stripe table-bordered align-middle datatables" style="width: 100%">
        <thead  >
            <tr class="text-center text-uppercase">
                <th class="border-gray-200">Bil</th>
                <th class="border-gray-200">Jawatan & Gred</th>
                <th class="border-gray-200 ">Iklan</th>
                <th class="border-gray-200">Ujian</th>
                <th class="border-gray-200">Ujian Fizikal</th>
                <th class="border-gray-200">Temuduga</th>
                {{-- <th class="border-gray-200">diLantik</th> --}}
                <th class="border-gray-200">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($laporan_jumlah_jawatan as $ljj)
                <tr class="text-center text-lg">
                    <td>
                        {{ $i++ }}
                    </td>
                    <td class="text-left">
                        {{ $ljj->nama_jawatan }}
                    </td>
                    <td>
                        @foreach ($laporan as $lprn)
                            @if ($lprn->id_tindakan == 1 && $lprn->id == $ljj->id)
                                {{ $lprn->jumlah }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($laporan as $lprn)
                            @if ($lprn->id_tindakan == 2 && $lprn->id == $ljj->id)
                                {{ $lprn->jumlah }}
                            @endif
                        @endforeach
                    </td>
                    <td>

                        @foreach ($laporan as $lprn)
                            @if ($lprn->id_tindakan == 3 && $lprn->id == $ljj->id)
                                {{ $lprn->jumlah }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($laporan as $lprn)
                            @if ($lprn->id_tindakan == 4 && $lprn->id == $ljj->id)
                                {{ $lprn->jumlah }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        {{ $ljj->jumlah }}
                    </td>
                </tr>
            @endforeach
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
