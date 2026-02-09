<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeKeywordSearch($query, $keyword)
{
    if (empty($keyword)) {
        return $query;
    }

    return $query->where(function ($q) use ($keyword) {
        $q->where('first_name', 'like', "%{$keyword}%")
          ->orWhere('last_name', 'like', "%{$keyword}%")
          ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"])
          ->orWhere('email', 'like', "%{$keyword}%");
    });
}

public function scopeGenderSearch($query, $gender)
{
    if (empty($gender)) {
        return $query;
    }

    return $query->where('gender', $gender);
}

public function scopeCategorySearch($query, $categoryId)
{
    if (empty($categoryId)) {
        return $query;
    }

    return $query->where('category_id', $categoryId);
}

public function scopeDate($query, $date)
{
    if (empty($date)) {
        return $query;
    }

    return $query->whereDate('created_at', $date);
}
}
