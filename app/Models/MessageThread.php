<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kra8\Snowflake\HasShortflakePrimary;

class MessageThread extends Model
{
    use HasFactory, HasShortflakePrimary;

    protected $fillable = ['title','body'];

    public function isCreatedByAnAuthenticatedUser(): bool
    {
        //checks if there are any users associated with the requested messageThread
        return User::query()->whereRelation('messageThreads', 'message_threads.id', $this->id)->exists();
    }

    public function contactPerson (): BelongsTo
    {
        return $this->belongsTo(ContactPerson::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
