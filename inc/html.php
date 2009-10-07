<?php
// inc/html.php - common HTML/presentation functions
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

/**
 * Generate and echo the header text
 */
function printHeader()
{
    global $PHPsa_module_order, $PHPsa_modules, $PHPsa_path_modules, $PHPsa_module_paths, $PHPsa_base_url_path;

    $links = array();
    $links["index.php"] = "Home";
    $links["logs.php"] = "Stats";
    $links["web.php"] = "Web";
    $links["syslog.php"] = "Syslog";

    $catLinks = array();
    $catLinks["Home"] = array("index.php" => "Home",  "hosts.php" => "Hosts", "sites.php" => "Sites", "nagios.php" => "Nagios");
    $catLinks["Stats"] = array("logs.php" => "Summary", "logs_spam.php" => "spamd", "logs_bind.php" => "BIND", "logs_mysql.php" => "MySQL");
    $catLinks["Web"] = array("web.php" => "Summary", "web_webmaster.php" => "Google Webmaster", "web_analytics.php" => "Google Analytics", "web_webalizer.php" => "Webalizer");
    $catLinks["Syslog"] = array("syslog.php" => "Summary", "syslog_tail.php" => "Tail", "syslog_search.php" => "Search", "syslog_stats.php" => "Stats");

    echo '<div id="headerContainer">'."\n";
    echo '<div id="header">'."\n";
    echo '	<h1>'.getPageTitle().'</h1>'."\n";
    echo '</div>'."\n";

    echo '<ul id="nav">'."\n";

    $currentModule = "Home";
    foreach($PHPsa_module_order as $modName)
    {
	if(getCurrentModuleName() == $modName)
	{
	    echo '	<li class="nav" id="activeNav"><a href="'.$PHPsa_base_url_path.$PHPsa_module_paths[$modName].'">'.$modName.'</a></li>'."\n";
	    $currentModule = $modName;
	}
	else
	{
	    echo '	<li class="nav"><a href="'.$PHPsa_base_url_path.$PHPsa_module_paths[$modName].'">'.$modName.'</a></li>'."\n";
	}
    }
    echo '</ul>'."\n";

    $currentScript = getCurrentScriptName();

    echo '<ul id="navLower">'."\n";
    foreach($PHPsa_modules[$currentModule]['pages'] as $name => $url)
    {
	$count++;
	if($url == $currentScript)
	{
	    echo '	<li class="navLower" id="activeNavLower"><a href="'.$url.'">'.$name.'</a></li>'."\n";
	}
	else
	{
	    echo '	<li class="navLower"><a href="'.$url.'">'.$name.'</a></li>'."\n";
	}
    }
    echo '</ul>'."\n";
    echo '</div> <!-- close headerContainer DIV -->'."\n";
    echo '<div class="clearing"></div>'."\n";
}

/**
 * Echo the footer text
 */
function printFooter()
{
    global $SVN_rev, $SVN_headURL;
    echo '<div id="footer">'."\n";
    if($_SERVER['REQUEST_URI'] != "/" && $_SERVER['REQUEST_URI'] != "/index.php")
    {
	echo '<a href="index.php">Home</a><br />'."\n";
    }

    echo '<p>Copyright 2009 <a href="http://www.jasonantman.com">Jason Antman</a> All Rights Reserved.<br /></p>';
    echo $_SERVER["SERVER_SIGNATURE"]."<br />"."\n";
    echo '</div> <!-- close footer DIV -->'."\n";
}


?>