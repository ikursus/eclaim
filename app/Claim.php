<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
  // Protection untuk mass assign
  protected $fillable = [
    'user_id',
    'title',
    'start_date',
    'end_date',
    'amount',
    'detail',
    'note',
    'status'
  ];


}
