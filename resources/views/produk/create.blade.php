@extends('layouts.app', ['title' => 'Upload Produk Premium'])

@section('content')
<div 
    x-data="{
        gambarPreview: null,
        hargaInput: '',
        diskon: 0,
        get hargaSetelahDiskon() {
            if (!this.hargaInput) return 0;
            if (!this.diskon) return this.hargaInput;
            return this.hargaInput - (this.hargaInput * this.diskon / 100);
        }
    }"
    class="w-full bg-white dark:bg-slate-800 shadow-xl rounded-3xl p-8 space-y-6"
>
    <h2 class="text-5xl font-extrabold text-center text-slate-800 dark:text-slate-100 mb-6 tracking-wide drop-shadow-xl">
    ✨ Upload Produk
    </h2>



    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- NAMA PRODUK --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Nama Produk</label>
            <input type="text" name="nama_produk"
                   class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50 dark:bg-slate-900"
                   placeholder="Contoh: Keyboard Mechanical RGB" required>
        </div>

        {{-- DESKRIPSI --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                  class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50 dark:bg-slate-900"
                  placeholder="Jelaskan produk secara detail..." required></textarea>
        </div>

        {{-- KATEGORI --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Kategori Produk</label>
            <select name="kategori" 
                    class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                <option value="Elektronik">Elektronik</option>
                <option value="Fashion">Fashion</option>
                <option value="Gaming">Gaming</option>
                <option value="Hobi">Hobi</option>
                <option value="Aksesoris">Aksesoris</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        {{-- HARGA + DISKON --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Harga (Rp)</label>
                <input 
                    x-model="hargaInput"
                    type="number" 
                    name="harga"
                    class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50 dark:bg-slate-900"
                    placeholder="Contoh: 150000" required>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Diskon (%)</label>
                <input 
                    x-model="diskon"
                    type="number" 
                    name="discount_percent"
                    class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50 dark:bg-slate-900"
                    placeholder="0 - 90">
            </div>
        </div>

        {{-- AUTO CALC HARGA SETELAH DISKON --}}
        <div class="bg-slate-100 dark:bg-slate-700 px-4 py-3 rounded-xl">
            <p class="text-sm text-slate-600 dark:text-slate-200">
                Harga Setelah Diskon:
                <span class="font-bold text-indigo-600 dark:text-indigo-300" 
                      x-text="'Rp ' + hargaSetelahDiskon.toLocaleString('id-ID')"></span>
            </p>
        </div>

        {{-- STOK --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Stok Produk</label>
            <input type="number" name="stock"
                class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50 dark:bg-slate-900"
                placeholder="Contoh: 10" required>
        </div>

        {{-- BADGE OFFICIAL STORE --}}
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_official" value="1" 
                class="w-4 h-4 rounded border dark:border-slate-600">
            <label class="text-sm">Tampilkan Badge <b>Official Store</b></label>
        </div>

        {{-- BADGE BARU --}}
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_new" value="1" checked
                class="w-4 h-4 rounded border dark:border-slate-600">
            <label class="text-sm">Tampilkan Badge <b>Produk Baru</b></label>
        </div>

        {{-- GAMBAR PRODUK + PREVIEW --}}
        <div x-data class="space-y-2">
            <label class="block text-sm font-semibold">Gambar Produk</label>
            <input type="file" name="gambar" accept="image/*"
                   @change="gambarPreview = URL.createObjectURL($event.target.files[0])"
                   class="w-full px-4 py-2 rounded-xl border dark:border-slate-700 bg-slate-50 dark:bg-slate-900">

            <template x-if="gambarPreview">
                <img :src="gambarPreview" class="w-40 h-40 object-cover rounded-xl shadow-md mt-2">
            </template>
        </div>

        {{-- SUBMIT --}}
        <div class="pt-4">
            <button 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl py-3 transition">
                🚀 Upload Produk Sekarang
            </button>
        </div>
    </form>
</div>
@endsection
