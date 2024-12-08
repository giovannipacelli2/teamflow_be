<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

//use Ramsey\Uuid\Uuid;

class Todo extends BaseModel
{
    protected static $modelName = 'todo';
    /*------------------------------------RELATION-------------------------------------*/

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function sharedWith(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'account_todo');
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
        'note',
        'category',
        'checked',
        'account_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'pivot',
    ];

    protected $casts = [
        'id' => 'string',
        'title' => 'string',
        'description' => 'string',
        'note' => 'string',
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
        'note',
        'category',
        'checked',
        'account_id',
        'created_at',
        'updated_at',
    ];

    private $extraFields = [
    ];
}
