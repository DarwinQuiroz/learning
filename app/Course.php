<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    const PUBLISHED = 1;
    const PENDDING = 2;
    const REJECTED = 3;
}
