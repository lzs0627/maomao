<?php

/**
 * id:ユニック
 * url:アクセスのURL
 */

return array(
    
    '_sample_' => array(
        'match'         => '/sample/([a-z]*)/([0-9]*)',
        'controller'    => array('Test','test'),
        'params'        => array('name', 'id')
    )
);
