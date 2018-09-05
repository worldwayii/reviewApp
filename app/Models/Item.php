<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'items';

    protected $fillable = [ 'name', 'sku', 'manufacturer_id', 'about', 'price', 'image_path'];

    //Defining relationship between Item and manufacturer
    public function manufacturer()
    {
    	return $this->BelongsTo('App\Models\Manufacturer', 'manufacturer_id');
    }

    //relationship for reviews
    public function reviews()
    {
    	return $this->hasMany('App\Models\Review', 'item_id');
    }
}
