<?php
class Form {
    private $fields;

    public function __construct() {
        $this->fields = array();
    }

    public function getFields() {
        return $this->fields;
    }

    public function getField($var_name) {
        return $this->fields[$var_name];
    }

    // Returns fields in error. Can be useful for tying errors to inputs in the DOM.
    public function getErrors() {
        
        $errors = array();
        
        foreach($this->fields as $field) {
            if($field->hasError == TRUE) {
                $errors[] = $field;
            }
        }
        return $errors;
    }
        
    // Returns an array of error messages. Useful for simple feedback.
    public function getErrorMessages() {
        
        $errors = array();
        
        foreach($this->fields as $field) {
            if($field->hasError == TRUE) {
                $errors[] = $field->message;
            }
        }

        return $errors;
    }

    // The following functions represent various fields that will be validated on creation.
    public function text($var_name, $ui_name, $value, $required = TRUE, $min_length = 1, $max_length = 255) {
        
        $fail_message = NULL;
        $has_error = FALSE;

        // Check that the string exists and falls between the lengths set.
        if(!$required && empty($value)) {
            // Jump to the bottom
        } else if($required && empty($value)) {
            $fail_message = "$ui_name is required.";
            $has_error = TRUE;
        } else if (strlen($value) < $min_length) {
            $fail_message = $ui_name . " is too short. Keep it between ". $min_length . " and " . $max_length . ".";
            $has_error = TRUE;
        } else if (strlen($value) > $max_length) {
            $fail_message = $ui_name . " is too long. Keep it between ". $min_length . " and " . $max_length . ".";
            $has_error = TRUE;
        }

        // Add the field to the array.
        $field = new Field($var_name, $ui_name, $has_error, $fail_message);
        $this->fields[$var_name] = $field;

        return $field;
    }

    public function email($var_name, $ui_name, $value, $required = TRUE) {
        
        $fail_message = NULL;
        $has_error = FALSE;

        // Just use PHP's email validate
        $is_email = filter_var($value, FILTER_VALIDATE_EMAIL);

        if(!empty($value)) {
            if($is_email === FALSE) {
                $fail_message = "Invalid $ui_name.";
                $has_error = TRUE;
            }
        } else {
            if($required) {
                $fail_message = "$ui_name is required.";
                $has_error = TRUE;
            }
        }

        // Add the field to the array.
        $field = new Field($var_name, $ui_name, $has_error, $fail_message);
        $this->fields[$var_name] = $field;

        return $field;
    }

    public function phone($var_name, $ui_name, $value, $required = TRUE) {

        $pattern = '/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/';

        // Generic pattern will handle creating the new field.
        $pattern_match = $this->pattern($var_name, $ui_name, $value, $required, $pattern);
        
        return $pattern_match;
    }

    public function password($var_name, $ui_name, $value, $required = TRUE, $min_length = 6, $max_length = 18) {

        // one lower, one upper, one digit, one symbol, between min and max length
        $pattern = '/^.*(?=.{' . $min_length . ',' . $max_length . '})(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%&? "]).*$/';

        $fail_message = $ui_name . " must contain one number, special symbol, upper-case letter, and lower-case letter. It must also be between " . $min_length . " to " . $max_length . " characters.";

        $pattern_match = $this->pattern($var_name, $ui_name, $value, $required, $pattern, $fail_message);

        return $pattern_match;
    }

    public function password_match($var_name, $ui_name, $value1, $value2) {
        
        $message = NULL;
        $has_error = FALSE;
        
        if($value1 !== $value2) {
            $message = "Passwords do not match.";
            $has_error = TRUE;
        }

        // Add the field to the array.
        $field = new Field($var_name, $ui_name, $has_error, $message);
        $this->fields[$var_name] = $field;

        return $field;
    }

    public function state($var_name, $ui_name, $value, $required = TRUE) {

        // An array of valid state abbreviations
        $states = array(
            'AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC',
            'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY',
            'LA', 'ME', 'MA', 'MD', 'MI', 'MN', 'MS', 'MO', 'MT',
            'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'OH',
            'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT',
            'VT', 'VA', 'WA', 'WV', 'WI', 'WY');
        $states = implode('|', $states);

        $pattern = '/^(' . $states . ')$/';

        // Generic pattern will handle creating the new field.
        $pattern_match = $this->pattern($var_name, $ui_name, $value, $required, $pattern);
        
        return $pattern_match;
    }

    public function zip($var_name, $ui_name, $value, $required = TRUE) {

        // match 5 digits and an optional dash with 4 digits
        $pattern = '/^\d{5}(?:[-\s]\d{4})?$/';

        // Generic pattern will handle creating the new field.
        $pattern_match = $this->pattern($var_name, $ui_name, $value, $required, $pattern);
        
        return $pattern_match;
    }

    public function cardNumber($var_name, $ui_name, $value, $required = TRUE) {

        // match 16 digits
        $pattern = '/^(\d{4}(?:[-\\s])?){4}$/';

        // Generic pattern will handle creating the new field.
        $pattern_match = $this->pattern($var_name, $ui_name, $value, $required, $pattern);
        
        return $pattern_match;
    }

    public function ccv($var_name, $ui_name, $value, $required = TRUE) {

        // match 3 digits
        $pattern = '/^\d{3}$/';        
        
        // Generic pattern will handle creating the new field.
        $pattern_match = $this->pattern($var_name, $ui_name, $value, $required, $pattern);
        
        return $pattern_match;
    }

    public function monthYear($var_name, $ui_name, $value, $required = TRUE) {
        
        // match 2 digits, a slash then 4 digits
        $pattern = '/^\d{2}\/\d{4}$/';        
        
        // Generic pattern will handle creating the new field.
        $pattern_match = $this->pattern($var_name, $ui_name, $value, $required, $pattern);
        
        return $pattern_match;
    }

    public function pattern($var_name, $ui_name, $value, $required = TRUE, $pattern, $fail_message = NULL) {
        
        // If the user didn't pass in a fail message use this default one.
        if($fail_message === NULL) {
            $fail_message = "Invalid $ui_name.";
        }

        $has_error = FALSE;

        // If the field has something in it, we check it
        if(!empty($value)) {

                // Check field and set or clear error message
                $match = preg_match($pattern, $value);

                // If the regex threw an error, let the user know
                if ($match === FALSE) {
                    $fail_message = 'Error testing ' . $ui_name . '.';
                    $has_error = TRUE;

                // If the pattern was not matched
                } else if ( $match != 1 ) {
                    $has_error = TRUE;

                // Field is valid, empty the message
                } else {
                    $fail_message = NULL;
                }
        } else {

            // If the field is empty and required then throw and error.
            if($required) {
                $fail_message = "$ui_name is required.";
                $has_error = TRUE;
            }
        } 

        // Add the field to the array.
        $field = new Field($var_name, $ui_name, $has_error, $fail_message);
        $this->fields[$var_name] = $field;

        return $field;
    }
}

class Field {
    public $varName = '';
    public $uiName = '';
    public $hasError = FALSE;
    public $message = '';

    public function __construct($var_name, $ui_name, $has_error = FALSE, $message = NULL) {
        $this->varName = $var_name;
        $this->uiName = $ui_name;
        $this->hasError = $has_error;
        $this->message = $message;
    }
}