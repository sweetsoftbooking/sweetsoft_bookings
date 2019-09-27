<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start' => 'required|date|date_format:"d-m-Y H:i"|after:today',
            'end' => 'required|date|date_format:"d-m-Y H:i"|after:start',
            'people' =>'required|numeric|min:1|max:300',
            'title' => 'required|min:5|max:100'

        ];
    }
}
