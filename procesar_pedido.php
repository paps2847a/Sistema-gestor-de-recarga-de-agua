<?php
    session_start();
    require('.\database\conexion.class.php');
    require('.\modulos\pagos.class.php');
    require('.\modulos\pedidos.class.php');
    
    $idCliente = $_GET['id'];
    $pagos = new pagos_class();
    $pedidos = new pedidos_class();

    if ($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        if (isset($_POST['fechaPago'])) 
        {
            $idPago = $pagos->registrar_pago($idCliente, $_POST['metodoPago'], $_POST['montoPrecio'], $_POST['fechaPago']);
            $pedidos->registrar_pedido($idCliente, $idPago, $_POST['fechaPedido'], $_POST['montoBotellones'], "En Espera");
        }
        else 
        {
            $pedidos->registrar_pedido($idCliente, null, $_POST['fechaPedido'], $_POST['montoBotellones'], "En Espera");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registro de pedidos</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registro de Pagos y pedidos</h6>
                        </div>
                        <div class="card-body">
                            <form id="paymentForm" method="post">
                                <div id="paymentFields">
                                    <h3>Registro de pago</h3>
                                    <div class="form-group">
                                        <label for="paymentMethod">Método de pago</label>
                                        <select class="form-control" id="paymentMethod" required name="metodoPago">
                                            <option value="Dolares">Dolares</option>
                                            <option value="Bolivares (efectivo)">Bolivares (efectivo)</option>
                                            <option value="Punto">Punto</option>
                                            <option value="Pago Movil.">Pago Movil</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Fecha</label>
                                        <input type="date" class="form-control" id="date" name="fechaPago" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Monto</label>
                                        <input type="number" class="form-control" id="amount" readonly name="montoPrecio" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="bottleCount">Número de botellones</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-outline-secondary" onclick="decrementBottleCount()">-</button>
                                            </div>
                                            <input type="text" class="form-control" id="bottleCount" value="0" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary" onclick="incrementBottleCount()">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-primary" id="pagoNormal">Registrar pago</button>
                                        </div>
                                        <div class="col-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="creditCheck">
                                                <label class="form-check-label" for="creditCheck">
                                                    Dejar a credito
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Campos del formulario escondido -->
                                <div id="hiddenFields" style="display: none;">
                                    <h3>Registro de pedido</h3>
                                    <div class="form-group">
                                        <label for="date">Fecha</label>
                                        <input type="date" class="form-control" id="date2" name="fechaPedido" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="numBotello">Numero de Botellones</label>
                                        <input type="number" class="form-control" id="numBotello" name="montoBotellones" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" >Registrar informacion</button>
                                </div>

                            </form>
                            <br>
                            <button class="btn btn-secondary" onclick="history.back()">Volver</button>
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
                    <a class="btn btn-primary" href="index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Aviso</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">No hay monto que facturar, corrija el error.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
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

    <script>
        var bottlePrice = <?php echo $_SESSION['precioBotellon']; ?>; // Obtiene el precio del botellón de la sesión de PHP

        function incrementBottleCount() {
            var bottleCount = parseInt(document.getElementById('bottleCount').value);
            bottleCount++;
            document.getElementById('bottleCount').value = bottleCount;
            document.getElementById('amount').value = bottleCount * bottlePrice;
        }

        function decrementBottleCount() {
            var bottleCount = parseInt(document.getElementById('bottleCount').value);
            if (bottleCount > 0) {
                bottleCount--;
                document.getElementById('bottleCount').value = bottleCount;
                document.getElementById('amount').value = bottleCount * bottlePrice;
            }
        }

        $(document).ready(function() {
            $('#creditCheck').change(function() {
                if(this.checked) 
                {
                    // Si se seleccionó "Recargar a crédito al cliente", deshabilita todos los campos de entrada excepto los especificados
                    $('#paymentForm input:not(#date2, #numBotello), #paymentForm select').prop('disabled', true);
                    // Muestra los campos escondidos y oculta los campos de pago
                    $('#paymentFields').hide();
                    $('#hiddenFields').show();
                    // Aquí puedes agregar el código para hacer la transición a la nueva tarjeta y enviar los datos al servidor
                } 
                else 
                {
                    // Si no se seleccionó "Recargar a crédito al cliente", habilita todos los campos de entrada
                    $('#paymentForm input, #paymentForm select').prop('disabled', false);
                    $('#paymentFields').show();
                    $('#hiddenFields').hide();
                }
            });

            $('#pagoNormal').click(function(e) {
                e.preventDefault(); // Evita que el botón envíe el formulario
                var amount = $('#amount').val();
                if(amount == '' || amount == 0) {
                    // Si el campo de monto está vacío o es 0, muestra un modal
                    $('#myModal').modal('show');
                } else {
                    // Si el campo de monto no está vacío, muestra los campos escondidos y oculta los campos de pago
                    $('#paymentFields').hide();
                    $('#hiddenFields').show();
                    $('#numBotello').val($('#bottleCount').val());
                    // Aquí puedes agregar el código para hacer la transición a la nueva tarjeta y enviar los datos al servidor
                }
            });


        });

    </script>

    <script>
        $(document).ready(function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            $('#date').val(today);
            $('#date2').val(today);
        });
    </script>

</body>

</html>