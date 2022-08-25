<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardList extends Model
{
    use HasFactory;

    protected $fillable = ['title','board_id'];

    public function cards() {
        return $this->hasMany(Card::class, 'list_id');
    }

    public function board() {
        return $this->belongsTo(Board::class, 'board_id');
    }
}
