<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Ramsey\Uuid\Uuid;

class Todo extends BaseModel
{
    
    /*------------------------------------RELATION-------------------------------------*/

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /*-----------------------------------VALIDATIONS-----------------------------------*/

    private static function loadValidations(){
        
        $translationsFile = APP_ROOT . '/app/Translations/models/todoValidations.php';

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
        'title',
        'description',
        'category',
        'checked',
        'account_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'string',
        'title' => 'string',
        'description' => 'string',
        'category' => 'string',
        'checked' => 'boolean',
        'account_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*-------------------------------SORT-FILTER-FIELDS--------------------------------*/

    public function getFields(){
        return $this->fields;
    }

    public function getExtFields(){
        return $this->extraFields;
    }
    
    private $fields = [
        'title',
        'description',
        'category',
        'checked',
        'account_id',
    ];

    private $extraFields = [
    ];
}
