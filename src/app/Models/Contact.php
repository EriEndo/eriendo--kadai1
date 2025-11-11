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
        'tel1',
        'tel2',
        'tel3',
        'tel',
        'adress',
        'building',
        'category_id',
        'detail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeContactSearch($query, $inputs)
    {
        if (!empty($inputs['name'])) {
            $query->where(function ($q) use ($inputs) {
                $q->where('last_name', 'like', "%{$inputs['name']}%")
                    ->orWhere('first_name', 'like', "%{$inputs['name']}%")
                    ->orWhere('email', 'like', "%{$inputs['name']}%");
            });
        }

        if (!empty($inputs['gender'])) {
            $query->where('gender', $inputs['gender']);
        }

        if (!empty($inputs['category_id'])) {
            $query->where('category_id', $inputs['category_id']);
        }

        if (!empty($inputs['date'])) {
            $query->whereDate('created_at', $inputs['date']);
        }

        return $query;
    }
}
