<?php
function http_error($thingie,$code,$message)
{
            header('Content-Type: application/text');
    		$thingie->output->set_status_header($code);
    		echo $message;
}
 