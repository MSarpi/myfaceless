<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username', 'imagen_perfil']); // un post pertenece a un usuario
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);   // un post tiene multiple comentarios
    }

    public function likes()
    {
        return $this->hasMany(Like::class);   // un post tiene multiple likes
    }

    public function checklikes(User $user)
    {
        return $this->likes->contains('user_id', $user->id);   // un post tiene multiple likes
    }
}
