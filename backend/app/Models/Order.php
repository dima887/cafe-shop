<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type_order_id',
        'user_id',
        'status_order_id',
    ];

    public function type_order(): BelongsTo
    {
        return $this->belongsTo(TypeOrder::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status_order(): BelongsTo
    {
        return $this->belongsTo(StatusOrder::class);
    }
}
