<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;



class UserStoreRequest extends FormRequest

{

    public function rules()

    {

        return [

            'email_address' => 'required|unique:users|max:255',

            'phone_number' => 'unique:users|max:255',

            'first_name' => 'required',

        ];

    }



    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));

    }



    public function messages()

    {

        return [

            'email.required' => 'Email is required',

            'phone_number.required' => 'Phone is required'

        ];

    }

}
