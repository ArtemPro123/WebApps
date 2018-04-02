<html>
<body>
<script>
var sort = "<?php echo $_POST['sortBy'] ?>";
if (sort === 'alpha'){
	window.location.href = "https://submission.cs.cf.ac.uk/ProtasavytskyA/coursework/alphasort.php"
}else if (sort === 'lowHigh'){
	window.location.href = "https://submission.cs.cf.ac.uk/ProtasavytskyA/coursework/lowtohigh.php"
}else if (sort === 'highlow'){
	window.location.href = "https://submission.cs.cf.ac.uk/ProtasavytskyA/coursework/hightolow.php"
}
</script>
</body>
</html>

