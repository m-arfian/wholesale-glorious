<?php

class Alert {
    
    private static $dismissal = '<button type="button" class="close" data-dismiss="alert">&times;</button>';
    
    public static function info($message, $options = '', $pre = '<i class="fa fa-info-circle"></i>') {
        return CHtml::tag('div', array('class'=>'alert alert-info fade in '.$options), self::$dismissal.$pre.$message);
    }

    public static function warning($message, $options = '', $pre = '<i class="fa fa-exclamation-triangle"></i>') {
        return CHtml::tag('div', array('class'=>'alert alert-warning fade in '.$options), self::$dismissal.$pre.$message);
    }

    public static function error($message, $options = '', $pre = '<i class="fa fa-ban"></i>') {
        return CHtml::tag('div', array('class'=>'alert alert-danger fade in '.$options), self::$dismissal.$pre.$message);
    }

    public static function success($message, $options = '', $pre = '<i class="fa fa-check-circle"></i>') {
        return CHtml::tag('div', array('class'=>'alert alert-success fade in '.$options), self::$dismissal.$pre.$message);
    }
    
    public static function normal($message, $options = '', $pre = '<i class="fa fa-check-circle"></i>') {
        return CHtml::tag('div', array('class'=>'alert fade in '.$options), self::$dismissal.$pre.$message);
    }   
    
}
?>
