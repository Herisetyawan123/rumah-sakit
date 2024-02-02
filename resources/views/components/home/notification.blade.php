<div class="dropdown dropdown-end mr-3 ">
    <label tabindex="0" class="btn btn-ghost btn-circle">
        <div class="indicator">
            <i class="fa-solid fa-bell text-xl"></i>
        <span class="badge badge-info badge-sm indicator-item">{{ $totalNotif }}</span>
        </div>
    </label>
    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 text-black">
        @if ($transaksiObat > 0)
            <li><a href="{{ route('pasien.tebus-obat.index') }}">Terdapat {{ $transaksiObat }} transaksi obat belum selesai.</a></li>
        @endif
        @if ($konsultasi > 0)
            <li><a href="{{ route('pasien.riwayat-konsultasi.index') }}">Terdapat {{ $konsultasi }} konsultasi belum selesai.</a></li>
        @endif
      </ul>
</div>
