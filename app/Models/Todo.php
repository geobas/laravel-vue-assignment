<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Toggle 'done' flag.
     *
     * @return self
     */
    public function toggleDone(): self
    {
        $this->done = !$this->done;

        return $this;
    }
}
