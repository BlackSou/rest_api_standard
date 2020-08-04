<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
class PlayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
      $rules = [
          'title' => 'required|string|unique:plays,title',
          'description' => '',
          'complexity' => 'required|min:1|max:10',
          'minPlayers' => 'required|min:1|max:10',
          'maxPlayers' => 'required|min:1|max:10',
          'isActive' => 'required|boolean'
      ];

      switch ($this->getMethod())
      {
        case 'POST':
          return $rules;
        case 'PUT':
          return [
            'play_id' => 'required|integer|exists:plays,id',
            'title' => [
              'required',
              Rule::unique('plays')->ignore($this->title, 'title')
            ]
          ] + $rules;
        case 'DELETE':
          return [
              'play_id' => 'required|integer|exists:plays,id'
          ];
      }
    }

    public function messages()
    {
        return [
            'date.required' => 'Дата обязательна',
            'date.date_format'  => 'Дата должна быть в формате: Y-m-d',
            'date.unique'  => 'Эта дата уже занята',
            'date.after_or_equal'  => 'Дата должна быть не раньше сегодняшнего дня',
            'date.exists'  => 'Такой даты нет',
        ];
    }

    public function all($keys = null)
    {
      $data = parent::all($keys);
      switch ($this->getMethod())
      {
        case 'DELETE':
          $data['date'] = $this->route('day');
      }
      return $data;
    }
}
