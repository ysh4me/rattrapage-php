<?php

namespace App\Core;

class Validator {
    public static function validate(array $data, array $rules): array {
        $errors = [];

        foreach ($rules as $field => $ruleSet) {
            $rules = explode('|', $ruleSet);

            foreach ($rules as $rule) {
                if ($rule === 'required' && (!isset($data[$field]) || empty($data[$field]))) {
                    $errors[$field][] = "Le champ $field est obligatoire.";
                }

                if (strpos($rule, 'min:') === 0) {
                    $min = (int)explode(':', $rule)[1];
                    if (isset($data[$field]) && strlen($data[$field]) < $min) {
                        $errors[$field][] = "Le champ $field doit contenir au moins $min caractères.";
                    }
                }

                if (strpos($rule, 'max:') === 0) {
                    $max = (int)explode(':', $rule)[1];
                    if (isset($data[$field]) && strlen($data[$field]) > $max) {
                        $errors[$field][] = "Le champ $field ne doit pas dépasser $max caractères.";
                    }
                }

                if ($rule === 'integer' && isset($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_INT)) {
                    $errors[$field][] = "Le champ $field doit être un nombre entier.";
                }

                if (strpos($rule, 'min_value:') === 0) {
                    $minValue = (int)explode(':', $rule)[1];
                    if (isset($data[$field]) && $data[$field] < $minValue) {
                        $errors[$field][] = "Le champ $field doit être supérieur ou égal à $minValue.";
                    }
                }

                if (strpos($rule, 'max_value:') === 0) {
                    $maxValue = (int)explode(':', $rule)[1];
                    if (isset($data[$field]) && $data[$field] > $maxValue) {
                        $errors[$field][] = "Le champ $field doit être inférieur ou égal à $maxValue.";
                    }
                }

                if (strpos($rule, 'in:') === 0) {
                    $values = explode(',', substr($rule, 3));
                    if (isset($data[$field]) && !in_array($data[$field], $values)) {
                        $errors[$field][] = "Le champ $field doit être une des valeurs suivantes : " . implode(', ', $values) . ".";
                    }
                }

                if ($rule === 'file' && isset($_FILES[$field])) {
                    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
                        $errors[$field][] = "Le fichier pour $field est obligatoire.";
                    }
                }
                
                if (strpos($rule, 'type:') === 0 && isset($_FILES[$field])) {
                    $allowedTypes = explode(',', substr($rule, 5));
                    $fileType = mime_content_type($_FILES[$field]['tmp_name']);
                    if (!in_array($fileType, $allowedTypes)) {
                        $errors[$field][] = "Le fichier pour $field doit être de type " . implode(', ', $allowedTypes) . ".";
                    }
                }
                
                if (strpos($rule, 'max_size:') === 0 && isset($_FILES[$field])) {
                    $maxSize = (int)explode(':', $rule)[1] * 1024 * 1024; // Convertir Mo en octets
                    if ($_FILES[$field]['size'] > $maxSize) {
                        $errors[$field][] = "Le fichier pour $field ne doit pas dépasser " . ($maxSize / (1024 * 1024)) . " Mo.";
                    }
                }
                
                if ($rule === 'boolean') {
                    if (isset($data[$field]) && !in_array($data[$field], ['1', '0'], true)) {
                        $errors[$field][] = "Le champ $field doit être oui (1) ou non (0).";
                    }
                }
                
            }
        }

        return $errors;
    }
}
