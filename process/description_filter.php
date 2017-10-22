<?php
    // This function will cut down any text to a specified character limit but returns a full word if it detects a word is in the character limit and returns it with triple dots.
    function substrwords($text, $maxchar, $end='...') {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\s/', $text);      
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                } 
                else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        } 
        else {
            $output = $text;
        }
        return $output;
    }
?>