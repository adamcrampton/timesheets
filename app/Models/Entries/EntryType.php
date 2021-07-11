<?php

namespace App\Models\Entries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryType extends Model
{
    use HasFactory;

    protected $table = 'entry_types';
    protected $fillable = ['name'];

    public function entries()
    {
        return $this->hasMany('App\Models\Entries\Entry', 'entry_type_id', 'id');
    }
}
