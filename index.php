<?PHP

$names = [];

if ($_POST["postcode"] || $_GET["refresh"])
{
$servername = "localhost";
$username = "user"; // Update with your DB username
$password = "pass"; // Update with your DB password
$dbname = "database"; // Update with your DB name


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if($_POST["postcode"])
{
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM postcode WHERE code = " . $_POST["postcode"];


$postcodes = $conn->query($sql);

if ($postcodes->num_rows > 0) {
	while($row = $postcodes->fetch_assoc()) {
		


$sql = "UPDATE inputCount SET cnt = cnt + 1 WHERE nam = '" . $row["nam"] . "';";

if ($conn->query($sql) === TRUE) {
//  echo "record updated successfully";
}

}
}
}

$sql = "SELECT * FROM inputCount;";

$result = $conn->query($sql);



if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	//    echo "name: " . $row["nam"]. " - count: " . $row["cnt"]. " - coord: " . $row["lat"]. " " . $row["lon"]. "<br>";
	    array_push($names, array($row["nam"], $row["cnt"]));
  	// print_r($names);
    }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}






$conn->close();

}



?>


<HTML>
    <HEAD>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wordcloud2.js/1.0.6/wordcloud2.min.js"></script>

<?PHP
	if ($_GET["refresh"]) {
		echo '<meta http-equiv="refresh" content="' . $_GET["refresh"] . '">';
	}
?>

</HEAD>
<BODY>

    <form action="/?refresh=30"  method="post">
        Enter your postcode <input type="number" name="postcode" id="postcode" step="1" min="800" max="9726"/><BR />
        <input type="submit" value="share" /><BR/>
    </form>

<div style="with:100%; text-align:center;">
    <canvas id="cloud"  width="1170" height="760" style="overflow:hidden; display: inline;;"></canvas>
</div>
</BODY>


</HTML>


<script>

var list = [

<?PHP
foreach ($names as $name)
{
	if ($name[1] > 0)
	{
	echo '["' . $name[0] . '",';

	if ($name[1] > 11)
	{
		echo '12';
	}
	else
	{
		echo $name[1];
	}	
	
	echo	'],';
	
	}}
?>
];

console.log(WordCloud.isSupported);
WordCloud.minFontSize = "10px"
    WordCloud(document.getElementById('cloud'), { 'list': list, rotationRatio: 0, gridSize: 9, weightFactor: 10, rotationSteps: 2, backgroundColour: '#ffe0e0' } );


    </script>
