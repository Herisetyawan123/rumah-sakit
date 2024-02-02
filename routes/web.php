<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\Cms\BankController;
use App\Http\Controllers\Cms\DetailTransaksiObatController;
use App\Http\Controllers\Cms\KasirController;
use App\Http\Controllers\Cms\RolesController;
use App\Http\Controllers\Cms\DokterController;
use App\Http\Controllers\Cms\ExportController;
use App\Http\Controllers\Cms\PasienController;
use App\Http\Controllers\Cms\KategoriObatController;
use App\Http\Controllers\Cms\KonsultasiController;
use App\Http\Controllers\Cms\ObatController;
use App\Http\Controllers\Cms\ResepNDiagnosaController as CmsResepNDiagnosaController;
use App\Http\Controllers\Cms\RiwayatTransaksiController;
use App\Http\Controllers\Cms\TransaksiObatController;
use App\Http\Controllers\Dokter\KonsultasiDokterController;
use App\Http\Controllers\Dokter\ResepNDiagnosaController;
use App\Http\Controllers\Pasien\HomeController;
use App\Http\Controllers\Pasien\KonsultasiController as PasienKonsultasiController;
use App\Http\Controllers\Pasien\ObatController as PasienObatController;
use App\Http\Controllers\TebusObatController;
use App\Http\Livewire\Dokter\ResepNDiagnosa2\CreateResepNDiagnosa as ResepNDiagnosa2CreateResepNDiagnosa;
use App\Http\Livewire\Dokter\ResepNDiagnosa\CreateResepNDiagnosa;
use App\Http\Livewire\Pasien\Obat\InformasiPasienComponent;
use App\Http\Livewire\Pasien\Obat\TebusObatKomponen;
use App\Http\Livewire\Pasien\PemesananObat\TebusObat;
use App\Models\Bank;
use App\Models\Chat;
use App\Models\DetailTransaksiObat;
use App\Models\TransaksiObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, "index"]);

Route::prefix('cms')->name('cms.')->middleware('auth:cms')->group(function () {
    Route::get('/dashboard', [CmsController::class, 'index'])->name('index');
    Route::get('/chat', [KasirController::class, 'listChat'])->name('chat');
    Route::post('/chat', [ChatController::class, 'send'])->name('send.chat');
    Route::get('/kasir/chat/{id}', [KasirController::class, 'chat'])->name('chat.show');
    Route::put("/kasir/chat/{id}", [ChatController::class, 'updatestatus']);
    Route::resource('/roles', RolesController::class);
    Route::resource('/pasien', PasienController::class);
    Route::resource('/dokter', DokterController::class);
    Route::resource('/bank', BankController::class);
    Route::resource('/kategori-obat', KategoriObatController::class);
    Route::resource('/obat', ObatController::class);
    Route::resource('/konsultasi', KonsultasiController::class);
    Route::get('/riwayat-konsultasi', [KonsultasiController::class, 'riwayat'])->name('konsultasi.riwayat');
    Route::get('/riwayat-konsultasi/{konsultasi}', [KonsultasiController::class, 'showRiwayat'])->name('konsultasi.show-riwayat');
    Route::resource('/resep-n-diagnosa', CmsResepNDiagnosaController::class);
    Route::resource('/transaksi-obat', TransaksiObatController::class);
    Route::get('/create-transaksi-obat/{id}', [TransaksiObatController::class, 'createFromDiagnosa'])->name('create-transaksi-obat.riwayat');
    Route::resource('/riwayat-transaksi-obat', RiwayatTransaksiController::class);
    Route::get('/detail-transaksi-obat/{id}', [DetailTransaksiObatController::class,'index'])->name('detail-transaksi-obat.index');
    Route::get('/transaksi-obat-export', [ExportController::class,'transaksiObat'])->name('transaksi-obat-export.export');

});

Route::prefix('dokter')->name('dokter.')->middleware('auth:dokter')->group(function () {
    Route::get('/dashboard', [CmsController::class, 'dokter'])->name('index');
    Route::resource('/resep-n-diagnosa', ResepNDiagnosaController::class);
    Route::get('/add-resep', function(){
        return App::call('');
    });
    Route::get('/resep-n-diagnosa/direct/{konsultasi_id}', CreateResepNDiagnosa::class)->name('resep.direct');
    Route::resource('/konsultasi', KonsultasiDokterController::class);
    Route::get('/riwayat-konsultasi', [KonsultasiDokterController::class, 'riwayat'])->name('konsultasi.riwayat');
});

