<?php

namespace app\controller;

class formGenerator {
    
        // ******* Functions for form tags ******* // 
    public static function openForm($action, $method = 'post') {
        return "<form action=\"$action\" method=\"$method\">";
    }

    public static function closeForm() {
        return "</form>";
    }

    // May use attribute string here
    public static function generateInput($name, $label, $type = 'text', $labelAttributes = [], $inputAttributes = [],$value = '', $placeholder = '') {
        $labelString = self::generateAttributeString($labelAttributes);
        $inputString = self::generateAttributeString($inputAttributes);

        echo "Label String: " . $labelString;
        return "
            <label for=\"$name\" {$labelString}>$label:</label>
            <input type=\"$type\" name=\"$name\" id=\"$name\" value=\"$value\" placeholder=\"$placeholder\" {$inputString}>
        ";
    }

    public static function generateInputButton($name, $label, $type = 'text', $value = '', $placeholder = '') {
        return "
            <input type=\"$type\" name=\"$name\" id=\"$name\" value=\"$value\" placeholder=\"$placeholder\">
        ";
    }

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

    // ******* Functions for normal tags ******* // 

    public static function openTag($tagName, $attributes = [])
    {
        $attributeString = self::generateAttributeString($attributes);
        return "<{$tagName}{$attributeString}>";
    }

    public static function closeTag($tagName)
    {
        return "</{$tagName}>";
    }

    public static function generateTag($tagName, $content = null, $attributes = [])
    {
        $attributeString = self::generateAttributeString($attributes);

        if ($content !== null) {
            return "<{$tagName}{$attributeString}>{$content}</{$tagName}>";
        } else {
            return "<{$tagName}{$attributeString} />";
        }
    }

    private static function generateAttributeString($attributes)
    {
        $attributeString = '';

        foreach ($attributes as $name => $value) {
            $attributeString .= " {$name}=\"{$value}\"";
        }

        return $attributeString;
    }
}
