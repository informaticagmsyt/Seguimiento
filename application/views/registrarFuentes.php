<div class="row">
    <div class="col-md-12">


        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Registrar Fuentes</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>

                </div>
            </div>
  <p v-if="errors.length">
    <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>


            <div class="ibox-body">
                <form method="POST" class="form-registrar"  >
                    <div class="row">

                        <div class="col-sm-4 form-group">
                            <label>Origen</label>
                            <select class="form-control"  required v-model="registro.origen">

                                <option v-for="origen in origenes" v-bind:value="origen.id" > {{ origen.descripcion }}</option>

                            </select> </div>

                            <div class="col-sm-4 form-group">
                            <label>Nombre Fuente</label>
                            <input class="form-control"  required type="text" v-model="registro.nombre" placeholder="Nombre">
                        </div>
                        <div class=" col-sm-4  form-group">
                            <label> Parroquia </label>
                            <select class="form-control" v-model="registro.parroquia" v-on:change="changeParroquia">

                                <option v-for="parroquia in parroquiasF" v-bind:value="parroquia.id_parroquia"> {{ parroquia.parroquia }}</option>

                            </select>
                        </div>
                       


                    </div>

      
            </div>

                <div class="row    justify-content-center">
                <div class="col"> </div>

            <div class="col">
            <div class="form-group">
                <button class="btn btn-primary" type="submit"   v-on:click="checkFormFuente">Registrar</button>
        
            
            </div>

            </div>

                </div>
            
            </form>
        </div>

        <div class="ibox">
                            <div class="ibox-head">
                            
                            </div>
                            <div class="ibox-body">
                                <table class="table">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>#</th>
                                            <th>Origen</th>
                                            <th>Fuente</th>
                                            <th>Parroquia</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                    $i=1;
                                    
                                    foreach ($data as $key => $value) {
                                        # code...
                                   ?>
                                        <tr>
                                            <td>  <?php  echo $i  ?></td>
                                            <td>   <?php  echo $value->origen  ?></td>
                                            <td> <?php  echo $value->fuente  ?></td>
                                            <td><?php  echo $value->parroquia  ?></td>
                                        </tr>
                                        <?php
                                     $i++;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
    </div>
</div>
