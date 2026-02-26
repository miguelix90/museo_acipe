<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

class Sala extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'exposicion_id',
        'titulo',
        'slug',
        'orden',
        'activa',
    ];

    protected $casts = [
        'activa' => 'boolean',
    ];

    /**
     * Relación con Exposición
     */
    public function exposicion(): BelongsTo
    {
        return $this->belongsTo(Exposicion::class);
    }

    /**
     * Relación con Libros (muchos a muchos)
     */
    public function libros(): BelongsToMany
    {
        return $this->belongsToMany(Libro::class, 'libro_sala')
            ->withPivot('orden')
            ->withTimestamps()
            ->orderBy('libro_sala.orden');
    }

    /**
     * Generar slug automáticamente
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sala) {
            if (empty($sala->slug)) {
                $sala->slug = Str::slug($sala->titulo);
            }
        });

        static::updating(function ($sala) {
            if ($sala->isDirty('titulo')) {
                $sala->slug = Str::slug($sala->titulo);
            }
        });
    }

    /**
     * Configurar colecciones de medios
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('imagen_principal')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(300)
                    ->height(300);
                $this->addMediaConversion('large')
                    ->width(1200)
                    ->height(800);
            });

        $this->addMediaCollection('audio')
            ->singleFile()
            ->acceptsMimeTypes(['audio/mpeg', 'audio/mp3', 'audio/wav']);
    }
}
