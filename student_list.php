<!DOCTYPE HTML>
<html>
<head>
<title>Student List</title>
<link rel="stylesheet" type="text/css" href="php_style.css">
<script>
var start = 0;
var page = 5;
createTable(start);

function getPrevious() {
	start = start - page;
	if(start < 1) {
		start = 0;
	}
	createTable(start);
}

//ERROR BEING THROWN BECAUSE OF .length
function getNext() {
	if(document.getElementById("student-list-table") &&
			document.getElementById("student-list-table").rows.length-1 == page) {
		start = start + page;
	}
	createTable(start); //This might need to be in the if block
}

function createTable(start) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		    document.getElementById("student-list-table").innerHTML = xmlhttp.responseText;
        }
	}; //SEMICOLON HERE?
	xmlhttp.open("GET", "gettable.php?start=" + start, true);    //true means asynchronous
	xmlhttp.send();
}

function selectChange() {

	id = getId();
	document.getElementById("selectedId").innerHTML = id;
	document.getElementById("updateId").value = id;
	document.getElementById("deleteId").value = id;
}

function getId() {
	var students = document.getElementsByName("selectedRow");
	var i = students.length;
	while(i--) {
		if(students[i].checked) {
			return students[i].value;
		}
	}
}
</script>
</head>
<body>
<div align="center">
<h1>Student List</h1>

<p id="selectedId"></p>
<br>

<div id="student-list-table"></div>

<br>
</div>

<div id="divbutton" align="center">
<form class="inline">
    <button class="button_input" onclick="getPrevious()" type="submit" 
    value="submit" name="previous">Previous</button>
    <button class="button_input" onclick="getNext()" type="submit" 
    value="submit" name="next">Next</button>
</form>
<br><br><br>

<form class="inline" action="student_add.php" method="get">
  <button class="button_input" type="submit" value="submit" name="add">Add</button>
</form>

<form class="inline" action="student_update.php" method="get">
  <input id="updateId" type="hidden" name="id" value="1">
  <button class="button_input" type="submit" value="submit" name="update">Update</button>
</form>

<form class="inline" action="student_delete.php" method="get">
  <input id="deleteId" type="hidden" name="id" value="8">
  <button class="button_input" type="submit" value="submit" name="delete">Delete</button>
</form>

</div>
</body>
</html>