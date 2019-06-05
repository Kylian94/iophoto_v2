<?php
    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Product extends Model
    {
        use SoftDeletes;

        protected $fillable = [
            'name', 'price', 'units', 'description', 'image', 'category_id'
        ];

        public function orders(){
            return $this->hasMany(Order::class);
        }
        public function categories(){
            return $this->hasMany(Category::class);
        }
    }