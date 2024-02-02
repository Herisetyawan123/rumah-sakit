<div>
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
    <div>
        @if ($status == 'diterima')
            <div class="badge badge-success ">Diterima</div>
        @elseif ($status == 'pending')
            <div class="badge badge-warning ">Menunggu Pengambilan</div>
        @elseif ($status == 'sedang diantarkan')
            <div class="badge badge-primary ">Sedang Diantarkan</div>
        @endif
    </div>

</div>
