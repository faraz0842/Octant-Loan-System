<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditUnion extends Model
{
    use HasFactory , SoftDeletes;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'credit_union';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'credit_union_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['credit_union'];

    protected $dates = ['deleted_at'];
}


