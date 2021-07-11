<?php

namespace App\Models\Entries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $table = 'entries';
    protected $fillable = [
        'user_id', 'entry_type_id', 'start_time', 'end_time'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Entries\EntryType', 'entry_type_id', 'id');
    }
}
