<?php

    require(".\database\conexion.class.php");
    require(".\modulos\clientes.class.php");
    require(".\modulos\urbanizacion.class.php");
    require(".\modulos\ubicaciones.class.php");
    session_start();

    $urbanizacion = new Urbanizacion();
    $clientes = new Clientes();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $clientes->insertarCliente($_POST['habitacion'],$_POST['ubicacion'],$_POST['telefono']);
    }

    $datos = $clientes->clientesMuestra();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestion de Clientes</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Ges <sup>TOR</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Gestion</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Elementos:</h6>
                        <a class="collapse-item" href="clientes.php">Clientes</a>
                        <a class="collapse-item" href="ubicaciones.php">Ubicaciones</a>
                        <a class="collapse-item" href="urbanizacion.php">Urbanizaciones</a>
                        <a class="collapse-item" href="tablaPedidos.php">Tabla de pedidos</a>
                    </div>
                </div>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['usuario']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tabla de Clientes</h1>
                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#formulario">
                                    Agregar Cliente
                                </button>

                                <div class="select-container">
                                    <select class="form-control" id="urbanizaciones">
                                        <?php
                                            $urbanizacion->urbanizacionOpciones();
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php

                                    if (isset($_GET['mensaje'])) 
                                    {
                                        echo $_GET['mensaje'];
                                    }

                                ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Habitacion</th>
                                            <th>Ubicacion</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Habitacion</th>
                                            <th>Ubicacion</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; gesTOR</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="home.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Modal -->
    <div class="modal fade" id="formulario" tabindex="-1" role="dialog" aria-labelledby="formularioModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formularioModalLabel">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <label for="ubi" class="form-label">Habitacion</label>
                    <input type="text" id="ubi" name="habitacion" class="form-control" required>
                    <br>

                    <div class="form-group">
                        <label for="select1">Urbanizacion</label>
                        <select class="form-control" name="" id="select1" required>
                            <?php

                                $urbanizacion->urbanizacionOpciones();

                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Select2">Ubicaciones</label>
                        <select class="form-control" name="ubicacion" required id="select2">
                        </select>
                    </div>

                    <label for="ubi" class="form-label">Numero de telefono</label>
                    <input type="text" id="ubi" name="telefono" class="form-control" required>

                    <br>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
    
    
    <script>
        // Call the dataTables jQuery plugin
        var data = <?php echo $datos; ?>

        $(document).ready(function() {
            $('#urbanizaciones').append('<option value="" selected>Seleccione una urbanizacion</option>');

            var table = $('#dataTable').DataTable();

            $.each(data, function(i,item){
                var habitacion = '<span data-ubicacion="'+item.ubicacion+'">' + item.habitacion + '</span>';
                var opciones = item.opcion + ' ' + item.opcion2; // Concatena item.opcion e item.opcion2

                table.row.add([habitacion, item.ubicacionName, opciones]);
                table.draw();
            })

            // Cuando se selecciona una opción en tu select...
            $('#urbanizaciones').change(function() {
                // Obtiene la id de la urbanización seleccionada
                var urbanizacionId = $(this).val();

                if(urbanizacionId == '') {
                    // Si se seleccionó "Seleccione una urbanización", muestra todos los registros
                    table.rows().every(function() {
                        var row = this.node();
                        $(row).show();
                    });
                } else {
                    $.ajax({
                        url: './solicitudesAJAX/soliUbicacionesGeneral.php', // Cambia esto por la ruta a tu servidor que devuelve los datos JSON
                        type: 'GET',
                        data: { id: urbanizacionId },
                        dataType: 'json',
                        success: function(data) 
                        {
                            // Filtra los registros de tu DataTable
                            table.rows().every(function() {
                                var row = this.node();
                                var ubicacionId = $('td:first span', row).data('ubicacion');

                                // Verifica si la id de la ubicación coincide con alguna id en los datos JSON
                                var coincide = data.some(function(dato) {
                                    return dato.id == ubicacionId;
                                });

                                if(coincide) {
                                    // Si coincide, muestra el registro
                                    $(row).show();
                                } else {
                                    // Si no coincide, oculta el registro
                                    $(row).hide();
                                }
                            });
                        }
                    });
                }
            });
        });

    </script>

    <script>
        $(document).ready(function() {
        
        // Cuando se abre el modal...
        $('#formulario').on('show.bs.modal', function() {
            // Deshabilita el segundo select, borra su valor y sus opciones
            $('#select2').prop('disabled', true).empty().append('<option value="">Seleccione una urbanizacion</option>');

            // Borra el valor del primer select
            $('#select1').val('');
        });

        // Cuando el primer select cambie...
        $('#select1').change(function() {
            var urbanizacionId = $(this).val();

            if(urbanizacionId != '') {
                // Realiza una solicitud AJAX para obtener las ubicaciones de la urbanización seleccionada
                $.ajax({
                    url: './solicitudesAJAX/soliUbicaciones.php', // Cambia esto por la ruta a tu servidor que devuelve los datos JSON
                    type: 'GET',
                    data: { id: urbanizacionId },
                    dataType: 'json',
                    success: function(data) {
                        // Borra las opciones actuales del segundo select
                        $('#select2').empty().append('<option value="">Seleccione una opción</option>');

                        // Añade cada ubicación obtenida a las opciones del segundo select
                        $.each(data, function(key, ubicacion) {
                            $('#select2').append('<option value="' + ubicacion.id + '">' + ubicacion.ubicacion + '</option>');
                        });

                        // Habilita el segundo select
                        $('#select2').prop('disabled', false);

                    }
                });
            } else {
                // Si el usuario vuelve a la opción predeterminada, deshabilita el segundo select, borra su valor y sus opciones
                $('#select2').prop('disabled', true).empty().append('<option value="">Seleccione una opción</option>');
            }
        });
    });

    </script>

</body>

</html>