<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'show_author' => 'nullable|integer',
            'show_date' => 'nullable|integer',
            'allow_comments' => 'nullable|integer',
            'show_comments_count' => 'nullable|integer',
            'show_likes_count' => 'nullable|integer',
        ];
    }
}
