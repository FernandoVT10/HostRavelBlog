<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "comments";


    protected $fillable = [
        'user_id', 'article_id', 'content',
    ];

    public function user()
    {
        return $this -> belongsTo("App\User");
    }


    public function likes()
    {
        return $this -> hasMany("App\Like");
    }

    public function article()
    {
        return $this -> belongsTo("App\Article");
    }
}
