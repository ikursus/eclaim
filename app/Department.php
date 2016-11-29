<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // Info untuk perhubungan ke table departments
    protected $table = 'departments';

    // Fillable rekod untuk protection mass assignment
    protected $fillable = [
      'name'
    ];
}
