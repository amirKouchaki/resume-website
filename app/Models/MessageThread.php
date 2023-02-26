<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasShortflakePrimary;

class MessageThread extends Model
{
    use HasFactory, HasShortflakePrimary;

    public function isCreatedByAnAuthenticatedUser(): bool
    {
        //checks if there are any users associated with the requested messageThread
        return User::query()->whereRelation('messageThreads','id',$this->id)->exists();
    }
}
