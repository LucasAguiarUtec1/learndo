<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Chatify\Models\Message;
use Chatify\Models\Conversation;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
        'nombrecompleto',
        'telefono',
        'biografia',
        'fb_id',
        'userable_type',
        'userable_id',
        'foto',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'from_id');
    }

    public function chats()
    {
        return $this->belongsToMany(Conversation::class, 'chatify_conversation_user', 'user_id', 'conversation_id')
            ->orderBy('created_at', 'desc');
    }

    public function getChatifyId()
    {
        return $this->id;
    }

    public function getChatifyName()
    {
        return $this->nickname;
    }

    public function getChatifyAvatar()
    {
        return $this->foto;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userable()
    {
        return $this->morphTo();
    }

    protected function nickname(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    protected function biografia(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_string($value) ? ucwords($value) : null,
            set: fn ($value) => is_string($value) ? htmlspecialchars($value) : null,
        );
    }

    protected function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function colaboraciones()
    {
        return $this->hasMany('App\Models\Colaboracion');
    }
}
