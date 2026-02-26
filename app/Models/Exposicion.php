<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

class Exposicion extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'titulo',
        'subtitulo',
        'slug',
        'descripcion',
        'orden',
        'activa',
    ];

    protected $casts = [
        'activa' => 'boolean',
    ];

    /**
     * Relación con Salas
     */
    public function salas(): HasMany
    {
        return $this->hasMany(Sala::class)->orderBy('orden');
    }

    /**
     * Generar slug automáticamente
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($exposicion) {
            if (empty($exposicion->slug)) {
                $exposicion->slug = Str::slug($exposicion->titulo);
            }
        });

        static::updating(function ($exposicion) {
            if ($exposicion->isDirty('titulo')) {
                $exposicion->slug = Str::slug($exposicion->titulo);
            }
        });
    }

    /**
     * Configurar colecciones de medios
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('imagen')
            ->singleFile() // Solo una imagen por exposición
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(300)
                    ->height(300);
                $this->addMediaConversion('medium')
                    ->width(800)
                    ->height(600);
            });
    }
}
