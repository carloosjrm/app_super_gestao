<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    protected $fillable = ['cliente_id'];

    public function produtos() {
        return $this->belongsToMany('App\Models\Produto', 'pedidos_produtos')->withPivot('created_at');
    }
}
