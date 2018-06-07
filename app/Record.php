<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';

    public $primaryKey = 'id';
    public $timestamps = true;

    public function app() {
        return $this->belongsTo('App\App');
    }
}
