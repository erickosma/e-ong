<?php
 
/**
 * Given a time, it gives you the time since then in a friendly format.
 *
 * @package
 * @category
 * @author      Dave Marshall
 * @author      $Author: $
 * @version     $Rev: $
 * @since       $Date: $
 * @link        $URL: $
 * @example <span title="<?php echo date('r', $timestamp);?>"><?php echo $this->timeSince($timestamp);?></span>
 */
class Zend_View_Helper_TimeSince
{
    function timeSince($time, $from = null)
    {
        if ($from == null) {
            $from = time();
        }
        $time = $from - strtotime($time);
 
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
            array(1 , 'second')
        );
 
        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($time / $seconds)) != 0) {
                break;
            }
        }
 
        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }
}
 

 
