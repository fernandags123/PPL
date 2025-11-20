<?php

namespace App\Http\Controllers;

use App\Models\KomentarRating;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with('komentarRatings.user')->findOrFail($id);

    return view('produk.show', compact('product'));
    }

    public function storeComment(Request $request, $id)
    {
    $request->validate([
        'rating' => 'required|integer|min:1|max:10',
        'komentar' => 'nullable|string'
    ]);

    KomentarRating::create([
        'product_id' => $id,
        'user_id' => 1, 
        'rating' => $request->rating,
        'komentar' => $request->komentar,
    ]);

    return back()->with('success', 'Komentar dan rating berhasil dikirim!');
    }


    public function index()
    {
        $products = Product::latest()->get();
        return view('produk.index', compact('products'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'       => 'required',
            'deskripsi'         => 'required',
            'harga'             => 'required|numeric',
            'kategori'          => 'nullable|string',
            'discount_percent'  => 'nullable|numeric',
            'stock'             => 'required|numeric',
            'gambar'            => 'image|mimes:jpg,jpeg,png,webp|max:4096'
        ]);

        $discount = $request->filled('discount_percent') 
            ? (int) $request->discount_percent 
            : 0;

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
        }

        Product::create([
            'user_id'          => 1,
            'nama_produk'      => $request->nama_produk,
            'deskripsi'        => $request->deskripsi,
            'harga'            => (int) $request->harga,
            'kategori'         => $request->kategori,
            'discount_percent' => $discount,
            'stock'            => (int) $request->stock,
            'is_official'      => $request->has('is_official'),
            'is_new'           => $request->has('is_new'),
            'gambar'           => $gambarPath,
            'rating'           => 0,
            'rating_count'     => 0,
            'sold_count'       => 0,
        ]);

        return back()->with('success', 'Produk premium berhasil di-upload!');
    }
}
