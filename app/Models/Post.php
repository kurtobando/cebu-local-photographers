<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'user_id',
        'views',
        'likes',
        'comments',
        'status',
        'tags'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // TODO! switch to s3
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('photos')
            ->useDisk('public')
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumbnail')
                    ->width(300)
                    ->height(300)
                    ->format(Manipulations::FORMAT_WEBP)
                    ->nonQueued();
                $this->addMediaConversion('medium')
                    ->width(600)
                    ->height(600)
                    ->format(Manipulations::FORMAT_WEBP)
                    ->nonQueued();
                $this->addMediaConversion('large')
                    ->width(1024)
                    ->height(1024)
                    ->format(Manipulations::FORMAT_WEBP)
                    ->nonQueued();
                $this->addMediaConversion('xlarge')
                    ->width(2048)
                    ->height(2048)
                    ->format(Manipulations::FORMAT_WEBP)
                    ->nonQueued();
            });
    }
}
