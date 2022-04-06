<?php

$ebay_link = "https://www.ebay.it/itm/133705250987";

$file = file_get_contents($ebay_link);

//Product title
$html = new DOMDocument();
@$html->loadHTML($file);
echo "Product title: ".$html->getElementById('itemTitle')->nodeValue;

echo "<br>";

//Normal price
$html2 = new DOMDocument();
@$html2->loadHTML($file);
echo "Normal price: ".$html2->getElementById('prcIsum')->nodeValue;

echo "<br>";

//Original price
$html3 = new DOMDocument();
@$html3->loadHTML($file);
foreach($html3->getElementsByTagName('span') as $a) {
    $property = $a->getAttribute('class');
    if ($property == "vi-originalPrice") {
    	echo "Original price: ".$a->nodeValue;
    }
}

echo "<br>";

//Image link
$html4 = new DOMDocument();
@$html4->loadHTML($file);
$image = $html4->getElementById('icImg');
$imagelink = urldecode($image->getAttribute('src'));
echo "Image link:  ".$imagelink;

echo "<br>";

//Coupon Code
$html5 = new DOMDocument();
@$html5->loadHTML($file);
foreach($html5->getElementsByTagName('div') as $b) {
    $property = $b->getAttribute('class');
    if ($property == "d-coupon-overlay-coupon-only__coupon-code") {
    	echo "Coupon code: ".$b->nodeValue;
    }
}

echo "<br>";

$html6 = new DOMDocument();
@$html6->loadHTML($file);
foreach($html6->getElementsByTagName('span') as $c) {
    $property = $c->getAttribute('class');
    if ($property == "ux-textspans--BOLD") {
    	if (str_contains($c->nodeValue, 'EUR')) {
    		echo "Coupon discount amount: ".$c->nodeValue;
    	}
    }
}

echo "<br>";

//EPN link
$campid = "5338441827";
$subid = "5338898191";
$varid = "";
$rotationid = "724-53478-19255-0";

$links = explode("/", $ebay_link);
$prodid = explode("?", $links[4]);

$EPNlink = $links[0]."/".$links[1]."/".$links[2]."/".$links[3]."/".$prodid[0]."?var=".$varid."&mkevt=1&mkcid=1&mkrid=".$rotationid."&campid=".$campid."&toolid=10050&customid=".$subid;

echo "EPN link: ".$EPNlink;

?>