<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prompt_type',
        'prompt_content',
    ];

    public function savePrompt($data) {
        $this->prompt_type = $data['prompt_type'];
        $this->prompt_content = $data['prompt_content'];
        return $this->save();
    }
}
