<?php

namespace App\Rules;

use App\Models\Bookable;
use Illuminate\Contracts\Validation\Rule;

class Available implements Rule
{
    protected $title;
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->title = $value['title'];
        $bookable = Bookable::where('slug',$value['slug'])->firstOrFail();
        return $bookable->checkAvailability($value['from'],$value['to']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The {$this->title} is not available in given dates!";
    }
}
