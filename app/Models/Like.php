<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  use HasFactory;

  protected $fillable = ['post_id', 'user_id'];

  public function post()
  {
    return $this->belongsTo(Post::class);
  }

  public static function like($post_id)
  {
    self::create(
      [
        'post_id' => $post_id,
        'user_id' => auth()->user()->id,
      ]
    );
  }

  public static function dislike($post_id)
  {
    $like = self::where(
      [
        'post_id' => $post_id,
        'user_id' => auth()->user()->id
      ]
    )->first();
    if ($like) {
      $like->delete();
    }
  }
}
