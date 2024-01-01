<?php

namespace MatinUtils\Nodable;

use Illuminate\Contracts\Validation\Rule;

class ModelExist implements Rule
{
    protected $model, $modelName, $column, $relations, $conditions = [], $select = [], $withTrashed;
    public function __construct(string $modelName, string $column = 'id', array $relations = [], array $conditions = [], $select = null, $withTrashed = false)
    {
        $this->modelName = $modelName;
        $this->column = $column;
        $this->relations = $relations;
        $this->conditions = $conditions;
        $this->select = $select;
        $this->withTrashed = $withTrashed;
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
        })->when(!empty($this->select), function ($query) {
            $query->select($this->select);
        })->where($this->column, $value)->with($this->relations)
            ->when(($this->withTrashed), function ($query) {
                $query->withTrashed();
            })->first();
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