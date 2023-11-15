<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ParentIdBaseRequest extends FormRequest
{

    public ?File $parent = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool

    {
        $this->parent = File::query()->where('id', $this->input('parent_id'))->first();

        if ($this->parent && !($this->parent->isOwnedBy(Auth::id()))) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'parent_id' => [
                Rule::exists(File::class, 'id')
                    ->where(function (QueryBuilder $query) {
                       return $query
                            ->where('is_folder', '=', '1')
                            ->where('created_by', '=', Auth::id());
                    }),
            ],
        ];
    }
}
