<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|min:1|max:128',
            'description' => 'max:512',
            'region' => 'required|numeric|min:1',
            'city' => 'numeric',
            'village' => 'numeric',
            'status' => 'required|numeric',
            'image.*' => 'required|mimes:jpg,bmp,png'
        ];
    }
}
