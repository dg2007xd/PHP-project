<!-- INICIO DB.PHP -->
<?php
    require 'db.php';
    session_start();

    //Código que valida si existe una sesión abierta
    if(!isset ($_SESSION['user'])){
    header("Location: login.php");
    exit();
    }


    //Procesar eliminacion del Sucursal
    if(isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
    
        $stmt = $conn->prepare("DELETE FROM sucursales WHERE id = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            echo "<script>alert('Sucursal eliminado con exito');</script>";
            header("Location: gestionar_sucursales.php"); //Redirige despues de la eliminacion
            exit();
        } else {
            echo "<script>alert('Error al eliminar la Sucursal');</script>";
        }
        }
        
    
        //Agregar logica para obtener informacion de un Sucursal especifico  (VER)
        if (isset($_GET['view_id'])) {
            $id = $_GET['view_id'];
            $stmt = $conn->prepare("SELECT * FROM sucursales WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $sucursal = $stmt->get_result()->fetch_assoc();
        }
    
    
        //Logica para editar Sucursal
        if (isset($_POST['update_sucursal'])) {
            $id = $_POST['id'];
            $nombre = $POST['nombre'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
    
            $stmt = $conn->prepare("UPDATE sucursales SET nombre = ?, direccion = ?, telefono = ?, email = ?");
            $stmt->bind_param("ssssi", $nombre, $direccion, $telefono, $email, $id);
    
            if ($stmt->execute()) {
                echo "<script>alert('Sucursal actualizado con exito');</script>";
                echo "<script>location.href='gestionar_sucursales.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar el Sucursal');</script>";
            }
        }
    
    
    
    
    
        //Procesar crear Sucursal desde el formulario
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];

        
    
            //Insertar el nuevo Sucursal en la base de datos
            $stmt = $conn -> prepare("INSERT INTO sucursales(nombre, direccion, telefono, email) VALUES (?,?,?,?)");
            $stmt ->bind_param("sssi", $nombre, $direccion, $telefono, $email);
    
            if ($stmt -> execute()) {
                echo "<script>alert('Sucursal agregado con éxito')</script>";
            } else {
                echo "<script>alert('Error al agregar el Sucursal')</script>";
            }
        }

    //Variable para la busqueda
    $search = isset($_GET['search']) ? $_GET['search']: '';

    //Consulta SQL para obtener los sucursales mediante el form de busqueda
    $sql = "SELECT id, nombre, direccion, telefono, email FROM sucursales WHERE nombre LIKE '%$search%' OR direccion LIKE '%$search%' ";
    $result = $conn->query($sql);
    ?>

   <!-- FIN DB.PHP -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
            <h2>Tabla de Sucursales</h2>
        </div>

        <!-- INICIO BOTONES -->
        <div class="container d-flex justify-content-end mt-4">
        <button class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#agregarSucursalModal"> <i class="fa-solid fa-user-plus"></i> Agregar Sucursales</button>
        <button class="btn btn-outline-dark"> <i class="fa-regular fa-file-pdf"></i> Descargar Sucursales</button>
        </div>
        <!-- FIN BOTONES -->

    </div>
    
    <!-- Inicio Buscador Sucursales -->
    <div class="container mt-4">
        <form class="d-flex">
            <input class="form-control me-2" type="search" name="search" method="GET"
            placeholder="Ingresa el nombre de la sucursal que buscas"
            value="<?php echo $search ?>">
            <input class="btn btn-outline-dark" type="submit" value="Buscar">
        </form>
    </div>
    <!-- Fin Buscador -->

    

    <!-- INICIO TABLA SUCURSAL -->
    <div class="container mt-3">
    

    <?php if ($result -> num_rows > 0 ) {  ?>

        <table class="table table-striped">
            
            <thead>
                <tr>
                    <th>Nombre de la Sucursal</th>
                    <th>Dirección de la Sucursal</th>
                    <th>Teléfono de la Sucursal</th>
                    <th colspan="3" style="text-align:center;">Acciones </th>
                </tr>
            </thead>

            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td> <?php echo $row["nombre"]?></td>
                    <td> <?php echo $row["direccion"]?></td>
                    <td> <?php echo $row["telefono"]?></td>

                    <td class="option">
                        <form method="GET">
                            <input type="hidden" name="view_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver">
                            <i class="fa-regular fa-eye"></i> </button>
                        </form>
                    </td>
                    
                    <td class="option"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarSucursalModal"><i class="fa-regular fa-pen-to-square"></i></button></td>
                    
                    <td class="option">
                        <form method="POST" onsubmit="return confirm('¿Estas seguro de que deseas eliminar este Sucursal?');">
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
        echo "No se encontraron Sucursales con los criterios de búsqueda ingresados.";
    }
    ?> 

</div>
<!-- FIN TABLA Sucursales -->

    <!-- INICIO MODAL AGREGAR  Sucursal-->
    <div class="modal fade" id="agregarSucursalModal" tabindex="-1" aria-labelledby="agregarSucursalModal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="agregarSucursalModal">Agregar Nuevo Sucursal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">

            <form method="POST">

            <div class="mb-3">
                <label>Nombre de la Sucursal</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Dirección de la Sucursal</label>
                <input type="text" name="direccion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Teléfono de la Sucursal</label>
                <input type="tel" name="telefono" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email de la Sucursal</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-dark" value="Crear Sucursal">
            </div>

            </form>
        </div>
</div>
</div>
</div>

<!-- FIN MODAL AGREGAR  Sucursal-->


    <!-- INICIO MODAL (VER) Sucursal -->

    <?php if (isset($sucursal)) { ?>    
<div class="modal fade show d-block" tabindex="-1" aria-labelledby="verSucursalModal" aria-hidden="true" style="background: rgba(0,0,0,0.5);">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verSucursalModal">Detalles del Sucursal</h5>
                <a href="gestionar_sucursales.php" class="btn-close" aria-label="Cerrar"></a>
            </div>

            <div class="modal-body">
              
                <p><strong>Nombre:</strong> <?php echo $sucursal['nombre']; ?></p>
                <p><strong>Dirección:</strong> <?php echo $sucursal['direccion']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $sucursal['telefono']; ?></p>
                <p><strong>Email:</strong> <?php echo $sucursal['email']; ?></p>

            </div>

            <div class="modal-footer">
                <a href="gestionar_sucursales.php" class="btn btn-secondary">Cerrar</a>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<!-- FIN MODAL VER Sucursal -->

<!-- INICIO MODAL EDITAR  Sucursal-->
<div class="modal fade" id="editarSucursalModal" tabindex="-1" aria-labelledby="editarSucursalModal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editarSucursalModal">Editar Sucursal</h5>
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
                <label for="editDireccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="editTelefono" class="form-label">Teléfono</label>
                <input type="tel" name="telefono" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="editEmail" class="form-label">Email</label>
                <input type="tel" name="Email" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-dark">Guardar Cambios</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>


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