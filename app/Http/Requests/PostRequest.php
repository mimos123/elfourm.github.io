<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       // dd($this->all());
        return [

        'content' => 'required|string',
        'type' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max file size 2MB
        'jpo_id' => 'required|exists:jpos,id',
        'user_id' => 'required|exists:users,id', // Ensure jpo_id exists in the database
        ];
    }

}
