<?php

namespace framework;

abstract class abstractFormGenerator {
    
    public static function openForm($action, $method = 'post') {
        return "<form action=\"$action\" method=\"$method\">";
    }

    public static function closeForm() {
        return "</form>";
    }

    public static abstract function generateInput($name, $label, $type = 'text', $value = '', $placeholder = '');

    public static function generateTextarea($name, $label, $value = '', $placeholder = '') {
        return "
            <label for=\"$name\">$label:</label>
            <textarea name=\"$name\" id=\"$name\" placeholder=\"$placeholder\">$value</textarea>
        ";
    }

    public static function generateSelect($name, $label, $options = [], $selected = '') {
        $selectOptions = '';
        foreach ($options as $value => $text) {
            $isSelected = ($value == $selected) ? 'selected' : '';
            $selectOptions .= "<option value=\"$value\" $isSelected>$text</option>";
        }

        return "
            <label for=\"$name\">$label:</label>
            <select name=\"$name\" id=\"$name\">
                $selectOptions
            </select>
        ";
    }
}