Route::prefix('pasien')->name('pasien.')->group(function () {
    Route::get("beranda", [HomeController::class, "index"])->name("home.index");
    Route::middleware('auth:pasien')->group(function () {
        Route::prefix('/obat')->name('obat.')->group(function(){
            Route::get('/informasi/{id}', function () {
                return App::call(TebusObatKomponen::class);
            });
        });
        Route::get("pesan-obat", [PasienObatController::class, "pesan_obat_index"])->name("pesan-obat.index");
        Route::get("tebus-obat", [PasienObatController::class, "tebus_obat_index"])->name("tebus-obat.index");

        Route::prefix('tebus')->group(function(){
            Route::post('obat', [TebusObatController::class, 'store']);
            Route::get('/obat/{id}',[TebusObatController::class, 'createData']);
            Route::post('/obat-edit', function(Request $request){
                $transaksi = TransaksiObat::find($request->id);
                $transaksi->jenis_pengambilan = $request->jenis_pengambilan;
                $transaksi->metode_pembayaran = $request->metode_pembayaran;
         
                if($transaksi->status_proses != 'diproses'){
                    if($request->file('bukti')){
                        $transaksi->addMedia($request->file('bukti'))
                        ->toMediaCollection($transaksi::BUKTI_PEMBAYARAN);
                        $transaksi->status_pembayaran = "menunggu konfirmasi";
                    }
                }
                $transaksi->save();

                $transaksiDetail = DetailTransaksiObat::where('transaksi_obat_id', $transaksi->id)->first();
                $transaksiDetail->tinggi = $request->tinggi;
                $transaksiDetail->berat = $request->berat;
                $transaksiDetail->riwayat_alergi = $request->riwayat_alergi;
                $transaksiDetail->alamat = $request->alamat;
                $transaksiDetail->detail_lokasi = $request->detail_lokasi;
                $transaksiDetail->save();
                return redirect()->back();
            });
        });
        Route::get("riwayat-obat", [PasienObatController::class, "riwayat_tebus_obat_index"])->name("riwayat-obat.index");
        Route::get("riwayat", function(){
            $chat = Chat::with('ChatDetail')->where('pasien_id', Auth::user()->id)->where('status', 'selesai')->get();
            $riwayat = TransaksiObat::with('detailTransaksi')->where('pasien_id', Auth::user()->id)->where('status_pembayaran', 'lunas')->where('status_pengambilan', 'diterima')->get();
            // $riwayat = TransaksiObat::with('detailTransaksi')->where('pasien_id', Auth::user()->id)->where('status_pengambilan',"!=", 'diterima')->get();
            $bank = Bank::get();
            return view('pages.pasien2.riwayat.index', ['konsultasi' => $chat, 'riwayat' => $riwayat, 'bank' => $bank]);
        });
        Route::get("pelayanan", function(){
            $chat = Chat::with('ChatDetail')->where('pasien_id', Auth::user()->id)->where('status', 'berlangsung')->get();
            return view('pages.pasien2.riwayat.pelayanan', ['konsultasi' => $chat]);
    
        });
        Route::get("resep", function(){
            return view('pages.pasien2.resep.informasi');
        });
        Route::get("transaksi", function(){
            $chat = Chat::with('ChatDetail')->where('pasien_id', Auth::user()->id)->where('status', 'berlangsung')->get();
            $riwayat = TransaksiObat::with('detailTransaksi')->where('pasien_id', Auth::user()->id)->where('status_pengambilan',"!=", 'diterima')->get();
            $bank = Bank::get();
            return view('pages.pasien2.riwayat.index', ['konsultasi' => $chat, 'riwayat' => $riwayat, 'bank' => $bank]);
        });
        Route::post('/chat', [ChatController::class, 'send'])->name('send.chat');
        Route::get("chat", [ChatController::class, 'proccessChat']);
        Route::get("chat/{id}", [ChatController::class, 'chat']);
        Route::put("chat/{id}", [ChatController::class, 'updatestatus']);
        Route::get("konsultasi", [PasienKonsultasiController::class, "konsultasi_index"])->name("konsultasi.index");
        Route::get("riwayat-konsultasi", [PasienKonsultasiController::class, "riwayat_konsultasi_index"])->name("riwayat-konsultasi.index");
    });
});

require __DIR__ . '/auth.php';
