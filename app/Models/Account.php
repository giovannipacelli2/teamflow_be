<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Uuid;


class Account extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasUuids;

    protected static function boot()
    {
        parent::boot();

        // listener on event 'creating'
        static::creating(function ($model) {

            $model->id = Uuid::uuid4()->toString();
        });
    }

    
    /*------------------------------------RELATION-------------------------------------*/

    /* public function diets(): HasMany
    {
        return $this->hasMany(Diet::class);
    } */


    /*-----------------------------------PERMISSIONS-----------------------------------*/

    public function isAdmin() : bool {

        if ($this->username === 'admin') {
            return true;
        }
        return false;
    }

    /* public function hisPatient($patientId) : bool {

        $check = $this->patients()->where('id', $patientId)->get()->toArray();

        if ($check) {
            return true;
        }
        return false;
    } */

    /*----------------------------------STATIC-METHODS---------------------------------*/



    /*-----------------------------------VALIDATIONS-----------------------------------*/

    private static function loadValidations(){
        
        $translationsFile = APP_ROOT . '/app/Translations/models/accountValidations.php';

        $validations = [];

        if (file_exists($translationsFile)){
            $validations = require_once($translationsFile);
        }

        return $validations;
    }

    public static function getValidations(){
        return static::loadValidations();
    }

    /*-------------------------------------FIELDS--------------------------------------*/
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'surname',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /*-------------------------------SORT-FILTER-FIELDS--------------------------------*/

    public function getFields(){
        return $this->fields;
    }

    public function getExtFields(){
        return $this->extraFields;
    }
    
    private $fields = [
        'username',
        'name',
        'email',
        'surname',
        'password',
    ];

    private $extraFields = [
    ];
}