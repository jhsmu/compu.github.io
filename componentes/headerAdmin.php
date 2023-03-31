        <!--Header Section Starts Here-->
        <header class="bg-nav">
        <?php
            include("./editar/conexion.php");
            $id = "SELECT * FROM administrador WHERE id_administrador= $_SESSION[id_administrador]";
            $admin = "SELECT * FROM administrador";
        ?>
            <div class="flex justify-between" style="margin-right: 20px;">
                <div class="p-1 mx-3 inline-flex items-center">
                    <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
                    <h1 class="text-white p-2">Compu Start</h1>
                </div>
                <div class="p-1 flex flex-row items-center">
                    <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block"><?php echo $_SESSION["admin"] ?></a>
                    <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="../img/logo/avatar.png" alt="">
                    <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-12 mr-1 pin-r">
                        <ul class="list-reset">
                        <?php $resultado = mysqli_query($conexion, $admin);
                                $row=mysqli_fetch_assoc($resultado);{ ?>
                          <li>
                            <a href="./micuenta.php?id_administrador=<?php echo $_SESSION["id_administrador"];?>" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Mi cuenta</a></li>
                            <?php
                                } mysqli_free_result($resultado);?>
                          <li><hr class="border-t mx-2 border-grey-ligght"></li>
                          <li><a href="../validaciones/cerrarSesion.php" class="no-underline px-4 py-2 block text-black hover:bg-grey-light">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
