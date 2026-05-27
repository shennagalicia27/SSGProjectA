<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'contactno',
        'user_account_id',
    ];

    protected $appends = [
        'full_name',
    ];

    public function userAccount(): BelongsTo
    {
        return $this->belongsTo(UserAccounts::class, 'user_account_id');
    }

    public function getFullNameAttribute(): string
    {
        return trim(collect([$this->fname, $this->mname, $this->lname])->filter()->implode(' '));
    }
}
