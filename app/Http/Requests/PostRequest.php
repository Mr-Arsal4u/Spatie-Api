<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Service\PostService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
 
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // dd('here');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        // dd('here');
        return [
            'title' => 'required|max:250|min:2',
            'body' => 'required|max:250|min:3',
        ];
    }
}
