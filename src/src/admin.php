<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AdminLogin</title>

    <link href="adminCss.css" type="text/css" rel="stylesheet">
    <script src="adminJS.js"></script>
</head>
<body>
    <div class="title">
        <h1>Admin Login</h1>
    </div>

    <div class="input" >
        <form method="post" action="DB.php">
            Username: &nbsp;&nbsp;&nbsp;&nbsp; <input id="uName" class="inputName" type="text" name="userName"><br>
            <br>
            Passwort: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input id="pW" class="inputPasswort" type="password" name="password"><br>
            <br>
            <input id="submit"  class="inputSubmit" type="submit" value="Anmelden">
        </form>
    </div>

    <script type="text/javascript" language="JavaScript">

    </script>
</body>
</html>
