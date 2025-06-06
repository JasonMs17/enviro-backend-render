<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialReport extends Model
{
    use HasFactory;

    protected $table = 'material_reports';

    protected $fillable = [
        'user_id',
        'material_id',
        'progress',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Material
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'material_id');
    }
}
