<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

        protected $fillable = [
            'ref', 'amount', 'adress_id', 'user_id', 'is_delivered',
        ];

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }

        public function orders()
        {
            return $this->hasMany(Order::class);
        }
}
