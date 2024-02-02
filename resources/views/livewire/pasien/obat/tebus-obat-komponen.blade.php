<div>
    @if($activeTab == 'informasi')
        <livewire:pasien.obat.informasi-pasien-component :formInformasi="$this->formInformasi" />
    @else 
        <livewire:pasien.obat.alamat-pasien-component :formInformasi="$this->formInformasi" />
    @endif
</div>
