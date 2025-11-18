@extends('layouts.market')

@section('content')

{{-- =======================
   BANNER PREMIUM
=========================== --}}
<div class="relative mb-10">
    <img src="https://images.unsplash.com/photo-1503602642458-232111445657"
         class="w-full h-64 object-cover rounded-3xl shadow-lg">
    <div class="absolute bottom-6 left-10 text-white drop-shadow-2xl">
        <h2 class="text-4xl font-extrabold">Promo Akhir Tahun 🎉</h2>
        <p class="text-lg mt-2 font-medium">Diskon hingga 70%! Khusus hari ini.</p>
    </div>
</div>



{{-- =======================
   MODAL OVERLAY
=========================== --}}
<style>
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(6px);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 50;
    animation: fadeIn .3s ease-out;
}
@keyframes fadeIn {
    from { opacity: 0;}
    to   { opacity: 1;}
}
.hidden {
    display: none !important;
}
</style>

{{-- =======================
     MODAL DETAIL
=========================== --}}
<div id="modalDetail" class="modal-overlay hidden">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-96">
        <img id="modalImage" class="rounded-xl mb-4 w-full h-56 object-cover">

        <h2 id="modalNama" class="text-xl font-bold"></h2>
        <p id="modalKategori" class="text-gray-600"></p>
        <p id="modalDeskripsi" class="text-gray-700 mt-2"></p>
        <p id="modalHarga" class="text-green-600 font-bold text-xl mt-2 mb-4"></p>

        <button onclick="tutupModal()" 
                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-xl">
            Tutup
        </button>
    </div>
</div>

{{-- =======================
   FILTER & SORT
=========================== --}}
<div class="flex flex-wrap justify-between items-center mb-6">

    <div class="flex gap-3">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700">
            Semua Produk
        </button>
        <button class="px-4 py-2 bg-gray-200 rounded-xl shadow hover:bg-gray-300">Hewan</button>
        <button class="px-4 py-2 bg-gray-200 rounded-xl shadow hover:bg-gray-300">Elektronik</button>
        <button class="px-4 py-2 bg-gray-200 rounded-xl shadow hover:bg-gray-300">Fashion</button>
    </div>

    <select class="px-4 py-2 rounded-xl shadow border-gray-300">
        <option>Terbaru</option>
        <option>Harga Termurah</option>
        <option>Harga Termahal</option>
        <option>Terlaris</option>
    </select>
</div>

{{-- =======================
   FLASH SALE
=========================== --}}
<div class="bg-red-600 text-white p-4 rounded-2xl shadow-xl mb-10">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">⚡ Flash Sale Sedang Berlangsung</h2>
        <div id="countdown" class="text-xl font-bold"></div>
    </div>
</div>

{{-- =======================
   GRID PRODUK
=========================== --}}
<div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
@foreach ($products as $p)

    @php
        $discount  = (int) ($p->discount_percent ?? 0);
        $hargaAwal = (int) $p->harga;
        $hargaAkhir = $hargaAwal - ($hargaAwal * $discount / 100);
    @endphp

    <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-3xl hover:-translate-y-1 transition-all">

        {{-- BADGE DISKON: hanya tampil kalau > 0 --}}
        @if($discount > 0)
        <div class="absolute top-3 left-3 bg-red-500 text-white px-3 py-1 rounded-xl text-xs font-bold shadow">
            -{{ $discount }}%
        </div>
        @endif

        {{-- WISHLIST --}}
        <button class="absolute top-3 right-3 p-2 bg-white rounded-full shadow hover:scale-110 transition">
            ❤️
        </button>

        <img src="{{ asset('storage/'.$p->gambar) }}" class="w-full h-56 object-cover rounded-t-2xl">

        <div class="p-4">
            <h3 class="text-lg font-bold mb-1">{{ $p->nama_produk }}</h3>

            {{-- RATING --}}
            <div class="flex text-yellow-500 mb-2">
                ★★★★★
                <span class="ml-2 text-gray-500 text-sm">({{ $p->rating_count ?? rand(10,200) }} ulasan)</span>
            </div>

            {{-- HARGA --}}
            <p class="font-bold text-green-600 text-xl mb-1">
                Rp {{ number_format($hargaAkhir, 0, ',', '.') }}
            </p>

            @if($discount > 0)
            <p class="text-gray-500 line-through text-sm">
                Rp {{ number_format($hargaAwal,0,',','.') }}
            </p>
            @endif

            <div class="flex justify-between mt-3">
                {{-- BUTTON DETAIL --}}
                <a href="{{ route('produk.show', $p->id) }}"
   class="px-4 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700">
   Detail
</a>


                <button class="px-3 bg-green-600 text-white rounded-full shadow-xl hover:bg-green-700">
                    🛒
                </button>
            </div>
        </div>

    </div>
@endforeach
</div>

{{-- LOAD MORE --}}
<div id="loadMore" class="text-center mt-10">
    <button class="px-6 py-3 bg-gray-300 rounded-xl shadow hover:bg-gray-400">
        Muat Lebih Banyak
    </button>
</div>

@endsection

{{-- =======================
   SCRIPT MODAL
=========================== --}}
<script>
function bukaModal(gambar, nama, deskripsi, kategori, harga, diskon) {

let finalHarga = harga - (harga * (diskon ?? 0) / 100);

document.getElementById('modalImage').src = gambar;
document.getElementById('modalNama').innerText = nama;
document.getElementById('modalDeskripsi').innerText = deskripsi;
document.getElementById('modalKategori').innerText = kategori;
document.getElementById('modalHarga').innerText =
    "Rp " + finalHarga.toLocaleString('id-ID');

document.getElementById('modalDetail').classList.remove('hidden');
}


function tutupModal() {
    document.getElementById('modalDetail').classList.add('hidden');
}
</script>

{{-- =======================
   FLASH SALE COUNTDOWN
=========================== --}}
<script>
let time = 3600;
setInterval(() => {
    let h = Math.floor(time / 3600);
    let m = Math.floor((time % 3600) / 60);
    let s = time % 60;

    document.getElementById('countdown').innerText = `${h}j ${m}m ${s}d`;
    time--;
}, 1000);
</script>
