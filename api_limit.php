<?php
/**
 * API Limit Throttler
 */
class ApiLimit
{
    
    function limit($requests,$time)
    {
        session_start();
        $stamp_init = date("Y-m-d H:i:s");
        if( !isset( $_SESSION['FIRST_REQUEST_TIME'] ) ){
                $_SESSION['FIRST_REQUEST_TIME'] = $stamp_init;
        }
        $first_request_time = $_SESSION['FIRST_REQUEST_TIME'];
        $stamp_expire = date( "Y-m-d H:i:s", strtotime( $first_request_time )+( $time ) );
        if( !isset( $_SESSION['REQ_COUNT'] ) ){
                $_SESSION['REQ_COUNT'] = 0;
        }
        $req_count = $_SESSION['REQ_COUNT'];
        $req_count++;
        //Expired
        if( $stamp_init > $stamp_expire ){
                $req_count = 1;
                $first_request_time = $stamp_init;
        }
        //Set Sessions
        $_SESSION['REQ_COUNT'] = $req_count;
        $_SESSION['FIRST_REQUEST_TIME'] = $first_request_time;
        //Set Headers
        header('X-RateLimit-Limit:'.$requests.'');
        header('X-RateLimit-Remaining:'.( $requests-$req_count ).'  ');
        //If user got his requests limit block him from accesing API
        if( $req_count > $requests){
                $response = json_encode(array(
                'status' => '429',
                'message' => 'Too many requests',
                ), TRUE);
                print_r($response); 
                http_response_code(429);
                die();
        }  
    }
//Reset all users requests to 0
    function unset(){
        unset($_SESSION["REQ_COUNT"]);
    }
}
?>