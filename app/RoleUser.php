<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RoleUser
 *
 * @property int $user_id
 * @property int $role_id
 * @property-read \App\Role $role
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RoleUser whereUserId($value)
 * @mixin \Eloquent
 */
class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = [
        'role_id', 'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
