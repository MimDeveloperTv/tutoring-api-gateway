<?php

namespace App\Models;

use App\Actions\Auth\GetDomainConnectionAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Enum\Field;

class User extends Authable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const USERNAME_FIELD = Field::MOBILE;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'national_code',
        'password',
        'email',
        'mobile',
        'firstname',
        'lastname',
        'birth_date',
        'gender',
        'avatar',
        'isActive',
        'api_token',
        'email_verified_at',
        'deleted_at',
        'created_at',
        'updated_at',
        'personnel',
        'operators',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function findForPassport(string $username): User
    {
        return $this->where(self::USERNAME_FIELD, request()->input('username'))->firstOrFail();
    }

    public function getConnectionName(): ?string
    {
        $this->connection = GetDomainConnectionAction::make()->handle();
        return parent::getConnectionName();
    }
}
