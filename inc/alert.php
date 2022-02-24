<?php
    function alert($name = '', $message = '', $class = 'form-message form-message-red'){
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])){
                $_SESSION[$name] = $message;
                $_SESSION[$name.'_class'] = $class;
            }else if(empty($message) && !empty($_SESSION[$name])){
                $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : $class;
                echo '<div class="'.$class.'" >'.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name.'_class']);
            }
        }
    }
?>