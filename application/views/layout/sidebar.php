
                <!-- START SIDEBAR-->
                <nav class="page-sidebar" id="sidebar">
                    <div id="sidebar-collapse">
                        <div class="admin-block d-flex">
                            <div>
                                <img src="" width="45px" />
                            </div>
                            <div class="admin-info">
                                <div class="font-strong"> </div><small><?php echo strtoupper ( $_SESSION["user"])?>	</small></div>
                        </div>
                        <ul class="side-menu metismenu">
                            
             
                            <li>
                                <a class="active" href="<?php echo  base_url()?>"><i class="sidebar-item-icon fa fa-th-large"></i>
                                    <span class="nav-label">DASHBOARD</span>
                                </a>
                            </li>


                            <li class="heading">
 
</li>
                            <hr> 
                            
           
                       

                           <li>

                 
                                <a href="javascript:;"><i class="sidebar-item-icon  ti-money"></i>
                                    <span class="nav-label">Tasa Dolar</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-2-level collapse">
                                <?php if($_SESSION["perfil"]=="administrador" || $_SESSION["perfil"]=="monitor" || $_SESSION["perfil"]=="tasa" || $_SESSION["perfil"]=="coord. monitor"){ ?>                                     <li>
                                    
                      
                                        <a href="<?php echo  base_url()?>index.php/tipocambio">Consultar </a>
                                    </li>
                                    <?php } ?>
                                    <?php if($_SESSION["perfil"]=="administrador" || $_SESSION["perfil"]=="tasa" || $_SESSION["perfil"]=="coord. monitor"){ ?>                                     <li>

                                    <li>
                                        <a href="javascript:;" onclick="$('#modaltasa').modal('show')"  > Registrar</a>
                                    </li>
                                    <?php } ?> 
                                </ul>
                            </li>
                
                        
                            <li>
                                <a href="javascript:;"><i class="sidebar-item-icon ti-stats-up"></i>
                                    <span class="nav-label">Precio productos</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-2-level collapse">
                                <?php if($_SESSION["perfil"]=="administrador" || $_SESSION["perfil"]=="monitor" || $_SESSION["perfil"]=="transcriptor" || $_SESSION["perfil"]=="coord. monitor"){ ?> 
                                <li>
                      
                                        <a href="<?php echo  base_url()?>index.php/graficas">Consultar </a>
                                    </li>

                                    <?php } ?>
                                    <?php if($_SESSION["perfil"]=="administrador" || $_SESSION["perfil"]=="transcriptor" || $_SESSION["perfil"]=="coord. monitor"){ ?> 

                                    <li>
                                        <a href="<?php echo  base_url()?>index.php/registrar"> Registrar</a>
                                    </li>

                                    <?php } ?>
                                    <li>
                                        <a href="<?php echo  base_url()?>index.php/listaseguimiento" > Listado de precios</a>
                                    </li>
                                    
                                    <?php if($_SESSION["perfil"]=="administrador" || $_SESSION["perfil"]=="coord. monitor"){ ?> 

                                    <li>
                                    <a href="#" onclick="$('#modalexportar').modal('show')"> Exportar datos</a>
                                    </li>

                                    <?php } ?>
                                  
                                </ul>
                            </li>

                            <?php if($_SESSION["perfil"]=="administrador"){ ?>
                            <li>
                                <a href="javascript:;"><i class="sidebar-item-icon ti-dropbox "></i>
                                    <span class="nav-label">Productos</span><i class=" fa fa-angle-left arrow"></i></a>
                                <ul class="nav-2-level collapse">
                                    <li>
                      
                                        <a href="<?php echo  base_url()?>index.php/listaproductos">Consultar </a>
                                    </li>
                                    <?php if($_SESSION["perfil"]=="administrador"){ ?>

                                    <li>
                                        <a href="#" onclick="$('#modalProducto').modal('show')"> Registrar</a>
                                    </li>
                                    <?php } ?>
                                   
                                  
                                  
                                </ul>
                            </li>
                            <?php } ?>

                            <?php if($_SESSION["perfil"]=="administrador"){ ?>
                            <li>
                                <a href="javascript:;"><i class="sidebar-item-icon fa fa-search "></i>
                                    <span class="nav-label">Fiscalización</span><i class=" fa fa-angle-left arrow"></i></a>
                                <ul class="nav-2-level collapse">
                                    <li>
                      
                                        <a href="<?php echo  base_url()?>index.php/construccion">Consultar </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo  base_url()?>index.php/construccion"> Registrar</a>
                                    </li>

                                   
                                  
                                  
                                </ul>
                            </li>

                          
                        
                            <li>
                                <a href="javascript:;"><i class="sidebar-item-icon ti-server"></i>
                                    <span class="nav-label">Fuentes</span><i class="fa fa-angle-left arrow"></i></a>
                                <ul class="nav-2-level collapse">
                                    <li>
                      
                                        <a href="<?php echo  base_url()?>index.php/fuentes">Consultar </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo  base_url()?>index.php/fuentes/registrar"> Registrar</a>
                                    </li>
                                  
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:;"><i class="sidebar-item-icon ti-user"></i>
                                    <span class="nav-label">Usuarios</span><i class=""></i></a>
                                <ul class="nav-2-level collapse">
                                  
                                    <li>
                                        <a href="<?php echo  base_url()?>index.php/registrarUsuario"> Registrar</a>
                                    </li>
                                  
                                </ul>
                            </li>
                            <?php } ?>

                        </ul>
                    </div>
                </nav>
                <!-- END SIDEBAR-->
                <div class="content-wrapper" >
         
                                    <!-- START PAGE CONTENT-->
                                    <div class="page-content fade-in-up">