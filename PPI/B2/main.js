function editar(x) {
    let permiso = confirm("¿Estás seguro de que quieres eliminar este registro?");
    if (permiso) {
        $.ajax({
            url: 'eliminar.php',
            type: 'POST',
            data: { id: x },
            success: function(response) {
                // Envía una solicitud AJAX para obtener los datos actualizados
                $.ajax({
                    url: 'obtener_datos.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Actualiza el contenido de la tabla con los datos recibidos
                        let filas = '';
                        data.forEach(function(fila) {
                            filas += '<tr>';
                            filas += '<td>' + fila.id + '</td>';
                            filas += '<td>' + fila.nombre + '</td>';
                            filas += '<td>' + fila.correo + '</td>';
                            filas += '<td>' + fila.rol_texto + '</td>';
                            filas += '<td><button onclick="editar(' + fila.id + ')">Editar</button></td>';
                            filas += '</tr>';
                        });
                        $('.tablaadmi tbody').html(filas);
                    }
                });
            }
        });
    }
}