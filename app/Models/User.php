<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserAuthProviderEnum;
use App\Enums\UserRoleEnum;
use App\Events\UserSignUpEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use InteractsWithMedia;
    use LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'provider',
        'provider_id',
        'provider_token',
        'provider_refresh_token',
        'avatar',
        'about'
    ];

    protected $appends = [
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $dispatchesEvents = [
        'created' => UserSignUpEvent::class,
    ];

    public function follower(): HasMany
    {
        return $this->hasMany(UserFollower::class);
    }

    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comment(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    public function commentLike(): HasMany
    {
        return $this->hasMany(PostCommentLike::class);
    }

    public function getRoleAttribute(): string
    {
        return $this->roles->pluck('name')->first() ?? UserRoleEnum::USER->name;
    }

    public function getDefaultAvatar(): string
    {
        return 'https://ui-avatars.com/api/?name=' . $this->name . '&color=383838&background=dee2e6&length=1';
    }

    public function getAvatar(): string
    {
        if ($this->provider === UserAuthProviderEnum::GOOGLE->value) {
            return $this->avatar;
        }

        if (!empty($this->getFirstMediaUrl('avatar'))) {
            return $this->avatar;
        }

        return  $this->getDefaultAvatar();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable();
    }

    // TODO! move to s3 object storage once in production
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->useDisk('public')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumbnail')
                    ->width(300)
                    ->height(300)
                    ->nonQueued();
            });
    }
}
