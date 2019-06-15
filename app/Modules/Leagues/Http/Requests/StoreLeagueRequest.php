<?php

namespace App\Modules\Leagues\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeagueRequest extends FormRequest
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
        $rules = [];


        $rules['title'] = 'required|string';

        if ($this->method() == 'PATCH' || $this->method() == 'PUT') {
            $rules['slug'] = 'nullable|string|unique:leagues,slug,' . $this->route('sport');

        } else {
            $rules['slug'] = 'nullable|string|unique:leagues,slug';
        }

        $rules['visible'] = 'boolean';

        return $rules;
    }
}
