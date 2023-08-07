<?php

return [

    /*
     * If enable key is true then
     * it create a log in public/route_hit_counter.json 
     * file.
     */    

     "enable" => true,

     
    'middleware' => [
        'web',
        'api',
    ],
];