<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4 en Ratlla</title>
</head>
<body>
    <h1>Bienvenido al juego del 4 en Ratlla</h1>

    <form action='../src/index.php' method="post">
        <label for="nombre">Nombre del jugador: </label>
        <br><br>
        <input type="text" name="nombre">
        <br><br>

        <label for="color">Elija el color: </label>
        <input type="color" name="color">
        <br><br>
        <input type="submit" value="Entrar al juego">
    </form>

</body>
</html>