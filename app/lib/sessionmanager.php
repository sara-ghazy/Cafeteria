<?php

namespace CAFETERIA\LIB;

class SessionManager extends \SessionHandler
{
   private $sessionName=SESSION_NAME;
   private $sessionSavePath=SESSION_SAVE_PATH;
   private $sessionLifeTime=SESSION_LIFE_TIME;

   private $sessionHTTPOnly=true;
   private $sessionSSL=false;
   private $sessionDomain='.cafeteria.com';
   private $sessionPath='/';

   private $sessionCipherAlgo='AES-128-ECB';
   private $sessionCipherKey='WYPHPITIPRO@2022';

   private $ttl=30;

   public function __construct()
   {
       ini_set('session.use_cookies',1);
       ini_set('session.use_only_cookies',1);
       ini_set('session.use_trans_sid',0);
       ini_set('session.save_handler','files');

       session_name($this->sessionName);
       session_save_path($this->sessionSavePath);
       session_set_cookie_params(
                                    $this->sessionLifeTime
                                   ,$this->sessionPath,
                                   $this->sessionDomain,
                                   $this->sessionSSL,
                                   $this->sessionHTTPOnly);
//       session_set_save_handler($this, true);
   }
//   public function read($id)
//   {
//       return openssl_decrypt(parent::read($id),$this->sessionCipherAlgo,$this->sessionCipherKey);
//   }

//    public function write($id, $data)
//   {
//       return parent::write($id, openssl_encrypt($data,$this->sessionCipherAlgo,$this->sessionCipherKey));
//   }
   public function __set($key,$value)
   {
       if(is_object($value))
           {
               $_SESSION[$key]=serialize($value);
           }else{
           $_SESSION[$key]=$value;
       }
   }
   public function __get($key){
       if (isset($_SESSION[$key]))
       {
           $data=$_SESSION[$key];
           if($data)
           {
                return $data;
           }
           return $_SESSION[$key];
       }
   }
   public function __isset($key)
   {
       return isset($_SESSION[$key]) ? true : false;
   }
   public function __unset($key)
   {
       unset($_SESSION[$key]);
   }
   public function start()
   {
       if (''===session_id())
       {
           if(session_start())
           {
               $this->setSessionStartTime();
               $this->checkSessionValidity();
           }
       }
   }
   private function setSessionStartTime()
   {
       if (!isset($this->sessionStartTime))
       {
           $this->sessionStartTime=time();
       }
       return true;
   }
   private function checkSessionValidity()
   {
       if (time()-$this->sessionStartTime>$this->ttl*60)
       {
             $this->renewSession();
       }
       return true;
   }
   private function renewSession()
   {
       $this->sessionStartTime=time();
       return session_regenerate_id(true);
   }
   public function kill()
   {
       session_unset();
       setcookie($this->sessionName,'',time()-1000,
                $this->sessionPath,$this->sessionDomain,
                $this->sessionSSL,$this->sessionHTTPOnly);
       session_destroy();
   }

}