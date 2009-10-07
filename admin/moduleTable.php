<?php
// admin/moduleTable.php
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

echo '<table class="minorTable">'."\n";
$conn = dbConnect();

echo '<tr><th>Name</th><th>Action</th><th>Order</th></tr>'."\n";

// Home module is always first
echo '<tr><td>Home</td><td>&nbsp;</td><td>&nbsp;</td>';

$query = "SELECT * FROM PHPsa_config_modules ORDER BY mod_order ASC;";
$result = mysql_query($query) or dberror($query, mysql_error());
$numRows = mysql_num_rows($result);
$count = 0;
while($row = mysql_fetch_assoc($result))
{
    echo '<tr>';
    echo '<td>'.$row['mod_name'].'</td>';

    // action
    if($row['mod_is_enabled'] == 0)
    {
	echo '<td><a href="javascript:toggleModule(\''.$row['mod_name'].'\')">Enable</a></td>';
    }
    else
    {
	echo '<td><a href="javascript:toggleModule(\''.$row['mod_name'].'\')">Disable</a></td>';
    }

    // order
    echo '<td>';
    if($count != 0)
    {
	echo '<a href="javascript:moveModule(\''.$row['mod_name'].'\',-1)">&uarr;</a>';
    }
    echo '&nbsp;&nbsp;&nbsp;&nbsp;';
    if($count != ($numRows-1))
    {
	echo '<a href="javascript:moveModule(\''.$row['mod_name'].'\',1)">&darr;</a>';
    }
    echo '</td>';

    echo '</tr>'."\n";
    $count++;
}

// Admin module is always last
echo '<tr><td>Admin</td><td>&nbsp;</td><td>&nbsp;</td>';

echo '</table>'."\n";

?>