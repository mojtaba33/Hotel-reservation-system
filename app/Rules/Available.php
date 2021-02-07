<?php

namespace App\Rules;

use App\Models\Bookable;
use Illuminate\Contracts\Validation\Rule;

class Available implements Rule
{
    protected $message;
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $bookable = Bookable::where('slug',$value['slug'])->first();
        if($bookable)
        {
            $this->message = "The {$value['title']} is not available in given dates!";
            return $bookable->checkAvailability($value['from'],$value['to']);
        }else{
            $this->message = "The {$value['title']} is not exist!";
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
