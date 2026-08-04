<?php

namespace Modules\Authentication\Models;

use Laravel\Scout\Searchable;
use Modules\Users\Models\User;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Authentication\Database\Factories\AuthenticationFactory;

/**
 * @property string $email
 * @property string $password
 */
#[Fillable(['email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class Authentication extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;

    /** @use HasFactory<AuthenticationFactory> */
    use HasFactory;

    use HasUlids;
    use Notifiable;
    use Searchable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * @return Factory<Authentication>
     */
    protected static function newFactory(): Factory
    {
        return AuthenticationFactory::new();
    }

    public function user(): User
    {
        return User::where('id', $this->id)->first();
    }
}
