<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // search
    // keyword
    public function scopeKeywordSearch($query, $keyword)
    {
        $parts = explode(' ', $keyword);
        $_name = '';
        $_email = false;
        foreach ($parts as $part) {
            if (filter_var($part, FILTER_VALIDATE_EMAIL)) {
                $_email = true;
                $query->where('email', $part);
            } else {
                if (!empty($part)) {
                    $_name = $_name . $part;
                }
            }
        }
        if (!$_email) {
            $query->where(function ($query) use ($_name) {
                $searchPattern = '%' . str_replace([' ', '　'], '', $_name) . '%';
                $query->where('last_name', 'like', $searchPattern)
                    ->orWhere('first_name', 'like', $searchPattern)
                    ->orwhereRaw('CONCAT(last_name, first_name) LIKE ?', $searchPattern);;
            });
        }
    }

    // gender
    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender) and $gender != 0) {
            $query->where('gender', $gender);
        }
    }

    // category
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }
    // date
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->whereRaw('SUBSTRING(created_at,1,10) LIKE ?', $date);
        }
    }
}
