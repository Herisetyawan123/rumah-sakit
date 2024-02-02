<div>
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
    <div>
        @if ($status == 'selesai')
            <div class="badge badge-success ">Selesai</div>
        @elseif ($status == 'belum konsultasi')
            <div class="badge badge-error ">Belum Konsultasi</div>
        @endif
    </div>

</div>
