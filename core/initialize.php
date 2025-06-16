<?php 
    defined('DS')?null: define('DS',DIRECTORY_SEPARATOR);
    defined('SITE_ROOT')?null: define('SITE_ROOT',DS.'xampp'.DS.'htdocs'.DS.'Assignment3');
    defined('INC_PATH')?null: define('INC_PATH',SITE_ROOT.DS.'includes');
    defined('CORE_PATH')?null: define('CORE_PATH',SITE_ROOT.DS.'core');

    require_once(INC_PATH.DS."config.php");
    require_once(CORE_PATH.DS."patient.php");
    require_once(CORE_PATH.DS."patient_address.php");
    require_once(CORE_PATH.DS."patient_record.php");
    require_once(CORE_PATH.DS."user.php");


?>