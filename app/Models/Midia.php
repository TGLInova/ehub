<?php

namespace App\Models;

use App\Enums\Proporcao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Midia extends Model
{
    const UPDATED_AT = null;

    protected $table = 'midias';

    protected $fillable = ['caminho', 'nome', 'proporcao'];

    protected function casts(): array
    {
        return [
            'proporcao' => Proporcao::class
        ];
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public static function createOrUpdateFromAspectRatio(Model $relatedModel, ?Proporcao $ratio, array $data)
    {
        $model = static::query()->whereMorphedTo('model', $relatedModel)->firstOrNew([
            'proporcao' => $ratio
        ]);

        $model->fill($data);

        $model->model()->associate($relatedModel);

        $model->save();
    }

    public static function createOrUpdateFrom(Model $relatedModel, string $path, array $data)
    {
        $model = static::firstOrNew(['caminho' => $path]);

        $model->fill($data);

        $model->model()->associate($relatedModel);

        $model->save();

        return $model;
    }

    public function url(): Attribute
    {
        return Attribute::make(get: fn () => Storage::disk('public')->url($this->caminho))->shouldCache();
    }
}
