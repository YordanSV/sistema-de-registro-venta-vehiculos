<form action="register.php" method="post">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        
        <label for="telefono">Telefono:</label>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <label for="direccion">Direccion:</label>
        <input type="text" id="direccion" name="direccion" required><br><br>

        <label for="tipo_usuario">Tipo de Usuario:</label>
        <select id="tipo_usuario" name="tipo_usuario" required>
            <option value="Administrador">Administrador</option>
            <option value="Cliente">Cliente</option>
        </select><br><br>
        
        <input type="submit" value="Insertar Usuario">
    </form>