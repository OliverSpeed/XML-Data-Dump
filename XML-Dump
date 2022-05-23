<?php

$start = microtime(true);

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

//Loop trough multiple products
echo '-- sql dump test 1.0 by Oliver <br />';
foreach($xml->roomitemtypes->furnitype as $product)
{
	$allow_walk = $product->canstandon; // can you walk on it?
	//$description = $product->description;
	$allow_sit = $product->cansiton; // can you sit on it?
	$allow_lay = $product->canlayon; // can you lay on it?
	$width = $product->xdim;
	$length = $product->ydim;
	$classname = $product->attributes()['classname'];
	echo 'UPDATE `items_base` SET `allow_walk` = \''.$allow_walk. '\', `allow_sit` = \''.$allow_sit.'\', `allow_lay` = \''.$allow_lay.'\', `width` = \''.$width.'\', `length` = \''.$length.'\' WHERE `item_name` = \''.$classname.'\';';
    echo '<br/>';
}
?>
