<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use carbon\Carbon;

class Comment extends Model
{
    use HasFactory;

    /**
     * Get the article that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Get the user that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($created_at){
        return Carbon::parse($created_at)->format('d-m-Y H:i');
    }

    public function getUpdatedAtAttribute($created_at){
        return Carbon::parse($created_at)->format('d-m-Y H:i');
    }
}
