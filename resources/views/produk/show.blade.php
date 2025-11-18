@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold">{{ $product->nama_produk }}</h1>
<p class="text-gray-600">{{ $product->deskripsi }}</p>

<h2 class="mt-6 text-xl font-semibold">Beri Rating & Komentar</h2>

<form action="{{ route('produk.comment', $product->id) }}" method="POST">
    @csrf

    <label class="block font-semibold mt-2">Rating (1–10)</label>
    <input type="number" name="rating" min="1" max="10" required class="border px-3 py-2 rounded">

    <label class="block font-semibold mt-2">Komentar</label>
    <textarea name="komentar" class="border w-full px-3 py-2 rounded"></textarea>

    <button class="mt-3 px-4 py-2 bg-indigo-600 text-white rounded">
        Kirim
    </button>
</form>

<h2 class="mt-8 text-xl font-semibold">Komentar Pengguna</h2>

@if ($product->komentarRatings->isEmpty())
    <p class="text-gray-500 mt-3">Belum ada komentar.</p>
@else
    @foreach ($product->komentarRatings as $item)
        <div class="border p-3 rounded mt-3">
            <p><strong>Rating:</strong> {{ $item->rating }} ⭐</p>
            <p>{{ $item->komentar }}</p>
        </div>
    @endforeach
@endif

@endsection
