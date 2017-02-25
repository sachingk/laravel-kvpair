<?php


return [

    /***
     * If this is set to TRUE all the get functions (except getKVPairByKey) will give the output ready to
     * bind with <select> html control by default. The $forDropDown parameter passed will be ignored.
     */
    'alwaysGetForDropdown' => false,     // true or false


    /***
     * Value assigned to this will used as a key for select when rendering the get function for dropdown.
     */
    'selectKey'=>-1     // '' or 0 or -1 or anything
];