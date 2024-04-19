<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
    use LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'post_category_id',
        'user_id',
        'views',
        'likes',
        'comments',
        'status',
        'tags'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    public function commentLike(): HasMany
    {
        return $this->hasMany(PostCommentLike::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function like(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function saveForLater(): HasMany
    {
        return $this->hasMany(PostSaveForLater::class);
    }

    public function getMediaThumbnails(): array
    {
        return [
            'thumbnail' => $this->getFirstMediaUrl('photos', 'thumbnail'),
            'medium' => $this->getFirstMediaUrl('photos', 'medium'),
            'large' => $this->getFirstMediaUrl('photos', 'large'),
            'xlarge' => $this->getFirstMediaUrl('photos', 'xlarge'),
            'original' => $this->getFirstMediaUrl('photos'),
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable();
    }

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
