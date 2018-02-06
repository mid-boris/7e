<?php

namespace Modules\Base\Contract\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Base\Constants\ConnectionConfigConstants;
use Modules\Base\Exception\BaseException;
use Modules\Error\Constants\ErrorCode;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new BaseException(
            $validator->getMessageBag(),
            ErrorCode::BASE_PARAMETER_INVALID
        );
    }

    protected function getExists(string $table, $column = 'NULL')
    {
        return Rule::exists(ConnectionConfigConstants::MAIN_CONNECTION_NAME . '.' . $table, $column);
    }

    protected function getExistsExceptId(string $table, int $id, $column = 'NULL')
    {
        return Rule::exists(ConnectionConfigConstants::MAIN_CONNECTION_NAME . '.' . $table, $column)
            ->where(function ($query) use ($id) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('id', '!=', $id);
            });
    }

    protected function idValidate(string $table, $column = 'NULL')
    {
        return [
            'required',
            'integer',
            'min:1',
            $this->getExists($table, $column),
        ];
    }

    protected function sometimesIdValidate(string $table, $column = 'NULL')
    {
        return [
            'sometimes',
            'integer',
            'min:1',
            $this->getExists($table, $column),
        ];
    }

    protected function idValidateExceptId(string $table, int $id, $column = 'NULL')
    {
        return [
            'required',
            'integer',
            'min:1',
            $this->getExistsExceptId($table, $id, $column),
        ];
    }
}
