<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            //
            "title"=>"required|max:255",
            "body"=> "required|max:5000",
            "category_id"=> "required",
        ];
    }
    public function messages(){
        return [
            "title.required"=>"le titre est obligatoire.",
            "title.max"=>"le titre doit contenir moins de 255 caractères.",
            "body.required"=>"le contenu est obligatoire.",
            "body.max"=>"le contenu doit contenir moins de 5000 caractères.",
            "category_id.required"=>"the category id field ",];
        }
    }

