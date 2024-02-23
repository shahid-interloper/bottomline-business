<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebSetting extends Model
{
    protected $fillable = ['key', 'data'];

    use HasFactory;
    use SoftDeletes;
    

    public function user(){
        return $this->belongsTo(User::class, 'addedBy');
    }


}
