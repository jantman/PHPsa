<?php

require_once('../config/config.php');
require_once('../inc/common.php');

$conn = dbConnect();
$ts = time();
parseModuleConfigs();

/**
 * Find all modules, trigger the cacheModuleConfig() function for each.
 * Also clean out the module cache.
 * @return boolean
 */
function parseModuleConfigs()
{
    global $PHPsa_base_fs_path, $ts;;

    $path = $PHPsa_base_fs_path."modules/";
    $dh = opendir($path);

    while($entry = readdir($dh))
    {
	if(is_dir($path.$entry) && $entry != "." && $entry != "..")
	{
	    $foo = cacheModuleConfig($entry, $path.$entry."/");
	    if(! $foo){ echo '<p>Failed to add module at: '.$path.$entry.'</p>'."\n";}
	}
    }

    // clean up old modules and pages
    $query = "DELETE FROM PHPsa_config_modules WHERE updated_ts < $ts;";
    $result = mysql_query($query) or dberror($query, mysql_error());
    $query = "DELETE FROM PHPsa_config_module_pages WHERE updated_ts < $ts;";
    $result = mysql_query($query) or dberror($query, mysql_error());

    makeModuleOrders();

    return true;
}

/**
 * Updates module order for anything that doesn't have it.
 * @return boolean
 */
function makeModuleOrders()
{
    $query = "SELECT MAX(mod_order) FROM PHPsa_config_modules;";
    $result = mysql_query($query) or dberror($query, mysql_error());
    $row = mysql_fetch_assoc($result);
    $order = $row['MAX(mod_order)'];
    if($order == null){ $order = 0;}
    $order++;

    $query = "SELECT * FROM PHPsa_config_modules WHERE mod_order IS NULL;";
    $result = mysql_query($query) or dberror($query, mysql_error());
    while($row = mysql_fetch_assoc($result))
    {
	$q = "UPDATE PHPsa_config_modules SET mod_order=$order WHERE mod_name='".$row['mod_name']."';";
	$r = mysql_query($q) or dberror($q, mysql_error());
	$order++;
    }
    return true;
}

/**
 * Read in a module config file and cache it in the DB.
 * @param $name string the name as seen in the module path
 * @param $path the absolute filesystem path to the module
 * @return boolean
 */
function cacheModuleConfig($name, $path)
{
    global $ts;
    if(! is_file($path."config/mod_config.php")){ return false;}
    require_once($path."config/mod_config.php");

    $query = "INSERT INTO PHPsa_config_modules SET mod_name='".mysql_real_escape_string($module_name)."',mod_path='".mysql_real_escape_string($module_info['url'])."',updated_ts=".$ts." ON DUPLICATE KEY UPDATE mod_path='".mysql_real_escape_string($module_info['url'])."',updated_ts=".$ts.";";
    $result = mysql_query($query) or dberror($query, mysql_error());
    if(! $result){ return false;}

    $count = 0;
    foreach($module_pages as $name => $path)
    {
	$query = "INSERT INTO PHPsa_config_module_pages SET mod_name='".mysql_real_escape_string($module_name)."',page_name='".mysql_real_escape_string($name)."',page_path='".mysql_real_escape_string($path)."',page_order=$count,updated_ts=".$ts." ON DUPLICATE KEY UPDATE page_path='".mysql_real_escape_string($path)."',page_order=$count,updated_ts=".$ts.";";
	$result = mysql_query($query) or dberror($query, mysql_error());
	$count++;
    }
    return true;
}

?>