<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'stripe_session_id', 
        'customer_email',
        'customer_name',
        'shipping_address',
        'amount',
        'fulfillment_status',
        'tracking_number',
    ];
    
    protected $casts = [
        'shipping_address' => 'array',
    ];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}