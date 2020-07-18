<div class="row">
    <div class="col-md-12">


        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Registrar Seguimiento</div>
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

                        <div class="col-md-4 form-group">
                            <label>Origen</label>
                            <select class="form-control"  required v-model="registro.origen"  v-on:change="changeOrigen">
                            <option value="">Elige una Opción </option>

                                <option v-for="origen in origenes" v-bind:value="origen.id" > {{ origen.descripcion }}</option>

                            </select> </div>
                            <div class="col-md-4 form-group">
                            <label>Fuente</label>
                            <select class="form-control"  required v-model="registro.fuente" v-on:change="changeFuente">
                            <option value="">Elige una Opción </option>
                                <option v-for="fuente in arrayFuentes" v-bind:value="fuente.id"  > {{ fuente.nombre }}</option>

                            </select> </div>
                        <div class=" col-md-4  form-group">
                            <label> Parroquia </label>
                            <select class="form-control" v-model="registro.parroquia" v-on:change="changeParroquia">

                                <option v-for="parroquia in parroquias" v-bind:value="parroquia.id_parroquia"> {{ parroquia.parroquia }}</option>

                            </select>
                        </div>
                   

                    </div>

                    <div class="row">
                    <div class="col-sm-4 form-group">
                            <label> Pruducto</label>
                            <select class="form-control"  required v-model="registro.producto" >

                                <option v-for="producto in productosall" v-bind:value="producto.id"> {{ producto.descripcion }}</option>

                            </select>
                         </div>
                        <div class=" col-sm-4  form-group">
                            <label> Precio </label>
                            <input class="form-control"  required type="text" v-model="registro.precio" placeholder="Precio"  onkeypress="return valideKey(event);">

                        </div>
                        <div class=" col-md-4  form-group">
                            <br>
                            <div class="input-group ">

                                <span class="input-group-addon bg-white  ">
                                    Fecha </span>
                                <vuejs-datepicker :input-class="' date'"  :value="fecha1" :language="es" v-model="registro.fecha"></vuejs-datepicker>

                            </div>
                        </div>
                     
                    </div>

               
            </div>

                <div class="row    justify-content-center">
                <div class="col"> </div>

            <div class="col">
            <div class="form-group">
                <button class="btn btn-primary" type="submit"   v-on:click="checkForm">Registrar</button>
        
            
            </div>

            </div>

                </div>
            
            </form>
        </div>
    </div>
</div>
