<?php

namespace App\Models;

use App\Models\Scopes\isActiveGlobalScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
   protected $table = 'categories';
   protected $primaryKey = 'id';
   protected $keyType = 'string';
   public $incrementing = false;
   public $timestamps = false;

   protected $fillable = [
      'id',
      'name',
      'description'
   ];

   public function products():HasMany 
   {
      return $this->hasMany(Product::class, 'category_id', 'id');
   }

   public function cheapsetProduct(): HasOne
   {
      return $this->hasOne(Product::class, 'category_id', 'id')->oldestOfMany('price');
   }

   public function mostExpansiveProduct()
   {
      return $this->hasOne(Product::class, 'category_id', 'id')->latestOfMany('price');
   }

   public function reviews(): HasManyThrough
   {
      return $this->hasManyThrough(Review::class, Product::class, 'category_id', 'product_id', 'id', 'id');
   }

   protected static function booted()
   {
      parent::booted();
      self::addGlobalScope(new isActiveGlobalScope());
   }
}
