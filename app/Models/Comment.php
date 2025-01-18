<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends BaseModel
{
    protected static $modelName = 'comment';
    /*------------------------------------RELATION-------------------------------------*/

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function todo(): BelongsTo
    {
        return $this->belongsTo(Todo::class);
    }


    /*-------------------------------------FIELDS--------------------------------------*/
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'created_at',
        'updated_at',
        'todo_id',
        'account_id',
    ];

    protected $hidden = [
        'pivot',
    ];

    protected $casts = [
        'id' => 'string',
        'content' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'todo_id' => 'string',
        'account_id' => 'string',
    ];

    /*-------------------------------SORT-FILTER-FIELDS--------------------------------*/

    public function getFields(){
        return $this->fields;
    }

    public function getExtFields(){
        return $this->extraFields;
    }
    
    private $fields = [
        'id',
        'content',
        'created_at',
        'updated_at',
        'todo_id',
        'account_id',
    ];

    private $extraFields = [
    ];
}
