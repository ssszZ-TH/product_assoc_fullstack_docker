<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductComponentModel;
use Illuminate\Http\Request;

class ProductComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ดึงข้อมูล product components ทั้งหมด
        $productComponents = ProductComponentModel::all();
        return response()->json($productComponents, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลก่อนสร้าง product component ใหม่
        $request->validate([
            'code' => 'string|max:20|nullable',
            'fromdate' => 'date|required',
            'thrudate' => 'date|nullable|after:fromdate',
            'quantityuse' => 'integer|required|min:1',
            'instruction' => 'string|nullable|max:255',
            'comment' => 'string|nullable|max:255',
            'parentproductid' => 'integer|exists:products,id|required',
            'componentproductid' => 'integer|exists:products,id|required',
        ]);

        // สร้าง product component ใหม่หลังจากผ่านการตรวจสอบแล้ว
        $productComponent = ProductComponentModel::create($request->all());
        return response()->json($productComponent, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // ดึงข้อมูล product component ตาม ID ที่ระบุ
        return ProductComponentModel::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // ตรวจสอบว่ามี product component อยู่ในฐานข้อมูลหรือไม่
        $productComponent = ProductComponentModel::find($id);
        if (!$productComponent) {
            return response()->json(['error' => 'Product Component not found'], 404);
        }

        // เก็บข้อมูลเดิมก่อนอัปเดต
        $originalData = $productComponent->toArray();

        // ตรวจสอบข้อมูลที่ส่งมาเพื่ออัปเดต
        $request->validate([
            'code' => 'string|max:20|nullable',
            'fromdate' => 'date|required',
            'thrudate' => 'date|nullable|after:fromdate',
            'quantityuse' => 'integer|required|min:1',
            'instruction' => 'string|nullable|max:255',
            'comment' => 'string|nullable|max:255',
            'parentproductid' => 'integer|exists:products,id|required',
            'componentproductid' => 'integer|exists:products,id|required',
        ]);

        // อัปเดตข้อมูล
        $productComponent->update($request->all());

        // ส่งข้อมูลเดิมและข้อมูลที่อัปเดตกลับไป
        return response()->json([
            'original_data' => $originalData,
            'updated_data' => $productComponent
        ], 200);
    }

    // ลบ product component ตาม ID
    public function destroy($id)
    {
        // ตรวจสอบว่ามี product component อยู่ในฐานข้อมูลหรือไม่
        $productComponent = ProductComponentModel::find($id);
        if (!$productComponent) {
            return response()->json(['error' => 'Product Component not found'], 404);
        }

        // เก็บข้อมูลก่อนลบ
        $deletedData = $productComponent->toArray();

        // ลบข้อมูล
        $productComponent->delete();

        // ส่งข้อมูลที่ถูกลบกลับไป
        return response()->json([
            'deleted_data' => $deletedData
        ], 200);
    }
}
