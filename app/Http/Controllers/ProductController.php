<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return Product::paginate(15);
    }

    // Create new product
    public function store(StoreProductRequest $r)
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $path = $r->file('image')->store('products', 'private');
            $data['image_path'] = $path;
        }
        $product = Product::create($data);
        return response()->json($product,201);
    }

    // Get single product
    public function show(Product $product) { return $product; }

    // Update existing product
    public function update(StoreProductRequest $request, Product $product)
{
    $user = Auth::user();

    // If user is not admin, only allow update if they own the product
    if ($user->role !== 'admin' && $product->user_id !== $user->id) {
        return response()->json(['message' => 'Forbidden - You can only update your own products'], 403);
    }

    $data = $request->validated();

    if ($request->hasFile('image')) {
        if ($product->image_path) {
            Storage::disk('private')->delete($product->image_path);
        }
        $path = $request->file('image')->store('products', 'private');
        $data['image_path'] = $path;
    }

    $product->update($data);

    return response()->json($product);
}


    // Delete product
    public function destroy(Product $product)
{
    $user = Auth::user();

    // If user is not admin, only allow them to delete their own product
    if ($user->role !== 'admin' && $product->user_id !== $user->id) {
        return response()->json(['message' => 'Forbidden - You can only delete your own products'], 403);
    }

    // Prevent deletion if product is linked to orders
    if ($product->orderItems()->exists()) {
        return response()->json(['message'=>'Product linked to order(s). Cannot delete.'], 400);
    }

    // Delete product image if exists
    if ($product->image_path) {
        Storage::disk('private')->delete($product->image_path);
    }

    $product->delete();

    return response()->json(['message'=>'Deleted']);
}


    // Import products from an Excel file
    public function importExcel(Request $r)
    {
        $r->validate([
            'file'=>'required|file|mimes:xlsx,xls,csv'
        ]);

        $rows = \Maatwebsite\Excel\Facades\Excel::toArray([], $r->file('file'))[0];

        $inserted = $errors = [];
        foreach ($rows as $index => $row) {
            // Expect columns: name, sku, price, quantity, image_url
            if ($index === 0) {
                // Optionally detect header row
                $header = array_map('strtolower', $row);
                if (in_array('sku', $header)) continue; // skip header
            }

            $name = $row[0] ?? null;
            $sku = $row[1] ?? null;
            $price = $row[2] ?? null;
            $quantity = $row[3] ?? null;
            $image_url = $row[4] ?? null;

            $rowErrors = [];
            if (!$name) $rowErrors[] = 'name missing';
            if (!$sku) $rowErrors[] = 'sku missing';
            if (!is_numeric($price)) $rowErrors[] = 'invalid price';
            if (!is_numeric($quantity)) $rowErrors[] = 'invalid quantity';
            if (Product::where('sku',$sku)->exists()) $rowErrors[] = 'sku exists';

            if ($rowErrors) {
                $errors[] = ['row'=>$index+1,'errors'=>$rowErrors];
                continue;
            }

            $image_path = null;
            if ($image_url) {
                try {
                    // fetch image and store
                    $contents = Http::get($image_url)->body();
                    $extension = pathinfo(parse_url($image_url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
                    $fileName = 'products/' . Str::uuid().'.'.$extension;
                    Storage::disk('private')->put($fileName, $contents);
                    $image_path = $fileName;
                } catch(\Exception $e) {
                    // ignore image errors
                }
            }

            $product = Product::create([
                'name'=>$name,
                'sku'=>$sku,
                'price'=>floatval($price),
                'quantity'=>intval($quantity),
                'image_path'=>$image_path
            ]);
            $inserted[] = $product;
        }

        return response()->json(['inserted'=>count($inserted),'errors'=>$errors]);
    }
}
