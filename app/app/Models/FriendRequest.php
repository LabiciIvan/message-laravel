<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FriendRequest extends Model
{
    
    /**
     * Table associated with the model.
     *
     * @var string
     */
    protected $table = 'friend_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var string
     */
    protected $fillable = [
        'requestor_id',
        'receiver_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function requestor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requestor_id');
    }
}
