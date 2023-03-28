<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContactPerson extends Model
{

    use HasFactory;

    protected $fillable = ['email','name','phone'];


    public function messageThread(): HasOne
    {
        return $this->hasOne(MessageThread::class);
    }

}
