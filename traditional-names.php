<?php

$server = "http://archives.samuseum.sa.gov.au/tindaletribes/";
$suffix = ".htm";

$alpha = array(
    "a",
    "b",
    "c",
    "d",
    "e",
    "f",
    "g",
    "h",
    "i",
    "j",
    "k",
    "l",
    "m",
    "n",
    "o",
    "p",
    "q",
    "r",
    "s",
    "t",
    "u",
    "v",
    "w",
    "y"
);

$tribes = array();

foreach($alpha as $a)
{
    $test = file_get_contents($server . $a . $suffix);
    preg_match_all('/\w*(?=.htm)/', $test, $matches);

    foreach ($matches as $page)
    {
        foreach ($page as $tribe)
        {
            array_push($tribes, $tribe);

        }
    }

}

$unique_tribes = array_unique($tribes);

print_r($unique_tribes);


$tribe_info = array();

foreach($unique_tribes as $tribe)
{
    $response = getUrl($server . $tribe . $suffix);
    if ($response['content'] === FALSE)
    {
        // Do nothing
    }
    else
    {
        $test = $response['content'];
        preg_match('/(?=Co-ordinates<\/td><td>)+?.*(?=<\/td)/', $test, $result);
        $tribe_info[$tribe] = $result[0];
    }


}
 
function getUrl($url) {
    $content = @file_get_contents($url);
    return array(
            'headers' => $http_response_header,
            'content' => $content
        );
}




/*
<tr><td class="col1">Co-ordinates</td><td>139°5'E x 26°50'S</td></tr>

// (?=Co-ordinates<\/td><td>)+?.*(?=<\/td)

$stack = array("orange", "banana");
array_push($stack, "apple", "raspberry");


array_unique($input);
*/


// <a href="ngameni.htm">Ngameni</a>


?>

<HTML>

    <BODY>

        Scanning Traditional Names<BR />

        <span id="raw"></span>

<SCRIPT>
// This is the javascript to scan  Tindale's Aboriginal Tribes of Australia (1974)
//http://archives.samuseum.sa.gov.au/tindaletribes/index.html

var xhttp = new XMLHttpRequest();
var server = "http://archives.samuseum.sa.gov.au/tindaletribes/";

// scan a-w + y
var a = [];
charA = 'a';
charW = 'w';
charY = 'y';

for (i = charA.charCodeAt(0); i <= charW.charCodeAt(0); ++i) {
        a.push(String.fromCharCode(i));
    }
    a.push(String.fromCharCode( charY.charCodeAt(0)));
    console.log(a);
 
// http://archives.samuseum.sa.gov.au/tindaletribes/a.htm




</SCRIPT>

<?php
print_r($tribe_info);
?>
    </BODY>


</HTML>
