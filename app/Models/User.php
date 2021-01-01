<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Article;
use App\Models\Ability;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        $role = $this->stringToRole($role);

        $this->roles()->sync($role, false);
    }

    public function removeRole($role)
    {
        $role = $this->stringToRole($role);

        $this->roles()->detach($role);
    }

    public function hasRole($role)
    {
        $role = $this->stringToRole($role);

        return $this->roles->contains($role);
    }

    protected function stringToRole($role) {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }

        return $role;
    }
}