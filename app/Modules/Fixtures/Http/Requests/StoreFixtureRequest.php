<?php

namespace App\Modules\Fixtures\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFixtureRequest extends FormRequest
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
            $rules['slug'] = 'nullable|string|unique:fixtures,slug,' . $this->route('fixture');

        } else {
            $rules['slug'] = 'nullable|string|unique:fixtures,slug';
        }

        $rules['date'] = 'date';
        $rules['homeTeamOdds'] = 'digits';
        $rules['awayTeamOdds'] = 'digits';
        $rules['drawOdds'] = 'digits';
        $rules['visible'] = 'boolean';

        return $rules;
    }
}
