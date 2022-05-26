<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','phone',
        'mobile_phone','postal_code','street','house_number','complement',
        'neighborhood','city','state', 'country','provider', 'provider_id'
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

    public function store()
    {
        return $this->hasOne(Store::class);
    }

    public function orders()
    {
       return $this->hasMany(UserOrder::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function search($filter = null)
    {

        $results = $this->where(function ($query) use($filter){
            if($filter){
                $query->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('email', 'LIKE', "%{$filter}%")
                    ->orWhere('role', 'LIKE', "%{$filter}%")->get();
            }
        })->paginate(15);

        return($results);

    }



    public function userAddress(){
        return $this->hasOne(UserAddress::class);
    }



}
