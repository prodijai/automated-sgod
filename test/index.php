<!DOCTYPE html>
<html>
<head>
    <title>POC and TESTS Page</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<script>
$(function() {
    $( "#skills" ).autocomplete({
        source: '../system/query.php?p=input-entity'
    });
});
</script>
<body>
<div class="ui-widget">
    <label for="skills">Skills: </label>
    <input id="skills">
</div>
</body>

</html>