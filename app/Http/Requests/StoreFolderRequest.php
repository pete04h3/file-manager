<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ParentIdBaseRequest;
use App\Models\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreFolderRequest extends ParentIdBaseRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'name' => [
                'required',
                Rule::unique(File::class, 'name')
                    ->where(function ($query) {
                        $query->where('created_by', Auth::id())
                            ->where('parent_id', $this->parent_id)
                            ->whereNull('deleted_at');
                    }),
            ],
        ]);
            
      
    }


    public function messages()
    {
        return [
            'name.unique' => 'Folder ":input" already exists',
        ];
    }
}
