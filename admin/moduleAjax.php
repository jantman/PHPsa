<?php
// admin/moduleAjax.php
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
// | $LastChangedRevision:: 1                                           $ |
// | $HeadURL:: http://svn.jasonantman.com/multibindadmin/index.php     $ |
// +----------------------------------------------------------------------+

require_once('../config/config.php');
require_once('../inc/common.php');

$conn = dbConnect();

if(isset($_GET['action']) && $_GET['action'] == "toggle")
{
    $modName = mysql_real_escape_string($_GET['mod_name']);
    $query = "UPDATE PHPsa_config_modules SET mod_is_enabled=1 WHERE mod_name='".$modName."' AND mod_is_enabled=0;";
    $query = "UPDATE PHPsa_config_modules SET mod_is_enabled=(IF(mod_is_enabled=1,0,1)) WHERE mod_name='".$modName."';";
    $result = mysql_query($query) or dberror($query, mysql_error());
    require_once('moduleTable.php');
}
elseif(isset($_GET['action']) && $_GET['action'] == "move")
{
    $modName = mysql_real_escape_string($_GET['mod_name']);
    $direction = (int)$_GET['direction'];
    
    $query = "SELECT mod_order FROM PHPsa_config_modules WHERE mod_name='$modName';";
    $result = mysql_query($query) or dberror($query, mysql_error());
    if(mysql_num_rows($result) < 1){ die("ERROR: Unknown module name: $modName\n");}
    $oldOrder = mysql_fetch_assoc($result);
    $oldOrder = $oldOrder['mod_order'];
    $newOrder = $oldOrder + $direction;

    $query = "UPDATE PHPsa_config_modules SET mod_order=$oldOrder WHERE mod_order=$newOrder;";
    $result = mysql_query($query) or dberror($query, mysql_error());
    $query = "UPDATE PHPsa_config_modules SET mod_order=$newOrder WHERE mod_name='".$modName."';";
    $result = mysql_query($query) or dberror($query, mysql_error());
    require_once('moduleTable.php');
}

?>