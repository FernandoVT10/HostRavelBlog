<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "likes";

    public $timestamps = false;

    protected $fillable = [
        'user_id',
    ];

    public function comment()
    {
        $this -> belongsTo("App\Comment");
    }
}
