<div>
    @if ($status == 'lunas')
        <div class="badge badge-success ">Lunas</div>
    @elseif ($status == 'pending')
        <div class="badge badge-warning ">Menunggu Pembayaran</div>
    @elseif ($status == 'menunggu konfirmasi')
        <div class="badge badge-primary ">Menunggu Konfirmasi</div>
    @elseif ($status == 'ditolak')
        <div class="badge badge-error ">Ditolak</div>
    @endif
</div>
