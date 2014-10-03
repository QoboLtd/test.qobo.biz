<?php
/**
 * Load all requirements
 * 
 * @todo Migrate to the properl spl_autoload_register();
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Result' . DIRECTORY_SEPARATOR . 'iResult.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Result' . DIRECTORY_SEPARATOR . 'Result.php';

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Parameters' . DIRECTORY_SEPARATOR . 'iParameter.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Parameters' . DIRECTORY_SEPARATOR . 'Parameter.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Parameters' . DIRECTORY_SEPARATOR . 'TextParameter.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Parameters' . DIRECTORY_SEPARATOR . 'UrlParameter.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Parameters' . DIRECTORY_SEPARATOR . 'HiddenParameter.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Parameters' . DIRECTORY_SEPARATOR . 'HttpClientParameter.php';

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Tests' . DIRECTORY_SEPARATOR . 'iTest.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Tests' . DIRECTORY_SEPARATOR . 'BaseTest.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Tests' . DIRECTORY_SEPARATOR . 'UrlTest.php';

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestFactory.php';
?>
