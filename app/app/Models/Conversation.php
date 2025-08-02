<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conversation extends Model
{

    /**
     * Table associated with the model.
     *
     * @var string
     */
    protected $table ='conversations';


    // Many-to-many relationship with user, it uses conversation_user pivot
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
