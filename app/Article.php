<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "articles";

    protected $fillable = [
        'title', 'description', 'thumb', 'content',
    ];

    public function comments()
    {
        return $this->hasMany("App\Comment");
    }
}
