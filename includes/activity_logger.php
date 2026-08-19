<?php
    function LogActivity($pdo,$user_id,$user_email,$action,$status='sucess') {
       try{
            //Get Client IP Address
            $ip = $_SERVER['HTTP_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
         
         
            if(strpos($ip,',') !== false){
                $ip = explode(',', $ip)[0];


            }


            //Get User Agent
            $user_agent =  substr($_SERVER['HTTP_USER_AGENT'] ?? 'unknown', 0, 255);

            //apllication Query
            $stmt = $pdo -> prepare("
            INSERT INTO activity_logs(
                user_id,
                user_email,
                activity_log_action,
                activity_status,
                activity_ip_address,
                activity_user_agent
            ) VALUES (?,?,?,?,?,?)
            ");
           

       }catch(PDOException $e){
           error_log("Activity Log Error: " . $e->getMessage());
           return false;
       }
    }


?>