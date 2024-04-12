<?php

class ValidatorService
{
    public static function validate($input, $rules)
    {
        $result = ['errors' => []];

        foreach ($rules as $key => $rule) {
            $rules = explode('|', $rule);

            foreach ($rules as $rule) {
                if ($rule === 'required' && empty($input[$key])) {
                    $result['errors'][$key] = "The $key field is required";
                }

                if ($rule === 'email' && !filter_var($input[$key], FILTER_VALIDATE_EMAIL)) {
                    $result['errors'][$key] = "The $key field must be a valid email address";
                }

                if ($rule === 'numeric' && !is_numeric($input[$key])) {
                    $result['errors'][$key] = "The $key field must be a number";
                }

                if (strpos($rule, 'min') !== false) {
                    $min = explode(':', $rule)[1];
                    if (strlen($input[$key]) < $min) {
                        $result['errors'][$key] = "The $key field must be at least $min characters";
                    }
                }

                if (strpos($rule, 'max') !== false) {
                    $max = explode(':', $rule)[1];
                    if (strlen($input[$key]) > $max) {
                        $result['errors'][$key] = "The $key field must be at most $max characters";
                    }
                }
            }
        }

        return $result;
    }

    public static function checkArrayFields($input, $fields)
    {
        $result = ['errors' => []];

        foreach ($fields as $field) {
            if (!array_key_exists($field, $input)) {
                $result['errors'][$field] = "The $field field is required";
            }
        }

        return $result;
    }
}
