<?php
namespace App\Http\Livewire\Dokter\ResepNDiagnosa;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Cms\Contract\PageAction;
use App\Models\Konsultasi;
use App\Models\Pasien;
use App\Models\ResepNDiagnosa;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;

class FormResepNDiagnosa extends Component
{
    use PageAction;
    // define eloquent model to use direct data binding
    public ResepNDiagnosa $resep_n_diagnosa;

    public $operation;
    public array $pasienOptions = [
    ];

    public $konsultasi_id;

    // POST
    protected $rules = [
        'resep_n_diagnosa.pasien_id'=>'required',
        'resep_n_diagnosa.dokter_id'=>'required',
        'resep_n_diagnosa.tarif'=>'required',
        'resep_n_diagnosa.resep'=>'required|string',
        'resep_n_diagnosa.diagnosa'=>'required|string',
    ];

    /**
     * Confirm resep_n_diagnosa authorization to access the datatable resources.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \ErrorException
     */
    protected function confirmAuthorization(): void
    {
        $permission = 'dokter.' . $this->resep_n_diagnosa->getTable() . '.' . $this->operation;
        if (!Auth::guard('dokter')->user()->can($permission)) {
            throw new AuthorizationException();
        }
    }

    public function mount(){
        // $this->confirmAuthorization();

        $pasien = Pasien::all();
        foreach ($pasien as $key => $value) {
            $this->pasienOptions[$value->id] = $value->no_rm.' | '.$value->nama;
        }

        // if ($this->operation === 'create' && Konsultasi::findOrFail($this->konsultasi_id)) {
        //     $konsultasi = Konsultasi::findOrFail($this->konsultasi_id);
        //     $this->resep_n_diagnosa->kode_transaksi = $konsultasi->no_pesanan;
        //     $this->resep_n_diagnosa->pasien_id = $konsultasi->pasien_id;
        //     $this->resep_n_diagnosa->dokter_id = $konsultasi->dokter_id;
        //     $this->resep_n_diagnosa->tarif = $konsultasi->tarif;

        // }


    }

    public function backToIndex()
    {
        return redirect(route('dokter.resep-n-diagnosa.index'));
    }

    public function save()
    {
        if (($this->operation !== 'create') && ($this->operation !== 'update')) {
            return redirect()->to(route('dokter.resep-n-diagnosa.index'));
        }
        // dd("ok");

        $this->resep_n_diagnosa->kode_transaksi = 'TO'.$this->resep_n_diagnosa->pasien_id.preg_replace('/[^A-Za-z0-9]+/', '', Carbon::now());
        $this->resep_n_diagnosa->dokter_id = Auth::guard('dokter')->user()->id;
        $this->validate();

        $this->resep_n_diagnosa->save();


       session()->flash('success', 'hasil konsultasi berhasil ditambahkan.');
       return redirect(route('dokter.resep-n-diagnosa.index'));
    }
}

?>
