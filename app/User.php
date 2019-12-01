<?php

namespace App;

use App\Enums\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'name', 'surname', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tickets()
    {
        return $this->hasMany('App\Ticket', 'author_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'author_id');
    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'user_task');
    }

    public function isAdmin() {
        return $this->role == \App\Enums\UserRole::Admin;
    }

    public function isDirector() {
        return in_array($this->role, [UserRole::Director, UserRole::Admin], true);
    }

    public function isManager() {
        return in_array($this->role, [UserRole::Manager, UserRole::Director, UserRole::Admin], true);
    }

    public function isEmployee() {
        return in_array($this->role, [UserRole::Employee, UserRole::Manager, UserRole::Director, UserRole::Admin], true);
    }

    public function isCustomer() {
        return in_array($this->role, [UserRole::Customer, UserRole::Employee, UserRole::Manager, UserRole::Director, UserRole::Admin], true);
    }

    public function isAuthorOfTicket($ticket_id) {
        return $this->tickets()->find($ticket_id);
    }
}
