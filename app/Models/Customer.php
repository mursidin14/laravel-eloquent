<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Date;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    public function wallet(): HasOne 
    {
        return $this->hasOne(Wallet::class, 'customer_id', 'id');
    }

    public function virtualAccount(): HasOneThrough
    {
        return $this->hasOneThrough(VirtualAccount::class, Wallet::class, 'customer_id', 'wallet_id', 'id', 'id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'customer_id', 'id');
    }

    public function customerLikes(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'customers_likes_products', 'customer_id', 'product_id')->withPivot('created_at');
    }

    public function customerLikesLastMont(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'customers_likes_products', 'customer_id', 'product_id')->withPivot('created_at')->wherePivot('created_at', '>=', Date::now()->addMonth(-1));
    }

    public function customerImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
