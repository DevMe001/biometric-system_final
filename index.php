<?php
// Define the directory separator and root path
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', dirname(__FILE__));

// Include the configuration files
require_once(ROOT_PATH . DS . 'src/configuration' . DS . 'config.php');
require_once(ROOT_PATH . DS . 'src/configuration' . DS . 'database.php');
require_once(ROOT_PATH . DS . 'src/function' . DS . 'index.php');
require_once(ROOT_PATH . DS . 'src/function' . DS . 'helper.php');

// Autoloading function
function autoload($className)
{
  if (file_exists(ROOT_PATH . DS . 'public' . DS . $className . '.php')) {
    require_once(ROOT_PATH . DS . 'public' . DS . $className . '.php');
  } elseif (file_exists(ROOT_PATH . DS . 'src' . DS . $className . '.php')) {
    require_once(ROOT_PATH . DS . 'src' . DS . $className . '.php');
  } else {
    die('File is not found for class ' . $className);
  }
}

// Register the autoloader
spl_autoload_register('autoload');

// Include additional files or scripts as needed
require(ROOT_PATH . DS . 'src' . DS . 'condition.php');
