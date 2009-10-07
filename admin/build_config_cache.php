<?php

require_once('../config/config.php');
require_once('../inc/common.php');

$conn = dbConnect();
$conf = genConfig();
$fh = fopen("../config_cache/modules.php", "w");
fwrite($fh, $conf);
fclose($fh);


/**
 * Generate a complete string representation of config_cache/modules.php from the database.
 * @return string
 */
function genConfig()
{
    $out = "<?php\n";
    $out .= "// PHPsa modules cache file, generated by PHPsa at ".date("Y-m-d H:i:s")."\n";
    $out .= "\n";
    $out .= '$'.'PHPsa_modules = array();'."\n";
    $out .= '$'.'PHPsa_module_paths = array();'."\n";
    $out .= '$'.'PHPsa_path_modules = array();'."\n";
    $out .= "\n";
    $out .= "// BEGIN STATIC\n";
    $out .= '$'.'PHPsa_modules["Home"] = array("url" => "/");'."\n";
    $out .= '$'.'PHPsa_modules["Home"]["pages"] = array(';
    $out .= '"Home" => "index.php", "Foo" => "foo.php"';
    $out .= ');'."\n";
    $out .= '$'.'PHPsa_modules["Admin"] = array("url" => "admin/");'."\n";
    $out .= '$'.'PHPsa_modules["Admin"]["pages"] = array(';
    $out .= '"Home" => "index.php", "Modules" => "modules.php", "Users" => "users.php", "Settings" => "settings.php"';
    $out .= ');'."\n";
    $out .= '$PHPsa_module_paths[\'Home\'] = "/";'."\n";
    $out .= '$PHPsa_path_modules[\'\'] = "Home";'."\n";
    $out .= "\n";
    $out .= '$PHPsa_module_paths[\'Admin\'] = "/admin/";'."\n";
    $out .= '$PHPsa_path_modules[\'/admin/\'] = "Admin";'."\n";

    $out .= "// END STATIC\n";
    $out .= "\n";

    $out .= '$'."PHPsa_module_order = array(";

    $foo = "'Home', ";
    $nameToPath = array();
    $query = "SELECT mod_name,mod_path FROM PHPsa_config_modules WHERE mod_is_enabled=1 ORDER BY mod_order ASC;";
    $result = mysql_query($query) or dberror($query, mysql_error());
    while($row = mysql_fetch_assoc($result))
    {
	$foo .= '"'.$row['mod_name'].'", ';
	$nameToPath[$row['mod_name']] = $row['mod_path'];
    }
    $foo .= "'Admin'";
    $out .= $foo;
    $out .= ');'."\n\n";

    // modules and module pages
    $query = "SELECT * FROM PHPsa_config_modules WHERE mod_is_enabled=1 ORDER BY mod_order ASC;";
    $result = mysql_query($query) or dberror($query, mysql_error());
    while($row = mysql_fetch_assoc($result))
    {
	$out .= '$'.'PHPsa_modules[\''.$row['mod_name'].'\'] = array("url" => "'.$row['mod_path'].'");'."\n";
	$out .= '$'.'PHPsa_modules[\''.$row['mod_name'].'\'][\'pages\'] = array(';
	$foo = "";
	$q = "SELECT * FROM PHPsa_config_module_pages WHERE mod_name='".$row['mod_name']."' ORDER BY page_order ASC;";
	$r = mysql_query($q) or dberror($q, mysql_error());
	while($r2 = mysql_fetch_assoc($r))
	{
	    $foo .= "'".$r2['page_name']."' => '".$r2['page_path']."', ";
	}
	$foo = trim($foo, " ,");
	$out .= $foo;
	$out .= ');';
	$out .= "\n\n";
    }
    // END modules and module pages

    foreach($nameToPath as $name => $path)
    {
	$out .= '$'.'PHPsa_module_paths[\''.$name.'\'] = '.'"/'.$path.'";'."\n";
	$out .= '$'.'PHPsa_path_modules[\'/'.$path.'\'] = '.'"'.$name.'";'."\n";
	$out .= "\n";
    }

    $out .= "\n?>\n";

    return $out;
}



?>