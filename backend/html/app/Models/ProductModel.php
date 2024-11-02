<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    // use HasFactory เอาไว้สร้าง dummy data
    use HasFactory;

    // อ้างถึง table ที่ต้องการ
    protected $table = 'products';

    // อ้างถึง primarykey ใน table นั้นๆ
    protected $primaryKey = 'id';

    // อ้างถึง column ที่ต้องการ
    protected $fillable = [
        'code',
        'name',
        'introductiondate',
        'salesdiscontinuationdate',
        'comment',
        'producttype',
    ];
    
    // เอาไว้เผื่ออ้างถึง column ที่เก็บ timestamp
    // public const CREATED_AT = 'created_timestamp';
    // public const UPDATED_AT = 'updated_timestamp';
    public const CREATED_AT = null;
    public const UPDATED_AT = null;

}
