<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
  use HasFactory;

  protected $dispatchesEvents = [
    'created' => \App\Events\NewsCreated::class,
  ];

  // returns the instance of the user who is author of that news
  public function user()
  {
    return $this->belongsTo('App\Models\User', 'id');
  }
}
