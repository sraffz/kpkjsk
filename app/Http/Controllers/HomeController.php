<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\User;
use App\JawatanDimohon;
use App\Permohonan;
use App\StatusTerkiniPermohonan;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bil = DB::table('jumlah_mengikut_tindakan_terkini')->GET();

        return view('home', compact('bil'));
    }

    public function permohonan()
    {
        $jawatan = DB::table('senarai_jawatan_dipohon')->get();
        $permohonan = DB::table('senarai_permohonan_bil_jawatan')->get();

        return view('permohonan', compact('permohonan', 'jawatan'));
    }

    public function tetapan()
    {
        return view('tetapan');
    }

    public function pengguna()
    {
        $skim = DB::table('skim')->get();
        $gred = DB::table('gred_gaji')->get();

        $users = DB::table('senarai_pengguna')->get();

        return view('pengguna', compact('users', 'skim', 'gred'));
    }

    public function penggunaBaru()
    {
        return view('pengguna.baru');
    }

    public function permohonanbaru()
    {
        $skim = DB::table('skim')->get();
        $gred = DB::table('gred_gaji')->get();
        $jabatan = DB::table('jabatan')->get();

        return view('permohonan.baru', compact('skim', 'gred', 'jabatan'));
    }

    public function simpanPermohonanBaru(Request $req)
    {
        $id = Permohonan::insertGetId([
            'jabatan' => $req->jabatan,
            'no_rujukan_surat' => $req->no_rujukan_surat,
            'tarikh_surat' => \Carbon\Carbon::parse($req->tarikh_surat)->format('Y-m-d'),
            'tarikh_terima_surat' => \Carbon\Carbon::parse($req->tarikh_terima_surat)->format('Y-m-d'),
            'status_permohonan' => 'Baru',
            'catatan' => $req->catatan,
        ]);

        for ($i = 0; $i < count($req->addMoreInputFields); $i++) {
            $data = new JawatanDimohon();
            $data->id_permohonan = $id;
            $data->nama_jawatan = $req->input('addMoreInputFields.' . $i . '.jawatan');
            $data->gred_jawatan = $req->input('addMoreInputFields.' . $i . '.gred');
            $data->bil_jawatan = $req->input('addMoreInputFields.' . $i . '.bilangan');
            $data->penempatan = $req->input('addMoreInputFields.' . $i . '.penempatan');
            $data->status_permohonan_jawatan = 'Baru';
            $data->bil_diluluskan = 0;
            $data->catatan = '';
            $data->save();
        }

        return redirect('/permohonan');
    }

    public function permohonankemaskini($id)
    {
        $skim = DB::table('skim')->get();
        $gred = DB::table('gred_gaji')->get();
        $jabatan = DB::table('jabatan')->get();

        $permohonan = Permohonan::find($id);
        $jawatan = DB::table('senarai_jawatan_dipohon')
            ->where('id', $id)
            ->get();

        return view('permohonan.kemaskini', compact('skim', 'gred', 'jabatan', 'permohonan', 'jawatan'));
    }

    public function kemaskiniPermohonan(Request $req, $id)
    {
        $id_iklan = Permohonan::where('id', $id)->first();

        Permohonan::where('id', $id)->update([
            'jabatan' => $req->jabatan,
            'no_rujukan_surat' => $req->no_rujukan_surat,
            'tarikh_surat' => \Carbon\Carbon::parse($req->tarikh_surat)->format('Y-m-d'),
            'tarikh_terima_surat' => \Carbon\Carbon::parse($req->tarikh_terima_surat)->format('Y-m-d'),
            'catatan' => $req->catatan,
        ]);

        for ($i = 0; $i < count($req->addMoreInputFields); $i++) {
            $id_jawatan = $req->input('addMoreInputFields.' . $i . '.id_jawatan');

            $senarai = JawatanDimohon::where('id_permohonan', $id_iklan->id)->get();

            // dd($senarai ,$id_jawatan);

            if (empty($id_jawatan)) {
                $data = new JawatanDimohon();
                $data->id_permohonan = $id_iklan->id;
                $data->nama_jawatan = $req->input('addMoreInputFields.' . $i . '.jawatan');
                $data->gred_jawatan = $req->input('addMoreInputFields.' . $i . '.gred');
                $data->bil_jawatan = $req->input('addMoreInputFields.' . $i . '.bilangan');
                $data->penempatan = $req->input('addMoreInputFields.' . $i . '.penempatan');
                $data->status_permohonan_jawatan = 'Baru';
                $data->bil_diluluskan = 0;
                $data->catatan = '';
                $data->save();
            } else {
                JawatanDimohon::where('id', $id_jawatan)->update([
                    'nama_jawatan' => $req->input('addMoreInputFields.' . $i . '.jawatan'),
                    'gred_jawatan' => $req->input('addMoreInputFields.' . $i . '.gred'),
                    'bil_jawatan' => $req->input('addMoreInputFields.' . $i . '.bilangan'),
                    'penempatan' => $req->input('addMoreInputFields.' . $i . '.penempatan'),
                    // 'status_permohonan_jawatan' => 'Baru',
                    // 'bil_diluluskan' => 0,
                    'catatan' => '',
                ]);

                // JawatanDimohon::where('id', $sn->id)->delete();
            }
        }

        return back();
    }

    public function permohonanbutiran($id)
    {
        $skim = DB::table('skim')->get();
        $gred = DB::table('gred_gaji')->get();
        $jabatan = DB::table('jabatan')->get();

        $permohonan = Permohonan::find($id);
        $jawatan = DB::table('senarai_jawatan_dipohon')
            ->where('id', $id)
            ->get();

        $senarai_tindakan = DB::table('tindakan_permohonan')->get();
        
        $tindakan_jawatan = StatusTerkiniPermohonan::select('status_terkini_permohonan.*', 'tindakan_permohonan.tindakan')
        ->join('tindakan_permohonan', 'tindakan_permohonan.id', '=', 'status_terkini_permohonan.status_jawatan')
        ->get();

        $tindakan = DB::table('tindakan_terkini_jawatan')->get();

        return view('permohonan.butiran', compact('senarai_tindakan','skim', 'gred', 'jabatan', 'tindakan_jawatan', 'permohonan', 'jawatan', 'tindakan'));
    }

    public function permohonanpadam($id)
    {
        $jawatan = JawatanDimohon::where('id_permohonan', $id)->get();

        foreach ($jawatan as $jwt) {
            JawatanDimohon::where('id', $jwt->id)->delete();
        }

        Permohonan::where('id', $id)->delete();

        return back();
    }

    public function kemaskiniStatusJawatan(Request $req)
    {
        JawatanDimohon::where('id', $req->id)->update([
            'bil_diluluskan' => $req->bilLulus, 
            'tarikh_diluluskan' => $req->tarikh_lulus,
            'status_permohonan_jawatan' => $req->status
        ]);

        return back ();
    }

    public function kemaskiniStatusTindakanJawatan(Request $req)
    {
        // dd(\Carbon\Carbon::parse($req->tarikh_tindakan)->format('Y-m-d'));
        $data = new StatusTerkiniPermohonan;
        $data->id_jawatan_dipohon = $req->id;
        $data->status_jawatan = $req->status_tindakan;
        $data->tarikh = \Carbon\Carbon::parse($req->tarikh_tindakan)->format('Y-m-d');
        $data->catatan = $req->catatan_tindakan;
        $data->save();

        return back();
    }

    public function laporanTindakan()
    {
        $laporan = DB::table('laporan_terkini_tindakan')->get();
        $laporan_jumlah_jawatan = DB::table('jumlah_tindakan_skim')->get();

        return view('laporan.tindakan', compact('laporan', 'laporan_jumlah_jawatan'));
    }

    public function laporanPermohonan()
    {
        return view('laporan.permohonan');
    }

    public function kemaskiniMaklumatDiri(Request $req)
    {
        User::where('id', Auth::user()->id)
        ->update([
            'name' => $req->nama,
            'email' => $req->email
        ]);

        return back();
    }

    public function kemaskiniPengguna(Request $req)
    {
        $id = $req->id;

        User::where('id', $id)
        ->update([
            'name' => $req->nama,
            'email' => $req->email,
            'gred' => $req->gred,
            'jawatan' => $req->jawatan,
            'nokp' => $req->nokp
        ]);

        return back();
    }
}
