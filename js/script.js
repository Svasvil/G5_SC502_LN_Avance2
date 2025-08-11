$(function () {
    $('#login-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'router.php?action=login',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    $('#loginResult').text('Login Okay');
                    setTimeout(function () {
                        window.location.href = 'index.php';
                    }, 1000);
                } else {
                    $('#loginResult').text(response.message || 'Error en el login');
                }
            },
            error: function () {
                $('#loginResult').text('Error de conexión con el servidor');
            }
        });
    });

    $(document).ready(function() {
    if ($('#productosTable').length) {
        fetchProductos();
    }

    $('#productosForm').submit(function(e) {
        e.preventDefault();
        let formData = $(this).serialize();
        let action = $('#id_producto').val() ? 'updateProductos' : 'createProductos';

        $.post(`router.php?action=${action}`, formData, function(response) {
            if (response.status === 'success') {
                $('#productosResult').text('Producto guardado correctamente');
                $('#productosForm')[0].reset();
                $('#id_producto').val('');
                $('#cancelEdit').hide();
                fetchProductos();
            } else {
                $('#productosResult').text(response.message || 'Error al guardar el producto');
            }
        }, 'json');
    });

    $('#cancelEdit').click(function() {
        $('#productosForm')[0].reset();
        $('#id_producto').val('');
        $(this).hide();
        $('#productosResult').text('');
    });

    $('#loadProductos').on('click', function() {
        fetchProductos();
    });
});


function fetchProductos() {
  $.get('router.php?action=listProductos', function(response) {
    let rows = '';
    if (response.status === 'success' && response.data.length > 0) {
      response.data.forEach(producto => {
        rows += `
          <tr>
            <td>${producto.id_producto}</td>
            <td>${producto.nombre_producto}</td>
            <td>${producto.descripcion || ''}</td>
            <td class="text-right">${Number(producto.precio).toFixed(2)}</td>
            <td>${producto.nombre_categoria || ''}</td>
            <td>${producto.especie_relacionada || ''}</td>
            <td class="text-center">
              <button onclick="editProducto(${producto.id_producto})" class="btn btn-sm btn-outline-primary mr-1">
                <i class="bi bi-pencil"></i>
              </button>
              <button onclick="deleteProducto(${producto.id_producto})" class="btn btn-sm btn-outline-danger">
                <i class="bi bi-trash"></i>
              </button>
            </td>
          </tr>`;
      });
    } else {
      rows = '<tr><td colspan="7" class="text-center text-muted py-4">No hay productos registrados</td></tr>';
    }
    $('#productosTable tbody').html(rows);
  }, 'json').fail(function() {
    $('#productosTable tbody').html('<tr><td colspan="7" class="text-center text-danger py-4">Error al cargar los productos</td></tr>');
  });
}


/**
 * Fetches a single product's data and populates the form for editing.
 * @param {number} id - The ID of the product to edit.
 */
function editProducto(id) {
    $.get(`router.php?action=showProductos&id=${id}`, function(response) {
        if (response.status === 'success') {
            let producto = response.data;
            $('#id_producto').val(producto.id_producto);
            $('#nombre_producto').val(producto.nombre_producto);
            $('#descripcion').val(producto.descripcion);
            $('#precio').val(producto.precio);
            $('#imagen_url').val(producto.imagen_url);
            $('#id_categoria').val(producto.id_categoria);
            $('#especie_relacionada').val(producto.especie_relacionada);
            $('#cancelEdit').show();
            $('#productosResult').text('Editando producto...');
        } else {
            alert('Error al cargar el producto: ' + (response.message || 'Error desconocido'));
        }
    }, 'json').fail(function() {
        alert('Error de conexión al cargar el producto');
    });
}

/**
 * Sends a request to delete a product.
 * @param {number} id - The ID of the product to delete.
 */
function deleteProducto(id) {
    if (confirm('¿Estás seguro de eliminar este producto?')) {
        $.post('router.php?action=deleteProductos', { id_producto: id }, function(response) {
            if (response.status === 'success') {
                $('#productosResult').text('Producto eliminado correctamente');
                fetchProductos();
            } else {
                alert(response.message || 'Error al eliminar el producto');
            }
        }, 'json').fail(function() {
            alert('Error de conexión al eliminar el producto');
        });
    }
}

window.fetchProductos = fetchProductos;
window.editProducto = editProducto;
window.deleteProducto = deleteProducto;

});