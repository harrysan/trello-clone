<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['title','order','list_id','owner_id'];

    public function list() {
        return $this->belongsTo(CardList::class, 'list_id');
    }

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
