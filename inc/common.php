<?php
// common.php - common functions
//
// +----------------------------------------------------------------------+
// | PHPsa                        http://phpsa.jasonantman.com            |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Jason Antman.                                     |
// |                                                                      |
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License as published by |
// | the Free Software Foundation; either version 3 of the License, or    |
// | (at your option) any later version.                                  |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to:                           |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+
// |Please use the above URL for bug reports and feature/support requests.|
// +----------------------------------------------------------------------+
// | Authors: Jason Antman <jason@jasonantman.com>                        |
// +----------------------------------------------------------------------+
// | $LastChangedRevision:: 11                                          $ |
// | $HeadURL:: http://svn.jasonantman.com/xmlfinal/inc/common.php      $ |
// +----------------------------------------------------------------------+


// setup MySQL connection
//$conn = mysql_connect($config_db_host, $config_db_user, $config_db_pass) or die("Unable to connect to MySQL database.<br />");
//mysql_select_db($config_db_name) or die("Unable to select database: ".$config_db_name.".<br />");

require_once('html.php');

/**
 * Strip out junk from subversion keyword-replaced variables
 * @param string $s original string
 * @return string
 */
function stripSVNstuff($s)
{
    $s = substr($s, strpos($s, ":")+1);
    $s = str_replace("$", "", $s);
    return trim($s);
}

function dbConnect()
{
    global $PHPsa_config_dbName, $PHPsa_config_dbHost, $PHPsa_config_dbUser, $PHPsa_config_dbPass;
    $conn = mysql_connect($PHPsa_config_dbHost, $PHPsa_config_dbUser, $PHPsa_config_dbPass);
    if(! $conn){ dberror("Connecting to MySQL...", mysql_error()); return false;}
    mysql_select_db($PHPsa_config_dbName) or dberror("Selecting database: $PHPsa_config_dbName", mysql_error());
    return $conn;
}

function dberror($query, $error)
{
    error_log("Database error!\nQuery: $query\nError: $error\n");
    die("Database error. Script dieing...<br />");
}

/**
 * Get the string to use as the title for the current page
 * @return string
 */
function getPageTitle()
{
    $foo = "PHPsa - ".getCurrentModuleName();
    $bar = getCurrentScriptTitle();
    if($bar != "" && $bar != "Home")
    {
	$foo .= " - ".$bar;
    }
    return $foo;
}

/**
 * returns the name of the active module, or "" for the main module
 * @return string
 */
function getCurrentModuleName()
{
    global $PHPsa_base_url_path, $PHPsa_path_modules;

    $foo = $_SERVER["SCRIPT_NAME"];
    if(strstr($foo, $PHPsa_base_url_path)){ $foo = substr($foo, strpos($foo, $PHPsa_base_url_path)+strlen($PHPsa_base_url_path));}

    if(! strpos($foo, "/", 1)){ return "Home";}

    $foo = substr($foo, 0, strrpos($foo, "/")+1);
    return $PHPsa_path_modules[$foo];
}

/**
 * returns the name of the active script
 * @return string
 */
function getCurrentScriptName()
{
    $foo = $_SERVER["SCRIPT_NAME"];
    $foo = substr($foo, strrpos($foo, "/")+1);
    return $foo;
}

/**
 * get the title of the current script
 * @return string
 */
function getCurrentScriptTitle()
{
    //$PHPsa_modules['Logs']['pages'] = array('Home' => 'index.php', "Viewer" => 'viewer.php');
    global $PHPsa_modules;
    $name = getCurrentScriptName();
    $mod = getCurrentModuleName();
    if(in_array($name, $PHPsa_modules[$mod]['pages']))
    {
	return array_search($name, $PHPsa_modules[$mod]['pages']);
    }
    return "";
}

// returns array of files in a directory, optionally matching a regex
function listDirFiles($path, $regex = false)
{
    $foo = array();
    $dh = opendir($path);
    while($entry = readdir($dh))
    {
	if(! is_file($path.$entry) || $entry == "." || $entry == "..") { continue;}
	if(! $regex){ $foo[] = $entry;}
	else
	{
	    if(preg_match($regex, $entry) > 0){ $foo[] = $entry;}
	}
    }
    closedir($dh);
    return $foo;
}

?>