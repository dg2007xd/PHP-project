   <!-- INICIO DB.PHP -->
   <?php
    require 'db.php';
    session_start();

    //Código que valida si existe una sesión abierta
    if(!isset ($_SESSION['user'])){
    header("Location: login.php");
    exit();
    }

    //Procesar eliminacion del empleado
    if(isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];
    
        $stmt = $conn->prepare("DELETE FROM empleados WHERE id = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            echo "<script>alert('Empleado eliminado con exito');</script>";
            header("Location: gestionar_empleados.php"); //Redirige despues de la eliminacion
            exit();
        } else {
            echo "<script>alert('Error al eliminar el empleado');</script>";
        }
        }
        
    
        //Agregar logica para obtener informacion de un empleado especifico  (VER)
        if (isset($_GET['view_id'])) {
            $id = $_GET['view_id'];
            $stmt = $conn->prepare("SELECT * FROM empleados WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $empleado = $stmt->get_result()->fetch_assoc();
        }
    
    
        //Logica para editar empleado
        if (isset($_POST['update_empleado'])) {
            $id = $_POST['id'];
            $nombre = $POST['nombre'];
            $puesto = $_POST['puesto'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
    
            $stmt = $conn->prepare("UPDATE empleados SET nombre = ?, puesto = ?, email = ?, telefono = ?");
            $stmt->bind_param("ssssi", $nombre, $puesto, $email, $telefono, $id);
    
            if ($stmt->execute()) {
                echo "<script>alert('Empleado actualizado con exito');</script>";
                echo "<script>location.href='gestionar_empleados.php';</script>";
            } else {
                echo "<script>alert('Error al actualizar el empleado');</script>";
            }
        }
    
    
    
    
    
        //Procesar crear empleado desde el formulario
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nombre = $_POST['nombre'];
            $puesto = $_POST['puesto'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
        
    
            //Insertar el nuevo empleado en la base de datos
            $stmt = $conn -> prepare("INSERT INTO empleados(nombre, puesto, email, telefono) VALUES (?,?,?,?)");
            $stmt ->bind_param("sssi", $nombre, $puesto, $email, $telefono);
    
            if ($stmt -> execute()) {
                echo "<script>alert('Empleado agregado con éxito')</script>";
            } else {
                echo "<script>alert('Error al agregar el empleado')</script>";
            }
        }
    
    

    //Variable para la busqueda
    $search = isset($_GET['search']) ? $_GET['search']: '';

    //Consulta SQL para obtener los empleados mediante el form de busqueda
    $sql = "SELECT id, nombre, puesto, telefono FROM empleados WHERE nombre LIKE '%$search%' OR puesto LIKE '%$search%'";
    $result = $conn->query($sql);
    ?>

   <!-- FIN DB.PHP -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- INICIO HEADER -->
    <?php
    include 'admin_header.php';
    ?>
    <!-- FIN NAVBAR -->

    <div class="container d-flex">

        <div class="container mt-3">
            <h2>Tabla de Empleados</h2>
        </div>

        <!-- INICIO BOTONES -->
        <div class="container d-flex justify-content-end mt-4">
        <button class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#agregarEmpleadoModal"> <i class="fa-solid fa-user-plus"></i> Agregar Empleados</button>
        <button class="btn btn-outline-dark"> <i class="fa-regular fa-file-pdf"></i> Descargar Empleados</button>
        </div>
        <!-- FIN BOTONES -->

    </div>
    
    <!-- Inicio Buscador Empleados -->
    <div class="container mt-4">
        <form class="d-flex">
            <input class="form-control me-2" type="search" name="search" method="GET"
            placeholder="Ingresa el nombre o puesto del empleado que buscas"
            value="<?php echo $search ?>">
            <input class="btn btn-outline-dark" type="submit" value="Buscar">
        </form>
    </div>
    <!-- Fin Buscador -->

    

    <!-- INICIO TABLA EMPLEADOS -->
    <div class="container mt-3">
    

    <?php if ($result -> num_rows > 0 ) {  ?>

        <table class="table table-striped">
            
            <thead>
                <tr>
                    <th>Nombre del Empleado</th>
                    <th>Puesto del Empleado</th>
                    <th>Teléfono del Empleado</th>
                    <th colspan="3" style="text-align:center;">Acciones </th>
                </tr>
            </thead>

            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td> <?php echo $row["nombre"]?></td>
                    <td> <?php echo $row["puesto"]?></td>
                    <td> <?php echo $row["telefono"]?></td>

                    <td class="option">
                        <form method="GET">
                            <input type="hidden" name="view_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver">
                            <i class="fa-regular fa-eye"></i> </button>
                        </form>
                    </td>
                    
                    <td class="option"><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarEmpleadoModal"><i class="fa-regular fa-pen-to-square"></i></button></td>
                    
                    <td class="option">
                        <form method="POST" onsubmit="return confirm('¿Estas seguro de que deseas eliminar este empleado?');">
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
        echo "No se encontraron empleados con los criterios de búsqueda ingresados.";
    }
    ?>

</div>
<!-- FIN TABLA EMPLEADOS -->

    <!-- INICIO MODAL AGREGAR  EMPLEADO-->
    <div class="modal fade" id="agregarEmpleadoModal" tabindex="-1" aria-labelledby="agregarEmpleadoModal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="agregarEmpleadoModal">Agregar Nuevo Empleado</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">

            <form method="POST">

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Puesto</label>
                <input type="text" name="puesto" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Correo electrónico</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Teléfono</label>
                <input type="tel" name="telefono" class="form-control" required>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-dark" value="Crear empleado">
            </div>

            </form>
        </div>
</div>
</div>
</div>

<!-- FIN MODAL AGREGAR  EMPLEADO-->


    <!-- INICIO MODAL (VER) EMPLEADO -->

    <?php if (isset($empleado)) { ?>    
<div class="modal fade show d-block" tabindex="-1" aria-labelledby="verEmpleadoModal" aria-hidden="true" style="background: rgba(0,0,0,0.5);">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verEmpleadoModal">Detalles del Empleado</h5>
                <a href="gestionar_empleados.php" class="btn-close" aria-label="Cerrar"></a>
            </div>

            <div class="modal-body">
              
                <p><strong>Nombre:</strong> <?php echo $empleado['nombre']; ?></p>
                <p><strong>Puesto:</strong> <?php echo $empleado['puesto']; ?></p>
                <p><strong>Email:</strong> <?php echo $empleado['email']; ?></p>
                <p><strong>Telefono:</strong> <?php echo $empleado['telefono']; ?></p>

            </div>

            <div class="modal-footer">
                <a href="gestionar_empleados.php" class="btn btn-secondary">Cerrar</a>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<!-- FIN MODAL VER EMPLEADO -->

<!-- INICIO MODAL EDITAR  EMPLEADO-->
<div class="modal fade" id="editarEmpleadoModal" tabindex="-1" aria-labelledby="editarEmpleadoModal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editarEmpleadoModal">Editar Empleado</h5>
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
                <label for="editPuesto" class="form-label">Puesto</label>
                <input type="text" name="puesto" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="editEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="editTelefono" class="form-label">Telefono</label>
                <input type="tel" name="telefono" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-dark">Guardar Cambios</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>

<!-- FIN MODAL EDITAR  EMPLEADO-->


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