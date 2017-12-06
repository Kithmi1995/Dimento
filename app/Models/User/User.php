<?php

namespace App\Models\User;

use App\Models\Message\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/
    protected $guarded = ['id', 'admin'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'admin',
    ];

    public function isAdmin(){
        return $this->admin == 1;
    }

    public function objects(){
        return $this->hasMany('App\Models\Object\Object');
    }

    public function comments(){
        return $this->hasMany('App\Models\Object\Comment');
    }

    public function ratings(){
        return $this->hasOne('App\Models\Object\Rating');
    }

    public function advertisements(){
        return $this->hasMany('App\Models\Advertisement\Advertisement');
    }

    public function messages(){

        $messages = Message::where('sender_id', auth()->user()->id)
            ->orWhere('recipient_id', auth()->user()->id)
            ->get();
        return $messages;
    }

    public function sent_messages(){

        $messages = Message::where('sender_id', auth()->user()->id)
            ->get();
        return $messages;
    }

    public function received_messages(){

        $messages = Message::where('recipient_id', auth()->user()->id)
            ->get();
        return $messages;
    }

    public function invoices(){
        return $this->hasMany('App\Models\Payment\Invoice');
    }

    public function payment(){
        return $this->hasMany('App\Models\Payment\Payment');
    }

    public function tasks(){
        return $this->hasMany('App\Models\Task\Task');
    }

    public function bids(){
        return $this->hasMany('App\Models\Task\Bids');
    }

    public function notification_msgs(){
        return $this->belongsToMany('App\Models\User\Notifications', 'user_notifications','user_id');
    }

}
