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
        return products::all();
        // return "Hello World!";
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
        $product = products::findOrFail($id);

        // เพิ่มการตรวจสอบข้อมูลก่อนอัปเดต
        $request->validate([
            'code' => 'required|max:20|unique:products,code,' . $id,
            'name' => 'required|max:255|unique:products,name,' . $id,
            'introductiondate' => 'date',
            'salesdiscontinuationdate' => 'date|nullable',
            'comment' => 'string|nullable|max:255',
            'producttype' => 'string|nullable|max:20',
        ]);

        // อัปเดตข้อมูลหลังจากผ่านการตรวจสอบแล้ว
        $product->update($request->all());
        return response()->json($product, 200);
    }


    // ลบ product ตาม ID
    public function destroy($id)
    {
        products::destroy($id);
        return response()->json(null, 204);
    }
}