<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComponentModel extends Model
{
    use HasFactory;

    // กำหนดชื่อตารางในฐานข้อมูล
    protected $table = 'productcomponent';

    // กำหนดคีย์หลักของตาราง
    protected $primaryKey = 'id';

    // ปิดการใช้งาน timestamps เพราะตารางนี้ไม่มีฟิลด์ created_at และ updated_at
    public $timestamps = false;

    // กำหนดฟิลด์ที่สามารถกำหนดค่าได้ (fillable) เพื่อป้องกัน mass assignment
    protected $fillable = [
        'code',
        'fromdate',
        'thrudate',
        'quantityuse',
        'instruction',
        'comment',
        'parentproductid',
        'componentproductid',
    ];

    // สร้างความสัมพันธ์กับตาราง products (Parent Product)
    public function parentProduct()
    {
        return $this->belongsTo(ProductModel::class, 'parentproductid');
    }

    // สร้างความสัมพันธ์กับตาราง products (Component Product)
    public function componentProduct()
    {
        return $this->belongsTo(ProductModel::class, 'componentproductid');
    }
}
