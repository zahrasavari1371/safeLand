<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
//    /** @use HasFactory<\Database\Factories\UserFactory> */
//    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'mobile',
        'is_active',
        'company_unit_id',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function fullName()
    {
        return $this->name.' '.$this->surname;
    }

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    public function companyUnit(){
        return $this->belongsTo('App\Models\CompanyUnit');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function inspections()
    {
        return $this->hasMany(InspectionRequest::class);
    }
}
