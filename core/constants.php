<?php

define('SP','/');
define("ROOT",'http://localhost');
define("SITE_PATH",'furnitas');
define("HOME",ROOT.SP.SITE_PATH);
define("CSS",HOME.SP.'css/');
define("JS",HOME.SP.'js/');
define("JSMODS",'models/');
define("IMAGES",HOME.SP.'img/');
define("AJAX",HOME.SP.'ajax'.SP);
define("CORE",'core');
define("CONTROLLERS",CORE.SP.'controllers/');
define("MODELS",CORE.SP.'models/');
define("VIEWS",CORE.SP.'views/');

define('SPP','\\');
define('TMP',FILE.SPP.'tmp'.SPP);
define('FONTS',FILE.SPP.'fonts'.SPP);