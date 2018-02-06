<?php

namespace core\components\traits\statemachine;

use izzum\statemachine\utils\PlantUml;
use izzum\statemachine\StateMachine;

trait PlantumlTrait
{
    /**
     * create png image from a valid plantuml code
     *
     * @param StateMachine $machine state machine
     *
     * @return string
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    public static function createStateDiagram($machine)
    {
        /** @var StateMachine $machine */
        $uml          = new PlantUml();
        $plantUmlCode = $uml->createStateDiagram($machine);

        $img = static::encode($plantUmlCode);

        return "<img src=http://www.plantuml.com/plantuml/img/$img>";
    }

    /**
     * To use PlantUML image generation, the text diagram description have to be :
     * - Encoded in UTF-8
     * - Compressed using Deflate algorithm
     * - Re-encoded in ASCII using a transformation close to base64
     *
     * @param string $text text to encode
     *
     * @return string
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    protected function encode($text)
    {
        $data       = utf8_encode($text);
        $compressed = gzdeflate($data, 9);

        return static::encode64($compressed);
    }

    /**
     * Re-encode text in ASCII using a transformation close to base64
     *
     * @param string $c compressed text to encode
     *
     * @return string
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    protected function encode64($c)
    {
        $str = "";
        $len = strlen($c);
        for ($i = 0; $i < $len; $i += 3) {
            if ($i + 2 == $len) {
                $str .= static::append3bytes(ord(substr($c, $i, 1)), ord(substr($c, $i + 1, 1)), 0);
            } else if ($i + 1 == $len) {
                $str .= static::append3bytes(ord(substr($c, $i, 1)), 0, 0);
            } else {
                $str .= static::append3bytes(ord(substr($c, $i, 1)), ord(substr($c, $i + 1, 1)), ord(substr($c, $i + 2, 1)));
            }
        }

        return $str;
    }

    /**
     * add bytes
     *
     * @param string $b1 byte
     * @param string $b2 byte
     * @param string $b3 byte
     *
     * @return string
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    protected function append3bytes($b1, $b2, $b3)
    {
        $c1 = $b1 >> 2;
        $c2 = (($b1 & 0x3) << 4) | ($b2 >> 4);
        $c3 = (($b2 & 0xF) << 2) | ($b3 >> 6);
        $c4 = $b3 & 0x3F;
        $r  = "";
        $r .= static::encode6bit($c1 & 0x3F);
        $r .= static::encode6bit($c2 & 0x3F);
        $r .= static::encode6bit($c3 & 0x3F);
        $r .= static::encode6bit($c4 & 0x3F);

        return $r;
    }

    /**
     * encode text
     *
     * @param string $b bit
     *
     * @return string
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    protected function encode6bit($b)
    {
        if ($b < 10) {
            return chr(48 + $b);
        }
        $b -= 10;
        if ($b < 26) {
            return chr(65 + $b);
        }
        $b -= 26;
        if ($b < 26) {
            return chr(97 + $b);
        }
        $b -= 26;
        if ($b == 0) {
            return '-';
        }
        if ($b == 1) {
            return '_';
        }

        return '?';
    }
}
