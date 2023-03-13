<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reply extends Model
{
    use HasFactory;


    protected $fillable = ['title','body','replyable_id','replyable_type'];

    public function replyable(): MorphTo
    {

        return $this->morphTo();
    }

}
