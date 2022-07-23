<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Advertisement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'type',
        'title',
        'description',
        'start_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
    ];

    /**
     * Get the user that owns the Advertisement
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the Advertisement
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The advertisement that belong to the Tag
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope a query to only ofCategory
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function scopeOfCategory($query, mixed $category)
    {
        if (is_array($category)) {
            $query->whereIn('category_id', $category);
        } else {
            $query->when($category, fn ($builder) => $builder->where('category_id', $category));
        }
    }

    /**
     * Scope a query to only ofUser
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function scopeOfUser($query, int $user_id = null)
    {
        $query->when($user_id, fn ($builder) => $builder->where('user_id', $user_id));
    }

    /**
     * Scope a query to only hasTags
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function scopeHasTags($query, mixed $tag = null)
    {
        if ($tag) {
            if (is_array($tag)) {
                $query->whereHas('tags', fn ($builder) => $builder->whereIn('name', $tag));
            } else {
                $query->when($tag, fn ($builder) => $builder->where('name', $tag));
            }
        }
    }
}
