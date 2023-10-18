<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoleEnum;
use App\Events\UserSignUpEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use InteractsWithMedia;

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

    public function getRoleAttribute(): string
    {
        return $this->roles->pluck('name')->first() ?? UserRoleEnum::USER->name;
    }

    // TODO! switch to s3
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
