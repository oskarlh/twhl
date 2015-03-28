<?php

namespace App\Helpers\BBCode\Tags;
 
class PreTag extends Tag {

    function __construct()
    {
        $this->token = 'pre';
        $this->element = 'pre';
    }

    public function FormatResult($result, $parser, $scope, $options, $text)
    {
        $str = '<' . $this->element;
        if ($this->element_class) $str .= ' class="' . $this->element_class . '"';
        $str .= '><code>';
        $str .= $parser->CleanString($text);
        $str .= '</code></' . $this->element . '>';
        return $str;
    }
}
