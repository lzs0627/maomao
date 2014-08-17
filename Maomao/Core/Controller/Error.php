<?php
namespace Maomao\Core\Controller;

use Maomao\Core\Object as Object;
use Maomao\Core\View\Base as View_Base;

/**
 * Description of newPHPClass
 *
 * @author lizhaoshi
 */
class Error extends Object{
    
    
    public static function notfound() {
        $protocol = filter_input(INPUT_SERVER, 'SERVER_PROTOCOL');
        header($protocol." 404 Not Found"); 
        
        echo '<html>';
        echo '<head>';
        echo '<title>NotFound</title>';
        echo '</head>';
        echo '<body>';
        echo '<p>Not Found</p>';
        echo '</body>';
        echo '</html>';
        
        
    }
    
}
