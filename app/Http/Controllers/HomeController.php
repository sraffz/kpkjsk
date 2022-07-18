<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\User;
use App\JawatanDimohon;
use App\Permohonan;
use App\StatusTerkiniPermohonan;

use App\Rules\MatchOldPassword;
use Auth;
use Session;
use Hash;
use PDF;
// use Alert;

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
        $bil_jawatan_dimohon =  JawatanDimohon::sum('bil_jawatan');
        $bil_jawatan_lulus =  JawatanDimohon::where('status_permohonan_jawatan', 'LULUS')->sum('bil_diluluskan');
        $bil_tindakan = DB::table('jumlah_mengikut_tindakan_terkini')->sum('jumlah');
        
        $bil = DB::table('jumlah_mengikut_tindakan_terkini')->GET();

        return view('home', compact('bil', 'bil_jawatan_dimohon', 'bil_jawatan_lulus', 'bil_tindakan'));
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
    public function tukarKatalaluan(Request $req)
    {
        $req->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:8'],
            'confirm_new_password' => ['same:new_password'],
        ]);

        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($req->new_password),
        ]);

        // dd('Password change successfully.');
        Session::flash('message', 'Kata Laluan berjaya ditukar.'); 
        Session::flash('alert-class', 'success'); 

        return back();
    }

    public function tukarpassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:8'],
            'confirmpassword' => ['same:password'],
        ]);

        User::where('id', Auth::user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        // flash('Kata laluan telah ditukar.')->success();
        // Alert::Success('Makluman', 'Kata laluan telah ditukar.');
        Session::flash('message', 'Kata Laluan berjaya ditukar.'); 
        Session::flash('alert-class', 'success'); 

        return back();
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
        $skim = DB::table('skim')->get();
        $gred = DB::table('gred_gaji')->get();

        return view('pengguna.baru', compact('skim', 'gred'));
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

        Session::flash('message', 'Permohonan berjaya disimpan'); 
        Session::flash('alert-class', 'success'); 

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

        Session::flash('message', 'Maklumat dikemaskini'); 
        Session::flash('alert-class', 'success'); 

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

        Session::flash('message', 'Permohonan dipadam'); 
        Session::flash('alert-class', 'error'); 

        return back();
    }

    public function kemaskiniStatusJawatan(Request $req)
    {
        JawatanDimohon::where('id', $req->id)->update([
            'bil_diluluskan' => $req->bilLulus, 
            'tarikh_diluluskan' => $req->tarikh_lulus,
            'status_permohonan_jawatan' => $req->status
        ]);

        Session::flash('message', 'Maklumat dikemaskini'); 
        Session::flash('alert-class', 'success'); 

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

        Session::flash('message', 'Maklumat dikemaskini'); 
        Session::flash('alert-class', 'success'); 

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
        $jawatan = DB::table('senarai_jawatan_dipohon')->get();
        $permohonan = DB::table('senarai_permohonan_bil_jawatan')->get();

        return view('laporan.permohonan', compact('jawatan', 'permohonan'));
    }

    public function kemaskiniMaklumatDiri(Request $req)
    {
        User::where('id', Auth::user()->id)
        ->update([
            'name' => $req->nama,
            'email' => $req->email
        ]);

        Session::flash('message', 'Maklumat dikemaskini'); 
        Session::flash('alert-class', 'success'); 

        return back();
      }

    public function padamPengguna($id)
    {
        User::where('id', $id)->delete();

        Session::flash('message', 'Pengguna dipadam'); 
        Session::flash('alert-class', 'error'); 

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

        Session::flash('message', 'Maklumat dikemaskini'); 
        Session::flash('alert-class', 'success'); 

        return back();
        // return back()->with('message','Item created successfully!');
    }

    public function tambahPengguna(Request $req)
    {
        $user = new User;
        $user->name = $req->nama;
        $user->email = $req->email;
        $user->nokp = $req->nokp;
        $user->jawatan = $req->jawatan;
        $user->gred = $req->gred;
        $user->password = Hash::make($req->nokp);
        $user->save();

        Session::flash('message', 'Pengguna berjaya ditambah'); 
        Session::flash('alert-class', 'success'); 

        return redirect('/pengguna');
    }

    public function cetakLaporanTindakan()
    {
        $laporan = DB::table('laporan_terkini_tindakan')->get();
        $laporan_jumlah_jawatan = DB::table('jumlah_tindakan_skim')->get();

        $pdf = PDF::loadView('laporan.cetak.tindakan', compact('laporan', 'laporan_jumlah_jawatan'))->setPaper('a4', 'landscape');
        return $pdf->download('Laporan Tindakan Terkini Permohonan Jawatan.pdf');

     
    }
    public function cetakLaporanpermohonan()
    {
        $jawatan = DB::table('senarai_jawatan_dipohon')->get();
        $permohonan = DB::table('senarai_permohonan_bil_jawatan')->get();

        $pdf = PDF::loadView('laporan.cetak.permohonan', compact('jawatan', 'permohonan'))->setPaper('a4', 'landscape');
        return $pdf->download('Laporan Permohonan Keperluan Jawatan.pdf');

        // return view('laporan.cetak.permohonan', compact('jawatan', 'permohonan'));
    }
}
