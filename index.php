<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-16">
    <title>AJAX</title>
    <script>
        function showHint(str) {
            document.getElementById("txtHint").textContent = str;
        }

    </script>
</head>
<body>
<p><b>Start typing a name in the input field below:</b></p>
<form action="">
    <label for="fname">First name:</label>
    <input type="text" id="fname" name="fname" onkeyup="showHint(this.value)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>
</body>
</html>