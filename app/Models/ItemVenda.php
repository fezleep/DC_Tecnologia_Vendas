<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    public function venda()
{
    return $this->belongsTo(Venda::class);
}
}
