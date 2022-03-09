<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GithubRepo
 *
 * @property-read GithubRepo $post
 * @method static \Illuminate\Database\Eloquent\Builder|GithubRepo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubRepo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubRepo query()
 * @method static \Database\Factories\GithubRepoFactory factory(...$parameters)
 * @mixin Eloquent
 */
class GithubRepo extends Model
{
    use HasFactory;

    protected $fillable = ['repo_name', 'thumbnail'];

    public function post() {
        return $this->belongsTo(GithubRepo::class);
    }
}
