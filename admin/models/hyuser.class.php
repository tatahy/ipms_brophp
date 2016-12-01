<?php
	class Hyuser {
		function logout(){
			session_start();
            
            $_SESSION=array();

			if(isset($_COOKIE[session_name()])){
				setCookie(session_name(), '', time()-42000, '/');
			}

			session_destroy();
		}
	}
