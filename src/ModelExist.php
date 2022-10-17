<?php

namespace MatinUtils\Nodable;

use Illuminate\Contracts\Validation\Rule;

class ModelExist implements Rule
{
    protected $model, $modelName, $column, $relations;
    public function __construct(string $modelName, string $column = 'id', array $relations = [], array $conditions = [])
    {
        $this->modelName = $modelName;
        $this->column = $column;
        $this->relations = $relations;
        $this->conditions = $conditions;
    }
    public function getModel()
    {
        return $this->model;
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->model = $this->modelName::when(!empty($this->conditions), function ($query) {
            foreach ($this->conditions as $col => $val) {
                $query->where($col, $val);
            }
        })->where($this->column, $value)->with($this->relations)->first();
        if (empty($this->model)) {
            return false;
        }
        return true;
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.modelExist');
    }
}
