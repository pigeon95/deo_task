<?php
namespace Users\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Users\Contracts\UserInterface;
use Users\Traits\HasRolesTrait;

class User extends Authenticatable implements UserInterface
{
    use HasRolesTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * get all user's roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('Users\Models\Role')->withTimestamps();
    }

    /**
     * return user id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * return user status
     *
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * return name of user's status
     *
     * @return null|string
     */
    public function getStatusName(): ?string
    {
        $statuses = config('users.statuses');
        $status = isset($statuses[$this->status])?$statuses[$this->status]:"";
        return $status;
    }
}
