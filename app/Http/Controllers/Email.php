<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Email extends Controller
{
    //
    private $_fromName;

    private $_fromDomain;

    private $_port;

    private $_maxConnectionTimeout;

    private $_maxStreamTimeout;

    public function __construct() {
        $this->_fromName = 'noreply';
        $this->_fromDomain = 'localhost';
        $this->_port = 25;
        $this->_maxConnectionTimeout = 30;
        $this->_maxStreamTimeout = 5;
    }
    public function setEmailFrom($email) {
        list($this->_fromName, $this->_fromDomain) = $this->_parseEmail($email);
    }

    public function setConnectionTimeout($seconds) {
        $this->_maxConnectionTimeout = $seconds;
    }

    public function setStreamTimeout($seconds) {
        $this->_maxStreamTimeout = $seconds;
    }

    public function isValid($email) {
        return (false !== filter_var($email, FILTER_VALIDATE_EMAIL));
    }
    public function getMXrecords($hostname) {
        $mxhosts = array();
        $mxweights = array();
        if (getmxrr($hostname, $mxhosts, $mxweights)) {
            array_multisort($mxweights, $mxhosts);
        }
        $mxhosts[] = $hostname;
        return $mxhosts;
    }   
    
    public function EmailCheck(){
      $email= $_POST['email'];
       $result = false;
        if ($this->isValid($email)) {
            list($user, $domain) = $this->_parseEmail($email);
            $mxs = $this->getMXrecords($domain);
            $fp = false;
            $timeout = ceil($this->_maxConnectionTimeout / count($mxs));
            foreach ($mxs as $host) {
                if ($fp = @stream_socket_client("tcp://" . $host . ":" . $this->_port, $errno, $errstr, $timeout)) {
                    stream_set_timeout($fp, $this->_maxStreamTimeout);
                    stream_set_blocking($fp, 1);
                    $code = $this->_fsockGetResponseCode($fp);
                    if ($code == '220') {
                        break;
                    } else {
                        fclose($fp);
                        $fp = false;
                    }
                }
            }
            if ($fp) {
                $this->_fsockquery($fp, "HELO " . $this->_fromDomain);             
                $this->_fsockquery($fp, "MAIL FROM: <" . $this->_fromName . '@' . $this->_fromDomain . ">");
                $code = $this->_fsockquery($fp, "RCPT TO: <" . $user . '@' . $domain . ">");
                $this->_fsockquery($fp, "RSET");
                $this->_fsockquery($fp, "QUIT");
                fclose($fp);
                if ($code == '250') {
                    $result = true;
                } elseif ($code == '450' || $code == '451' || $code == '452') {
                    $result = true;
                }
            }
        }
        return $code;
    }
    private function _parseEmail(&$email) {
        return sscanf($email, "%[^@]@%s");
    }
    private function _fsockquery(&$fp, $query) {
        stream_socket_sendto($fp, $query . "\r\n");
        return $this->_fsockGetResponseCode($fp);
    }
    private function _fsockGetResponseCode(&$fp) {
        $reply = stream_get_line($fp, 1);
        $status = stream_get_meta_data($fp);
        if ($status['unread_bytes']>0)
        {
            $reply .= stream_get_line($fp, $status['unread_bytes'],"\r\n");
        }
    
            preg_match('/^(?<code>[0-9]{3}) (.*)$/ims', $reply, $matches);
            $code = isset($matches['code']) ? $matches['code'] : false;
            return $code;
    }
    /// test connet outserver
    public function email(){
        return 1;
    }
}
