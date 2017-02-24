<?php

namespace sachingk\kvpair;

class kvpair
{

    public static function saySomething() {
       // return 'Hello World!';

        //return config('kvpair.dropdown_select_string');

         return trans('kvpair::langTrans.select');
    }

}