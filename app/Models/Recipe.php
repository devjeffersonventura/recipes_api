<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'image',
        'instructions',
        'user_id',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ingredients' => 'array',
    ];

    /**
     * Regras de validação para o modelo.
     *
     * @return array<string, string>
     */
    public static function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|array',
            'image' => 'required|string',
            'instructions' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * Scope para buscar receitas por título.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $title
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByTitle($query, $title)
    {
        return $query->where('title', 'like', "%{$title}%");
    }

    /**
     * Mutator para o título.
     *
     * @param string $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst(strtolower($value));
    }

    /**
     * Accessor para o título.
     *
     * @param string $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Relacionamento com o usuário.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}