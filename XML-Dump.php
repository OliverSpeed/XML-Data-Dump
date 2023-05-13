<?php
$start_time = microtime(true);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

/* this is a example string. Incase you don't have these datas in your furnidata, download the latest one from Habbo. Self-generated ones will break your custom furniture. */
$xmlstr = <<<XML
<?xml version='1.0' standalone='yes'?>
<furnidata>
<roomitemtypes>
<furnitype id="13" classname="shelves_norja">
	<revision>61856</revision>
	<category>shelf</category>
	<defaultdir>0</defaultdir>
	<xdim>1</xdim>
	<ydim>1</ydim>
	<partcolors>
		<color>#ffffff</color>
		<color>#F7EBBC</color>
	</partcolors>
	<name>Beige Bookcase</name>
	<description>For nic naks and books.</description>
	<adurl></adurl>
	<offerid>5</offerid>
	<buyout>1</buyout>
	<rentofferid>-1</rentofferid>
	<rentbuyout>0</rentbuyout>
	<bc>1</bc>
	<excludeddynamic>0</excludeddynamic>
	<customparams></customparams>
	<specialtype>1</specialtype>
	<canstandon>0</canstandon>
	<cansiton>0</cansiton>
	<canlayon>0</canlayon>
	<furniline>iced</furniline>
	<environment></environment>
	<rare>0</rare>
</furnitype>
</roomitemtypes>
</furnidata>
XML;

$xml = new SimpleXMLElement(file_get_contents('furnidata.xml'));
$savesql = 'items_base.sql';

// Open file for writing (creates file if it doesn't exist)
$fp = fopen($savesql, 'w');

echo 'SQL dump 2.0 by Oliver' . "\n";
foreach($xml->roomitemtypes->furnitype as $product)
{
    $allow_walk = $product->canstandon;
	$name = $product->name;
	$name = preg_replace('/[\'`]/', '\\\\$0', $name); // add backslash infront of ' & `. Do this for desc aswell If you use it.
    //$description = $product->description;
    $allow_sit = $product->cansiton;
    $allow_lay = $product->canlayon;
    $width = $product->xdim;
    $length = $product->ydim;
    $classname = $product->attributes()['classname'];
    $blyat = 'UPDATE `items_base` SET `public_name` = \''.$name. '\', `allow_walk` = \''.$allow_walk. '\', `allow_sit` = \''.$allow_sit.'\', `allow_lay` = \''.$allow_lay.'\', `width` = \''.$width.'\', `length` = \''.$length.'\' WHERE `item_name` = \''.$classname.'\';';

    $output = $blyat . "\n";
    file_put_contents($savesql, $output, FILE_APPEND);
}

foreach($xml->wallitemtypes->furnitype as $product)
{
    $name = $product->name;
	$name = preg_replace('/[\'`]/', '\\\\$0', $name); // add backslash infront of ' & `. Do this for desc aswell If you use it.
	//$description = $product->description;
    $classname = $product->attributes()['classname'];
    $blyat = 'UPDATE `items_base` SET `public_name` = \''.$name.'\' WHERE `item_name` = \''.$classname.'\';';

    $output = $blyat . "\n";
    file_put_contents($savesql, $output, FILE_APPEND);
}

// Notify its done and time for fun
$end_time = microtime(true);
$time_taken = round($end_time - $start_time, 2);
echo "Completed in " . $time_taken . " seconds.";
fclose($fp);
?>
