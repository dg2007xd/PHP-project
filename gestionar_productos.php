<!-- INICIO DB.PHP -->
<?php
    require 'db.php';
    session_start();

    //Código que valida si existe una sesión abierta
    if(!isset ($_SESSION['user'])){
    header("Location: login.php");
    exit();
    }


    //Procesar eliminacion del Producto
    if(isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
    
        $stmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            echo "<script>alert('Producto eliminado con exito');</script>";
            header("Location: gestionar_productos.php"); //Redirige despues de la eliminacion
            exit();
        } else {
            echo "<script>alert('Error al eliminar el Producto');</script>";
        }
        }
        
    
        //Agregar logica para obtener informacion de un Producto especifico  (VER)
        if (isset($_GET['view_id'])) {
            $id = $_GET['view_id'];
            $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $producto = $stmt->get_result()->fetch_assoc();
        }
    
    
        //Logica para editar Producto
        if (isset($_POST['update_producto'])) {
            $id = $_POST['id'];
            $nombre = $POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $stock = $_POST['stock'];
    
            $stmt = $conn->prepare("UPDATE productos SET nombre = ?, precio = ?, descripcion = ?, stock = ?");
            $stmt->bind_param("ssssi", $nombre, $precio, $descripcion, $stock, $id);
    
            if ($stmt->execute()) {
                echo "<script>alert('Producto actualizado con exito');</script>";
                echo "<script>location.href='gestionar_productos.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar el Producto');</script>";
            }
        }
    
    
    
    
    
        //Procesar crear Producto desde el formulario
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $descripcion = $_POST['descripcion'];
            $stock = $_POST['stock'];
        
    
            //Insertar el nuevo Producto en la base de datos
            $stmt = $conn -> prepare("INSERT INTO productos(nombre, precio, descripcion, stock) VALUES (?,?,?,?)");
            $stmt ->bind_param("sssi", $nombre, $precio, $descripcion, $stock);
    
            if ($stmt -> execute()) {
                echo "<script>alert('Producto agregado con éxito')</script>";
            } else {
                echo "<script>alert('Error al agregar el Producto')</script>";
            }
        }



    //Variable para la busqueda
    $search = isset($_GET['search']) ? $_GET['search']: '';

    //Consulta SQL para obtener los productos mediante el form de busqueda
    $sql = "SELECT id, nombre, precio, descripcion, stock FROM productos WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%' ";
    $result = $conn->query($sql);
    ?>

   <!-- FIN DB.PHP -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <!-- INICIO HEADER -->
    <?php
    include 'admin_header.php';
    ?>
    <!-- FIN NAVBAR -->

    <div class="container d-flex">

        <div class="container mt-3">
            <h2>Tabla de Productos</h2>
        </div>

        <!-- INICIO BOTONES -->
        <div class="container d-flex justify-content-end mt-4">
        <button class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"> <i class="fa-solid fa-user-plus"></i> Agregar Productos</button>
        <button class="btn btn-outline-dark"> <i class="fa-regular fa-file-pdf"></i> Descargar Productos</button>
        </div>
        <!-- FIN BOTONES -->

    </div>
    
    <!-- Inicio Buscador Productos -->
    <div class="container mt-4">
        <form class="d-flex">
            <input class="form-control me-2" type="search" name="search" method="GET"
            placeholder="Ingresa el nombre del producto que buscas"
            value="<?php echo $search ?>">
            <input class="btn btn-outline-dark" type="submit" value="Buscar">
        </form>
    </div>
    <!-- Fin Buscador -->

    

    <!-- INICIO TABLA PRODUCTOS -->
    <div class="container mt-3">
    

    <?php if ($result -> num_rows > 0 ) {  ?>

        <table class="table table-striped">
            
            <thead>
                <tr>
                    <th>Nombre del Producto</th>
                    <th>Precio del Producto</th>
                    <th>Descripción del Producto</th>
                    <th colspan="3" style="text-align:center;">Acciones </th>
                </tr>
            </thead>

            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td> <?php echo $row["nombre"]?></td>
                    <td> <?php echo $row["precio"]?></td>
                    <td> <?php echo $row["descripcion"]?></td>

                    <td class="option">
                        <form method="GET">
                            <input type="hidden" name="view_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver">
                            <i class="fa-regular fa-eye"></i> </button>
                        </form>
                    </td>
                    
                    <td class="option"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarProductoModal"><i class="fa-regular fa-pen-to-square"></i></button></td>
                    
                    <td class="option">
                        <form method="POST" onsubmit="return confirm('¿Estas seguro de que deseas eliminar este Producto?');">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                        </form>
                    </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>

    <?php  } else {
        echo "No se encontraron productos con los criterios de búsqueda ingresados.";
    }
    ?> 

</div>
<!-- FIN TABLA PRODUCTOS -->

     <!-- INICIO MODAL AGREGAR  Producto-->
     <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="agregarProductoModal">Agregar Nuevo Producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">

            <form method="POST">

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Precio</label>
                <input type="num" name="precio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Descripcion</label>
                <input type="text" name="descripcion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Stock</label>
                <input type="num" name="stock" class="form-control" required>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-dark" value="Crear Producto">
            </div>

            </form>
        </div>
</div>
</div>
</div>

<!-- FIN MODAL AGREGAR  Producto-->


    <!-- INICIO MODAL (VER) Producto -->

    <?php if (isset($producto)) { ?>    
<div class="modal fade show d-block" tabindex="-1" aria-labelledby="verProductoModal" aria-hidden="true" style="background: rgba(0,0,0,0.5);">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verProductoModal">Detalles del Producto</h5>
                <a href="gestionar_productos.php" class="btn-close" aria-label="Cerrar"></a>
            </div>

            <div class="modal-body">
              
                <p><strong>Nombre:</strong> <?php echo $producto['nombre']; ?></p>
                <p><strong>Precio:</strong> <?php echo $producto['precio']; ?></p>
                <p><strong>Descripcion:</strong> <?php echo $producto['descripcion']; ?></p>
                <p><strong>Stock:</strong> <?php echo $producto['stock']; ?></p>
   
            </div>

            <div class="modal-footer">
                <a href="gestionar_productos.php" class="btn btn-secondary">Cerrar</a>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<!-- FIN MODAL VER Producto -->

<!-- INICIO MODAL EDITAR  Producto-->
<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoModal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editarProductoModal">Editar Producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
        <form method="POST">
            <input type="hidden" name="edit_id">

            <div class="mb-3">
                <label for="editNombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="editPrecio" class="form-label">Precio</label>
                <input type="text" name="precio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="editDescripcion" class="form-label">Descripción</label>
                <input type="descripcion" name="descripcion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="editStock" class="form-label">Stock</label>
                <input type="tel" name="stock" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-dark">Guardar Cambios</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>

<!-- FIN MODAL EDITAR  Producto-->


    <!-- INICIO FOOTER -->
    <?php
    include 'footer.php';
    ?>
    <!-- FINI FOOTER -->


    <script>
    document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
</html>