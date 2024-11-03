<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductModel as products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // แสดงรายการของ products ทั้งหมด
    public function index()
    {
        $products = products::all();
        return response()->json($products, 200);
    }

    // สร้าง product ใหม่
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products|max:20',
            'name' => 'required|unique:products|max:255',
            'introductiondate' => 'date',
            'salesdiscontinuationdate' => 'date|nullable',
            'comment' => 'string|nullable|max:255',
            'producttype' => 'string|nullable|max:20',
        ]);

        $product = products::create($request->all());
        return response()->json($product, 201);
    }

    // แสดง product ตาม ID
    public function show($id)
    {
        return products::findOrFail($id);
    }

    // อัปเดตข้อมูลของ product ตาม ID
    // อัปเดตข้อมูลของ product ตาม ID
    public function update(Request $request, $id)
    {
        // ตรวจสอบว่ามี product อยู่ในฐานข้อมูลหรือไม่
        $product = products::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // เก็บข้อมูลเดิมก่อนอัปเดต
        $originalData = $product->toArray();

        // ตรวจสอบข้อมูลก่อนอัปเดต
        $request->validate([
            'code' => 'required|max:20|unique:products,code,' . $id,
            'name' => 'required|max:255|unique:products,name,' . $id,
            'introductiondate' => 'date',
            'salesdiscontinuationdate' => 'date|nullable',
            'comment' => 'string|nullable|max:255',
            'producttype' => 'string|nullable|max:20',
        ]);

        // อัปเดตข้อมูล
        $product->update($request->all());

        // ส่งข้อมูลเดิมและข้อมูลที่อัปเดตกลับไป
        return response()->json([
            'original_data' => $originalData,
            'updated_data' => $product
        ], 200);
    }

    // ลบ product ตาม ID
    public function destroy($id)
    {
        // ตรวจสอบว่ามี product อยู่ในฐานข้อมูลหรือไม่
        $product = products::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // เก็บข้อมูลก่อนลบ
        $deletedData = $product->toArray();

        // ลบข้อมูล
        $product->delete();

        // ส่งข้อมูลที่ถูกลบกลับไป
        return response()->json([
            'deleted_data' => $deletedData
        ], 200);
    }
}