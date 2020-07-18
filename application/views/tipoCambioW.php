<div class="row">
    <div class="col-md-12">


        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Tipo de Cambio</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                </div>
            </div>



            <div class="ibox-body">
                <form method="GET" class="form-registrar">



                    <div class="row">
                        <div class=" col-sm-6  form-group">
                            <br>
                            <div class="input-group ">

                                <span class="input-group-addon bg-white  ">
                                    Desde </span>
                                <vuejs-datepicker :input-class="' date'" :value="desde" :language="es" v-model="desde"></vuejs-datepicker>

                            </div>
                        </div>


                        <div class=" col-sm-6  form-group">
                            <br>
                            <div class="input-group ">

                                <span class="input-group-addon bg-white  ">
                                    Hasta </span>
                                <vuejs-datepicker :input-class="' date'" :value="hasta" :language="es" v-model="hasta"></vuejs-datepicker>

                            </div>
                        </div>
                    </div>

                    <div class="row    justify-content-center">
                        <br>
                        <div class="col"> </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" v-on:click="consultarTasa">Consultar</button>


                            </div>

                        </div>

                    </div>

                    <div>
                                <canvas id="myChartasa" width="300" height="200"></canvas>

                                </div>
            </div>



            </form>
        </div>
    </div>
</div>

<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Tipo de cambio</div>
    </div>
    <div class="ibox-body">
        <table class="table">
            <thead>
                <tr>
        
                <th>ID</th>
                 <th>Tasa</th>
                <th>Fuente</th>
                <th>Fecha</th>
                <th>Aciones </th>
                </tr>
            </thead>
            <tbody>

            <tr v-for="tasa in arrayTasa" >
            <td> {{ tasa.id }}  </td>
            <td> {{ tasa.tasa }}  </td>
            <td> {{ tasa.fuente }}  </td>
            <td> {{ tasa.fecha }}  </td>
            <?php        if($_SESSION["perfil"]=="tasa" || $_SESSION["perfil"]=="administrador" || $_SESSION["perfil"]=="coord. monitor"){ ?>

            <td> <button type="button" class="btn"  :data-id="tasa.id" :data-tasa="tasa.tasa "  v-on:click="editarTipocambio"><i class="ti-pencil-alt"></i></button> 
            <button type="button" class="btn btn-danger" v-on:click="eliminartasa(tasa.id)"><i class="ti-trash"></i></button>

        
        </td>
            <?php }  ?>
            </tr>
 
        
            
            </tbody>
        </table>
    </div>
</div>

   <!-- Modal -->
   <div class="modal fade" id="modalEditarTasa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar Tasa</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="  form-group">
                    <label> Tasa </label>
                    <input class="form-control" required type="text" v-model="nuevaTasa" placeholder="Ingrese una cantidad">

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary" v-on:click="guardarTasaEdicion">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>
