<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class guesthousecontroller extends Controller
{
    // Login / Logout
    public function periksalogin(Request $request)
    {
        $status = 0;
        $database = DB::table('users')->get();
        $form = array(
            'username' => $request->input('username'),
            'password' => $request->input('password')
        );

        $object = json_decode(json_encode($form), FALSE);

        foreach ($database as $database_m) {
            if ($object->username == $database_m->ID_USER_GUESTHOUSE && $object->password == $database_m->PASSWORD) {
                $status = 1;
                $tipe_user = DB::table('users')->select('JABATAN')->where('ID_USER_GUESTHOUSE', '=', $object->username)->first();
            }
        }

        if ($status == 1) {
            $request->session()->put('user', $object->username);
            $request->session()->put('tipe_user', $tipe_user->JABATAN);
            return Redirect::to('mainMenu');
        } else {
            return Redirect::to('/')->with('error', 'username tidak ditemukan');
        }
    }
    public function tampillogin()
    {
        return view('login');
    }
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->forget('success');
        return Redirect::to('/');
    }

    // Render Halaman
    public function tampilmainmenu()
    {
        return view('mainMenu');
    }
    public function tampil_tambah_keluhan()
    {
        $data = DB::table('master_kamar')->get();
        return view('tamu.tambahKeluhan')->with('data', $data);
    }
    public function master($loc, Request $request)
    {
        if ($request->session()->get('tipe_user') == 'USER') {
            return Redirect::to('mainMenu')->with('warning', 'Anda tidak memiliki hak akses');
        }
        $table = null;
        $data2 = null;
        if ($loc == 'Karyawan') {
            $table = "users";
        } else if ($loc == "TipeKamar") {
            $table = "master_tipe_kamar";
        } else if ($loc == "Kamar") {
            $table = "master_kamar";
            $table2 = "master_tipe_kamar";
            $data2 = DB::table($table2)->get();
        } else if ($loc == 'logout') {
            $request->session()->forget('success');
            return Redirect::to('/');
        }
        $data = DB::table($table)->get();
        return view('master.' . $loc)->with('data', $data)->with('table2', $data2);
    }
    public function reservasi($loc, Request $request)
    {
        $table = null;
        $id = null;
        $daftar_tipe_kamar = null;
        if ($loc == 'mainReservasi') {
            $table = "reservasi_sekarang";
            $daftar_tipe_kamar = DB::table('master_tipe_kamar as mtk')->get();
        } else if ($loc == "tambahReservasi") {
            $kolom = "ID_RESERVASI";
            $table = "reservasi_sekarang";
            $id = app('App\Http\Controllers\guesthousecontroller')->id_generator($table, $kolom);
            $daftar_tipe_kamar = DB::table('master_tipe_kamar as mtk')
                ->select('mtk.ID_TIPE_KAMAR', 'TIPE_KAMAR', 'HARGA_PER_MALAM', DB::raw('COUNT(DISTINCT(mk.ID_KAMAR)) AS JUMLAH, COUNT(DISTINCT(rs.ID_RESERVASI)) AS JUMLAH_RESERVASI'))
                ->leftjoin('master_kamar as mk', 'mtk.ID_TIPE_KAMAR', '=', 'mk.ID_TIPE_KAMAR')
                ->leftJoin('reservasi_sekarang as rs', 'rs.ID_TIPE_KAMAR', '=', 'mtk.ID_TIPE_KAMAR')
                ->where('mk.AVAILABILITY', '=', 'A')
                ->groupBy('mtk.ID_TIPE_KAMAR', 'TIPE_KAMAR', 'HARGA_PER_MALAM')
                ->get();
        } else if ($loc == 'logout') {
            $request->session()->forget('success');
            return Redirect::to('/');
        }
        $data = DB::table($table)->get();
        return view('reservasi.' . $loc)->with('data', $data)->with('master_tipe_kamar', $daftar_tipe_kamar)->with('id', $id);
    }
    public function tamu($loc, Request $request)
    {
        $table = null;
        $table2 = null;
        if ($loc == 'mainTamu') {
            $table = "tamu_sekarang";
            $table2 = DB::table('master_kamar as mk')->join('master_tipe_kamar as mtk', 'mtk.ID_TIPE_KAMAR', '=', 'mk.ID_TIPE_KAMAR')->get();
        } else if ($loc == "mainCheckIn") {
            $table = "reservasi_sekarang";
            $table2 = DB::table('master_tipe_kamar')->get();
        } else if ($loc == "mainCheckOut") {
            $table = "tamu_sekarang";
            $table2 = DB::table('master_kamar as mk')->join('master_tipe_kamar as mtk', 'mtk.ID_TIPE_KAMAR', '=', 'mk.ID_TIPE_KAMAR')->get();
        } else if ($loc == "mainKeluhan") {
            $table = "master_keluhan";
            $table2 = DB::table('master_kamar')->get();
        } else if ($loc == 'logout') {
            $request->session()->forget('success');
            return Redirect::to('/');
        }
        $data = DB::table($table)->get();
        return view('tamu.' . $loc)->with('data', $data)->with('master_tipe_kamar', $table2);
    }
    public function history($loc, Request $request)
    {
        if ($request->session()->get('tipe_user') == 'USER') {
            return Redirect::to('mainMenu')->with('warning', 'Anda tidak memiliki hak akses');
        }
        $table = null;
        $table2 = null;
        $data3 = null;
        if ($loc == 'historyReservasi') {
            $table = "history_reservasi";
        } else if ($loc == 'historyTamu') {
            $table = "history_tamu";
            $table_2 = "master_kamar";
            $table3 = "master_tipe_kamar";
            $table2 = DB::table($table3)->get();
            $data3 = DB::table($table_2)->get();
        } else if ($loc == 'historyKeluhan') {
            $table = "master_keluhan";
            $table2 = DB::table('master_kamar as mk')->join('master_tipe_kamar as mtk', 'mtk.ID_TIPE_KAMAR', '=', 'mk.ID_TIPE_KAMAR')->get();
        } else if ($loc == 'logout') {
            $request->session()->forget('success');
            return Redirect::to('/');
        }
        $data = DB::table($table)->get();
        return view('history.' . $loc)->with('data', $data)->with('master_tipe_kamar', $table2)->with('master_kamar', $data3);
    }
    public function tampil_konfirmasi($id_reservasi)
    {
        $data_reservasi = DB::table('reservasi_sekarang')->where('ID_RESERVASI', '=', $id_reservasi)->first();
        $daftar_kamar = DB::table('master_kamar')->where('AVAILABILITY', '=', 'A')->where('ID_TIPE_KAMAR', '=', $data_reservasi->ID_TIPE_KAMAR)->get();
        $nama_tipe_kamar = DB::table('master_tipe_kamar')->where('ID_TIPE_KAMAR', '=', $data_reservasi->ID_TIPE_KAMAR)->first();
        return view('tamu.konfirmasiKamar')
            ->with('daftar_kamar', $daftar_kamar)
            ->with('nama_tipe_kamar', $nama_tipe_kamar)
            ->with('id_reservasi', $id_reservasi);
    }
    public function tambahdata_karyawan() // Tampil Halaman Tambah Karyawan
    {
        return view('master.tambahKaryawan');
    }
    public function tambahdata_tipekamar() // Tampil Halaman Tambah Tipe Kamar
    {
        $jumlah_row = DB::table('master_tipe_kamar')->select(DB::raw('COUNT(*) as JML'))->first();
        if ($jumlah_row->JML == 0) {
            $id_kamar = (object) array('MAX_ID_NUMBER' => 'TP00000001');
        } else {
            // Generate ID Tipe Kamar
            $id_t = 0;
            $id = DB::table('master_tipe_kamar')
                ->select(DB::raw('CONVERT(SUBSTRING(ID_TIPE_KAMAR, 3), DECIMAL) AS ID_TIPE'))
                ->orderBy(DB::raw('CONVERT(SUBSTRING(ID_TIPE_KAMAR, 3), DECIMAL)'), 'desc')
                ->first();
            for ($i = 1; $i <= ($id->ID_TIPE + 1); $i++) {
                $id_t++;
                $idb = DB::table('master_tipe_kamar')
                    ->select(DB::raw('count(CONVERT(SUBSTRING(ID_TIPE_KAMAR, 3), DECIMAL)) as jumlah'))
                    ->where(DB::raw('CONVERT(SUBSTRING(ID_TIPE_KAMAR, 3), DECIMAL)'), '=', $id_t)
                    ->first();
                if ($idb->jumlah == 0) {
                    $i = $id->ID_TIPE + 1;
                }
            }
            $id_kamar = DB::table('master_tipe_kamar')->select(DB::raw('CONCAT("TP", LPAD(' . $id_t . ', 8, "0")) AS MAX_ID_NUMBER'))->first();
        }
        return view('master.tambahTipeKamar')->with('id_kamar', $id_kamar);
    }
    public function tambahdata_kamar() // Tampil Halaman Tambah Kamar
    {
        // Generate Nomor Kamar
        $idb = DB::table('master_kamar')
            ->select(DB::raw('count(NOMOR_KAMAR) as jumlah'))
            ->first();
        $id_t = 0;
        if ($idb->jumlah != 0) {
            $id = DB::table('master_kamar')
                ->select('NOMOR_KAMAR')
                ->orderBy('NOMOR_KAMAR', 'desc')
                ->first();
            for ($i = 1; $i <= ($id->NOMOR_KAMAR + 1); $i++) {
                $id_t++;
                $idb = DB::table('master_kamar')
                    ->select(DB::raw('count(NOMOR_KAMAR) as jumlah'))
                    ->where('NOMOR_KAMAR', '=', $id_t)
                    ->first();
                if ($idb->jumlah == 0) {
                    $i = $id->NOMOR_KAMAR + 1;
                }
            }
        } else {
            $id_t = 1;
        }
        $daftar_tipe_kamar = DB::table('master_tipe_kamar')->get();

        $jumlah_row = DB::table('master_kamar')->select(DB::raw('COUNT(*) as JML'))->first();
        if ($jumlah_row->JML == 0) {
            $id_kamar = (object) array('MAX_ID_NUMBER' => 'KM001');
        } else {
            // Generate ID Tipe Kamar
            $id_t = 0;
            $id = DB::table('master_kamar')
                ->select(DB::raw('CONVERT(SUBSTRING(ID_KAMAR, 3), DECIMAL) AS ID_TIPE'))
                ->orderBy(DB::raw('CONVERT(SUBSTRING(ID_KAMAR, 3), DECIMAL)'), 'desc')
                ->first();
            for ($i = 1; $i <= ($id->ID_TIPE + 1); $i++) {
                $id_t++;
                $idb = DB::table('master_kamar')
                    ->select(DB::raw('count(CONVERT(SUBSTRING(ID_KAMAR, 3), DECIMAL)) as jumlah'))
                    ->where(DB::raw('CONVERT(SUBSTRING(ID_KAMAR, 3), DECIMAL)'), '=', $id_t)
                    ->first();
                if ($idb->jumlah == 0) {
                    $i = $id->ID_TIPE + 1;
                }
            }
            $id_kamar = DB::table('master_kamar')->select(DB::raw('CONCAT("KM", LPAD(' . $id_t . ', 3, "0")) AS MAX_ID_NUMBER'))->first();
        }
        return view('master.tambahKamar')->with('id_kamar', $id_kamar)->with('nomor_kamar', $id_t)->with('daftar_tipe_kamar', $daftar_tipe_kamar);
    }
    public function tampil_edit_karyawan($id_user) // Tampil Halaman Detail Karyawan
    {
        $jumlah = DB::table('users')->select(DB::raw('count(*) as jumlah'))->first();
        $data = DB::table('users')->where('ID_USER_GUESTHOUSE', '=', $id_user)->get();
        return view('master.detailKaryawan')
            ->with('data_b', $data)
            ->with('jumlah', $jumlah);
    }
    public function tampil_edit_tipekamar($id_kamar) // Tampil Halaman Detail Tipe Kamar
    {
        $data = DB::table('master_tipe_kamar')->where('ID_TIPE_KAMAR', '=', $id_kamar)->get();
        return view('master.detailTipeKamar')
            ->with('data_b', $data);
    }
    public function tampil_edit_kamar($id_kamar) // Tampil Halaman Detail Kamar
    {
        $daftar_tipe_kamar = DB::table('master_tipe_kamar')->get();
        $data = DB::table('master_kamar')->where('ID_KAMAR', '=', $id_kamar)->get();
        return view('master.detailKamar')
            ->with('data_b', $data)
            ->with('daftar_tipe_kamar', $daftar_tipe_kamar);
    }
    public function tampil_edit_reservasi($id_reservasi) // Tampil Halaman Detail Reservasi
    {
        $daftar_tipe_kamar = DB::table('master_tipe_kamar')->get();
        $data = DB::table('reservasi_sekarang')->where('ID_RESERVASI', '=', $id_reservasi)->first();
        return view('reservasi.editReservasi')
            ->with('data_b', $data)
            ->with('daftar_tipe_kamar', $daftar_tipe_kamar);
    }
    public function tampil_edit_checkout($id_tamu) // Tampil Halaman Detail CheckOut
    {
        $data = DB::table('tamu_sekarang')->where('ID_TAMU', '=', $id_tamu)->first();
        $daftar_tipe_kamar = DB::table('master_kamar as mk')->join('master_tipe_kamar as mtk', 'mtk.ID_TIPE_KAMAR', '=', 'mk.ID_TIPE_KAMAR')->where('mk.ID_KAMAR', '=', $data->ID_KAMAR)->first();
        return view('tamu.konfirmasiCheckOut')
            ->with('data_b', $data)
            ->with('daftar_tipe_kamar', $daftar_tipe_kamar);
    }
    public function historyreservasi_filter(Request $request)
    {
        $tanggal = array(
            'tgl_awal' => $request->input('tgl_awal'),
            'tgl_akhir' => $request->input('tgl_akhir')
        );
        $object = json_decode(json_encode($tanggal), FALSE);
        if ($request->input('tgl_awal') == $request->input('tgl_akhir')) {
            $data = DB::table('history_reservasi')->where('HISTORY_TANGGAL_PEMESANAN', $request->input('tgl_awal'))->get();
        } else {
            $data = DB::table('history_reservasi')->whereBetween('HISTORY_TANGGAL_PEMESANAN', [$request->input('tgl_awal'), $request->input('tgl_akhir')])->get();
        }
        return view('history.historyReservasi')->with('data', $data)->with('tanggal', $object);
    }
    public function historykeluhan_filter(Request $request)
    {
        $tanggal = array(
            'tgl_awal' => $request->input('tgl_awal'),
            'tgl_akhir' => $request->input('tgl_akhir')
        );
        $object = json_decode(json_encode($tanggal), FALSE);
        $table2 = DB::table('master_kamar as mk')->join('master_tipe_kamar as mtk', 'mtk.ID_TIPE_KAMAR', '=', 'mk.ID_TIPE_KAMAR')->get();
        if ($request->input('tgl_awal') == $request->input('tgl_akhir')) {
            $data = DB::table('master_keluhan')->where('TANGGAL_KELUHAN', $request->input('tgl_awal'))->get();
        } else {
            $data = DB::table('master_keluhan')->whereBetween('TANGGAL_KELUHAN', [$request->input('tgl_awal'), $request->input('tgl_akhir')])->get();
        }
        return view('history.historyKeluhan')->with('data', $data)->with('master_tipe_kamar', $table2)->with('tanggal', $object);
    }
    public function historytamu_filter(Request $request)
    {
        $tanggal = array(
            'tgl_awal' => $request->input('tgl_awal'),
            'tgl_akhir' => $request->input('tgl_akhir')
        );
        $object = json_decode(json_encode($tanggal), FALSE);
        $table_2 = "master_kamar";
        $table3 = "master_tipe_kamar";
        $table2 = DB::table($table3)->get();
        $data3 = DB::table($table_2)->get();
        if ($request->input('tgl_awal') == $request->input('tgl_akhir')) {
            $data = DB::table('history_tamu')->where('HISTORY_TANGGAL_CHECK_OUT', $request->input('tgl_awal'))->get();
        } else {
            $data = DB::table('history_tamu')->whereBetween('HISTORY_TANGGAL_CHECK_OUT', [$request->input('tgl_awal'), $request->input('tgl_akhir')])->get();
        }
        return view('history.historyTamu')->with('data', $data)->with('tanggal', $object)->with('master_tipe_kamar', $table2)->with('master_kamar', $data3);
    }
    public function cetak_historyReservasi(Request $request)
    {
        $tanggal = array(
            'tgl_awal' => $request->input('tgl_awal_tempt'),
            'tgl_akhir' => $request->input('tgl_akhir_tempt')
        );
        $object = json_decode(json_encode($tanggal), FALSE);
        if (isset($object->tgl_awal) && isset($object->tgl_akhir)) {
            $data = DB::table('history_reservasi')->whereBetween('HISTORY_TANGGAL_PEMESANAN', [$object->tgl_awal, $object->tgl_akhir])->get();
        } else {
            $data = DB::table('history_reservasi')->get();
        }
        return view('history.print.printReservasi')->with('data', $data)->with('tanggal', $object);
    }
    public function cetak_historyTamu(Request $request)
    {
        $tanggal = array(
            'tgl_awal' => $request->input('tgl_awal_tempt'),
            'tgl_akhir' => $request->input('tgl_akhir_tempt')
        );
        $object = json_decode(json_encode($tanggal), FALSE);
        $history_reservasi = DB::table('history_reservasi')->get();
        if (isset($object->tgl_awal) && isset($object->tgl_akhir)) {
            $data = DB::table('history_tamu')->whereBetween('HISTORY_TANGGAL_CHECK_OUT', [$object->tgl_awal, $object->tgl_akhir])->get();
        } else {
            $data = DB::table('history_tamu')->get();
        }
        return view('history.print.printTamu')->with('data', $data)->with('tanggal', $object)->with('history_reservasi', $history_reservasi);
    }

    // Function Action
    public function actionedit_karyawan(Request $request)
    {
        $form = array(
            'PASSWORD' => $request->input('password'),
            'JABATAN' => $request->input('tipeuser')
        );
        DB::table('users')->where('ID_USER_GUESTHOUSE', '=', $request->input('username'))->update($form);
        return Redirect::to('master/Karyawan');
    }
    public function actionedit_tipekamar(Request $request)
    {
        $form = array(
            'TIPE_KAMAR' => $request->input('tipekamar'),
            'HARGA_PER_MALAM' => $request->input('hargatipekamar'),
            'DESKRIPSI_TIPE_KAMAR' => $request->input('deskripsitipekamar')
        );
        DB::table('master_tipe_kamar')->where('ID_TIPE_KAMAR', '=', $request->input('idtipekamar'))->update($form);
        return Redirect::to('master/TipeKamar');
    }
    public function actionedit_kamar(Request $request)
    {
        $form = array(
            'ID_TIPE_KAMAR' => $request->input('tipe_kamar'),
            'NOMOR_KAMAR' => $request->input('nomorKamar'),
            'DESKRIPSI_KAMAR' => $request->input('deskripsiKamar'),
            'AVAILABILITY' => $request->input('kamar_avail')
        );
        DB::table('master_kamar')->where('ID_KAMAR', '=', $request->input('idKamar'))->update($form);
        return Redirect::to('master/Kamar');
    }
    public function actionedit_reservasi(Request $request)
    {
        if ($request->input('lunas') == null) {
            $dp = 'belum';
        } else {
            $dp = 'lunas';
        }

        $form = array(
            'STATUS_DP' => $dp
        );
        DB::table('reservasi_sekarang')->where('ID_RESERVASI', '=', $request->input('idReservasi'))->update($form);
        return Redirect::to('reservasi/mainReservasi');
    }
    public function actionhapus_karyawan($id)
    {
        try {
            DB::table('users')->where('ID_USER_GUESTHOUSE', '=', $id)->delete();
        } catch (\Illuminate\Database\QueryException $th) {
            $warning = "Data telah dipakai";
            return Redirect::to('master/Karyawan/Edit/' . $id)->with('warning', $warning);
        }
        return Redirect::to('master/Karyawan');
    }
    public function actionhapus_tipekamar($id)
    {
        try {
            DB::table('master_tipe_kamar')->where('ID_TIPE_KAMAR', '=', $id)->delete();
        } catch (\Illuminate\Database\QueryException $th) {
            $warning = "Data telah dipakai";
            return Redirect::to('master/TipeKamar/Edit/' . $id)->with('warning', $warning);
        }
        return Redirect::to('master/TipeKamar');
    }
    public function actionhapus_kamar($id)
    {
        try {
            DB::table('master_kamar')->where('ID_KAMAR', '=', $id)->delete();
        } catch (\Illuminate\Database\QueryException $th) {
            $warning = "Data telah dipakai";
            return Redirect::to('master/Kamar/Edit/' . $id)->with('warning', $warning);
        }
        return Redirect::to('master/Kamar');
    }
    public function actionhapus_keluhan($id)
    {
        try {
            DB::table('master_keluhan')->where('ID_KELUHAN', '=', $id)->delete();
        } catch (\Illuminate\Database\QueryException $th) {
            $warning = "Data telah dipakai";
            return Redirect::to('tamu/mainKeluhan')->with('warning', $warning);
        }
        return Redirect::to('tamu/mainKeluhan');
    }
    public function actionhapus_reservasi($id)
    {
        try {
            $data = DB::table('reservasi_sekarang')->where('ID_RESERVASI', '=', $id)->first();
            $data_lama = array(
                'ID_HISTORY_RESERVASI' => $data->ID_RESERVASI,
                'HISTORY_NAMA_PEMESAN' => $data->NAMA_PEMESAN,
                'HISTORY_TANGGAL_PEMESANAN' => $data->TANGGAL_PEMESANAN,
                'HISTORY_TANGGAL_CHECK_IN' => $data->TANGGAL_CHECK_IN,
                'HISTORY_TANGGAL_CHECK_OUT' => $data->TANGGAL_CHECK_OUT,
                'TOTAL_PEMBAYARAN' => $data->TOTAL_PEMBAYARAN,
                'STATUS_RESERVASI' => 'gagal'
            );
            DB::table('history_reservasi')->insert($data_lama);
            DB::table('reservasi_sekarang')->where('ID_RESERVASI', '=', $id)->delete();
        } catch (\Illuminate\Database\QueryException $th) {
            $warning = "Data telah dipakai";
            return Redirect::to('reservasi/Edit/' . $id)->with('warning', $warning);
        }
        return Redirect::to('reservasi/mainReservasi');
    }
    public function actioncetak_reservasi($id)
    {
        $data = DB::table('reservasi_sekarang')->where('ID_RESERVASI', '=', $id)->first();
        $kamar = DB::table('master_tipe_kamar')->select('TIPE_KAMAR', 'HARGA_PER_MALAM')->where('ID_TIPE_KAMAR', '=', $data->ID_TIPE_KAMAR)->first();
        return view('reservasi.cetak')->with('data', $data)->with('kamar', $kamar);
    }
    public function actiontambah_karyawan(Request $request)
    {
        $form = array(
            'ID_USER_GUESTHOUSE' => $request->input('username'),
            'PASSWORD' => $request->input('password'),
            'JABATAN' => $request->input('tipeuser')
        );

        DB::table('users')->insert($form);

        return Redirect::to('master/Karyawan');
    }
    public function actiontambah_kamar(Request $request)
    {
        $form = array(
            'ID_KAMAR' => $request->input('idKamar'),
            'ID_TIPE_KAMAR' => $request->input('tipe_kamar'),
            'NOMOR_KAMAR' => $request->input('nomorKamar'),
            'DESKRIPSI_KAMAR' => $request->input('deskripsiKamar'),
            'AVAILABILITY' => $request->input('kamar_avail')
        );

        DB::table('master_kamar')->insert($form);

        return Redirect::to('master/Kamar');
    }
    public function actiontambah_tipekamar(Request $request)
    {
        $form = array(
            'ID_TIPE_KAMAR' => $request->input('idtipekamar'),
            'TIPE_KAMAR' => $request->input('tipekamar'),
            'HARGA_PER_MALAM' => $request->input('hargatipekamar'),
            'DESKRIPSI_TIPE_KAMAR' => $request->input('deskripsitipekamar')
        );

        DB::table('master_tipe_kamar')->insert($form);

        return Redirect::to('master/TipeKamar');
    }
    public function actiontambah_keluhan(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tanggal = date_create(date("Y-m-d"));
        $table = "master_keluhan";
        $kolom = "ID_KELUHAN";
        $id = app('App\Http\Controllers\guesthousecontroller')->id_generator($table, $kolom);
        $form = array(
            'ID_KELUHAN' => $id,
            'ID_KAMAR' => $request->input('no_kamar'),
            'NAMA_TAMU' => $request->input('namaTamu'),
            'TANGGAL_KELUHAN' => $tanggal,
            'KELUHAN' => $request->input('keluhan')
        );
        DB::table('master_keluhan')->insert($form);

        return Redirect::to('tamu/mainKeluhan');
    }
    public function actiontambah_reservasi(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $tenggat = date_create(date("Y-m-d H:i:s"));
        date_add($tenggat, date_interval_create_from_date_string("1 days"));

        $status_dp = null;
        if ($request->input('lunas')) {
            $status_dp = "lunas";
        } else {
            $status_dp = "belum";
        }

        $form = array(
            'ID_RESERVASI' => $request->input('idReservasi'),
            'ID_USER_GUESTHOUSE' => $request->session()->get('user'),
            'ID_TIPE_KAMAR' => $request->input('tipe_kamar'),
            'NAMA_PEMESAN' => $request->input('nama'),
            'NOMOR_TELEPON' => $request->input('noTelp'),
            'NIK_RESERVASI' => $request->input('NIK'),
            'TANGGAL_PEMESANAN' => date("Y-m-d H:i:s"),
            'TANGGAL_CHECK_IN' => $request->input('checkIn'),
            'TANGGAL_CHECK_OUT' => $request->input('checkOut'),
            'TENGGAT_PEMBAYARAN' => date_format($tenggat, "Y-m-d H:i:s"),
            'TOTAL_PEMBAYARAN' => $request->input('harga_menginap'),
            'STATUS_DP' => $status_dp
        );
        DB::table('reservasi_sekarang')->insert($form);

        return Redirect::to('reservasi/mainReservasi');
    }
    public function tamu_berhasil_checkin($id_reservasi, $id_kamar)
    {
        // Step 1
        $data = DB::table('reservasi_sekarang')->where('ID_RESERVASI', '=', $id_reservasi)->first();
        $data_lama = array(
            'ID_HISTORY_RESERVASI' => $data->ID_RESERVASI,
            'HISTORY_NAMA_PEMESAN' => $data->NAMA_PEMESAN,
            'HISTORY_TANGGAL_PEMESANAN' => $data->TANGGAL_PEMESANAN,
            'HISTORY_TANGGAL_CHECK_IN' => $data->TANGGAL_CHECK_IN,
            'HISTORY_TANGGAL_CHECK_OUT' => $data->TANGGAL_CHECK_OUT,
            'TOTAL_PEMBAYARAN' => $data->TOTAL_PEMBAYARAN,
            'STATUS_RESERVASI' => 'masuk'
        );
        DB::table('history_reservasi')->insert($data_lama);

        // Step 2
        $table = "tamu_sekarang";
        $kolom = "ID_TAMU";
        $id = app('App\Http\Controllers\guesthousecontroller')->id_generator($table, $kolom);
        $data_tamu = array(
            'ID_TAMU' => $id,
            'ID_HISTORY_RESERVASI' => $data->ID_RESERVASI,
            'ID_KAMAR' => $id_kamar,
            'NAMA_TAMU' => $data->NAMA_PEMESAN,
            'NIK' => $data->NIK_RESERVASI,
            'NOMOR_TELEPON' => $data->NOMOR_TELEPON,
            'TANGGAL_CHECK_IN' => $data->TANGGAL_CHECK_IN,
            'TANGGAL_CHECK_OUT' => $data->TANGGAL_CHECK_OUT,
        );
        DB::table('tamu_sekarang')->insert($data_tamu);

        // Step 3
        DB::table('reservasi_sekarang')->where('ID_RESERVASI', '=', $id_reservasi)->delete();

        // Step 4
        $availability = array(
            'AVAILABILITY' => 'U'
        );
        DB::table('master_kamar')->where('ID_KAMAR', '=', $id_kamar)->update($availability);
        return Redirect::to('tamu/mainCheckIn');
    }
    public function tamu_berhasil_checkout(Request $request)
    {
        // Step 1
        $data_tamu_lama = DB::table('tamu_sekarang')->where('ID_TAMU', '=', $request->input('idTamu'))->first();
        $history_tamu = array(
            'ID_HISTORY_TAMU' => $data_tamu_lama->ID_TAMU,
            'ID_KAMAR' => $data_tamu_lama->ID_KAMAR,
            'ID_HISTORY_RESERVASI' => $data_tamu_lama->ID_HISTORY_RESERVASI,
            'HISTORY_NAMA_TAMU' => $data_tamu_lama->NAMA_TAMU,
            'HISTORY_NIK' => $data_tamu_lama->NIK,
            'HISTORY_NOMOR_TELEPON' => $data_tamu_lama->NOMOR_TELEPON,
            'HISTORY_TANGGAL_CHECK_IN' => $data_tamu_lama->TANGGAL_CHECK_IN,
            'HISTORY_TANGGAL_CHECK_OUT' => $data_tamu_lama->TANGGAL_CHECK_OUT,
            'HISTORY_DENDA' => $request->input('denda')
        );
        DB::table('history_tamu')->insert($history_tamu);

        // Step 2
        $availability = array(
            'AVAILABILITY' => 'A'
        );
        DB::table('master_kamar')->where('ID_KAMAR', '=', $data_tamu_lama->ID_KAMAR)->update($availability);

        // Step 3
        DB::table('tamu_sekarang')->where('ID_TAMU', '=', $request->input('idTamu'))->delete();
        return Redirect::to('tamu/mainCheckOut');
    }

    // Function ID Generator
    public function id_generator($table, $kolom)
    {
        //ID Generator Tabel Produk
        $stat = 0;
        $id_p = '';
        while ($stat == 0) {
            //5 First Char
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $length = 5;
            $charactersLength = strlen($characters);
            $randomString_string = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString_string .= $characters[rand(0, $charactersLength - 1)];
            }

            //5 Last Dig.
            $characters = '0123456789';
            $length = 5;
            $charactersLength = strlen($characters);
            $randomString_number = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString_number .= $characters[rand(0, $charactersLength - 1)];
            }

            $id_p = $randomString_string . $randomString_number;

            $idb = DB::table($table)
                ->select(DB::raw('count(' . $kolom . ') as jumlah'))
                ->where($kolom, '=', $id_p)
                ->first();

            if ($idb->jumlah == 0) {
                $stat = 1;
            }
        }

        return $id_p;
    }
}
