<?php

class rex_var_twoclick extends rex_var
{
    protected function getOutput()
    {

        $fragment = new rex_fragment();
        return $fragment->parse('2click.php');

    }
}
