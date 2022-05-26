<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;



class Product extends Model
{
    use Slug;

    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];


    /**
     * Accessor e Mutator
     */


    public function getShippingOptsAttribute()
    {
        return [16, 16, 16, .3, 1]; // largura, altura, comprimento, peso e quantidade
    }

    public function getThumbAttribute()
    {
        return $this->photos->first()->image;
    }


    /**
     * Relações
     */

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }


    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);

    }
    public function search($filter = null)
    {

        $results = $this->where(function ($query) use($filter){
            if($filter){
                $query->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")->get();
            }
        })->paginate(15);

        return($results);

    }




}
