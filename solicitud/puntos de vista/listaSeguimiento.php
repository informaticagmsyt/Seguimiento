
<div class="ibox">
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
                                <button class="btn btn-primary" type="submit" v-on:click="consultarListaSeguimiento">Consultar</button>


                            </div>

                        </div>

                    </div>

                    <div>

                                </div>
            </div>

            </div>

<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Productos - Precio</div>
    </div>
    <div class="ibox-body">
        <table class="table">
            <thead>
                <tr>
        
                <th>#</th>
                    <th>Producto</th>
                    <th>Origen</th>
                    <th>Fuente</th>
                    <th>Parroquia</th>
                    <th>fecha</th>
                    <th>Precio</th>
                    <th>Usuario</th>
                    <th>acciones</th>
                </tr>
            </thead>
            <tbody>


            <?php 
          
                                    $i=1;
                                    
                                    foreach ($data as $key => $value) {
                                        # code...
                                   ?>
                                        <tr>
                                    
                                        <td>   <?php  echo $i  ?></td>
                                            <td>   <?php  echo $value->producto  ?></td>
                                            <td> <?php  echo $value->origen  ?></td>

                                            <td> <?php  echo $value->fuente  ?></td>
                                            <td><?php  echo $value->parroquia  ?></td>
                                            <td><?php  echo $value->fecha  ?></td>
                                            <td><?php  echo number_format($value->precio , 2, ",", ".") ?></td>
                                            <td><?php  echo $value->usuario  ?></td>
                                            <td><button type="button" class="btn" v-on:click="editarSeguimiento(<?php  echo $value->id  ?>)">Editar</button>
                                                                                     
                                            <button type="button" class="btn btn-danger" v-on:click="eliminarSeguimiento(<?php  echo $value->id  ?>)"><i class="ti-trash"></i></button>
                                                           
                                                           
                                        
                                        
                                        </td>

                                        </tr>
                                        <?php
                                     $i++;
                                    } ?>
             
            
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
          
            <div class="ibox-body">
                <form method="POST" class="form-registrar"  >
                    <div class="row">

                        <div class="col-md-4 form-group">
                            <label>Origen</label>
                            <select class="form-control"  required v-model="registro.origen"  v-on:change="changeOrigen" disabled>
                         

                                <option v-for="origen in origenes" v-bind:value="origen.id" > {{ origen.descripcion }}</option>

                            </select> </div>
                            <div class="col-md-4 form-group">
                            <label>Fuente</label>
                            <select class="form-control"  required v-model="registro.fuente" v-on:change="changeFuente" disabled>
                            <option v-bind:value="dataEditProductos.id_fuente"> {{ dataEditProductos.fuente }}</option>

                                <option v-for="fuente in arrayFuentes" v-bind:value="fuente.id"  > {{ fuente.nombre }}</option>

                            </select> </div>
                        <div class=" col-md-4  form-group">
                            <label> Parroquia </label>
                            <select class="form-control" v-model="registro.parroquia" disabled>
                            <option v-bind:value="dataEditProductos.id_parroquia"> {{ dataEditProductos.parroquia }}</option>

                                <option v-for="parroquia in parroquias" v-bind:value="parroquia.id_parroquia"> {{ parroquia.parroquia }}</option>

                            </select>
                        </div>
                   

                    </div>

                    <div class="row">
                    <div class="col-sm-4 form-group">
                            <label> Pruducto</label>
                            <select class="form-control"  required v-model="registro.producto" disabled >
                            <option v-bind:value="dataEditProductos.producto_id"> {{ dataEditProductos.producto }}</option>


                            </select>
                         </div>
                        <div class=" col-sm-4  form-group">
                            <label> Precio </label>
                            <input class="form-control"  required type="text" v-model="registro.precio" placeholder="Precio"  onkeypress="return valideKey(event);">

                        </div>
                     
                     
                    </div>

               
            </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" v-on:click="guardarEdicion">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
