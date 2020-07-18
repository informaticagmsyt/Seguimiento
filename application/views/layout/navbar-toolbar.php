      <body class="fixed-navbar">
        <div class="page-wrapper" id="app">
          <!-- START HEADER-->
          <header class="header">
            <div class="page-brand">
              <a class="link" href="/seguimiento">
                <img src="<?php echo  base_url() ?>/public/images/favicon.png">
                <span class="brand">SaberY
                  <span class="brand-tip">trabajo</span>
                </span>
                <span class="brand-mini">ST</span>
              </a>
            </div>
            <div class="flexbox flex-1">
              <!-- START TOP-LEFT TOOLBAR-->
              <ul class="nav navbar-toolbar">
                <li>
                  <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                </li>

              </ul>
              <!-- END TOP-LEFT TOOLBAR-->
              <!-- START TOP-RIGHT TOOLBAR-->
              <ul class="nav navbar-toolbar">


                <li class="dropdown dropdown-user">

                  <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="" />
                    <span></span> <i class="fa fa-angle-down m-l-5"></i></a>
                  <ul class="dropdown-menu ">

                    <li class="dropdown-divider"></li>
                    <a class="dropdown-item" href="<?php echo  base_url() ?>index.php/logout"><i class="fa fa-power-off"></i>Cerrar Sesión</a>


                  </ul>
                </li>



              </ul>
              <!-- END TOP-RIGHT TOOLBAR-->
            </div>
          </header>
          <!-- END HEADER-->

          <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Registrar producto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="  form-group">
                    <label> Producto </label>
                    <input class="form-control" required type="text" v-model="nuevoproducto" placeholder="nombre del Producto">

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" v-on:click="guardarProductos">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>


          <!-- Modal -->
          <div class="modal fade" id="modaltasa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Registrar Tasa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="input-group ">

                    <span class="input-group-addon bg-white  ">
                      Fecha </span>
                    <vuejs-datepicker :input-class="' date'" :value="fecha1" :language="es" v-model="registro.fecha"></vuejs-datepicker>

                  </div>

                  <div class=" form-group">
                            <label>Fuente</label>
                            <select class="form-control"  required v-model="fuentet"  >
                            <option value="BCV">BCV </option>
                            <option value="MONITOR">MONITOR </option>


                            </select> </div>
                  <div class="  form-group">
                    <label> Tasa </label>

                    <input class="form-control" required type="text" v-model="tasar" placeholder="tasa del dolar hoy" onkeypress="return valideKey(event);">

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" v-on:click="guardarTasa">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>