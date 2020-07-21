<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
 
class cate_roomTranslation extends Model
{
    public $timestamps = false;
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','price', 'describe',
    ];
}