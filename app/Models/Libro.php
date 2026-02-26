<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Libro extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'titulo',
        'autor',
        'fecha_edicion',
        'url_imagen_portada',
        'url_resena',
    ];

    /**
     * Relación con Salas (muchos a muchos)
     */
    public function salas(): BelongsToMany
    {
        return $this->belongsToMany(Sala::class, 'libro_sala')
            ->withPivot('orden')
            ->withTimestamps()
            ->orderBy('libro_sala.orden');
    }

    /**
     * Configurar colecciones de medios
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('imagen_libro')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(200)
                    ->height(300);
                $this->addMediaConversion('medium')
                    ->width(400)
                    ->height(600);
            });

        $this->addMediaCollection('imagen_nube_palabras')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(300)
                    ->height(300);
                $this->addMediaConversion('large')
                    ->width(800)
                    ->height(800);
            });
    }
}
