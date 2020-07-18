<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Filtros</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(41px, 20px, 0px); top: 0px; left: 0px; will-change: transform;">

                    </div>
                </div>
            </div>
            <div class="ibox-body">
                <div class="row">

                    <div class="col-md-3 form-group">
                        <label> Pruducto</label>
                        <select class="form-control" required v-model="id_producto">

                            <option v-for="producto in productosall" v-bind:value="producto.id"> {{ producto.descripcion }}</option>

                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>Origen</label>
                        <select class="form-control" required v-model="registro.origen" v-on:change="changeOrigen">
                            <option value="">Elige una Opción </option>

                            <option v-for="origen in origenes" v-bind:value="origen.id"> {{ origen.descripcion }}</option>

                        </select> </div>

                    <div class="col-md-2 form-group">

                        <label> Fuente</label>
                        <select class="form-control" required v-model="registro.fuente" v-on:change="changeFuente">
                            <option value="">Elige una Opción </option>
                            <option v-for="fuente in arrayFuentes" v-bind:value="fuente.id"> {{ fuente.nombre }}</option>

                        </select>
                    </div>

                    <div class="col-md-2">

                        <div class="form-group">
                            <label>Parroquia</label>
                            <select class="form-control" v-model="id_parroquia" v-on:change="changeParroquia">
                                <option selected value="todos">Todos</option>
                                <option selected value="promediado">Promediado</option>

                                <option v-for="parroquia in parroquias" v-bind:value="parroquia.id_parroquia"> {{ parroquia.parroquia }}</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Periodo</label>
                            <select class="form-control" v-model="fechaf" v-on:change="changePeriodo">
                            <option selected value="">Seleccione</option>
                            <option selected value="7">Ultimos 7 dias</option>
                                <option value="15">Ultimos 15 dias</option>
                                <option value="30">Ultimos 30 dias</option>

                                <option value="rango">Rango personalizado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col--md-1">

                        <button class="btn btn-info btn-lg mt-4" v-on:click="consultarProductos"> Consultar</button>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div v-bind:class="'col-lg-'+columna " v-for="producto in productos">
        <div class="ibox">
            <div class="ibox-body">
                <div class="flexbox mb-4">
                    <div>
                        <h3 class="m-0"> </h3>
                    </div>
                    <div class="d-inline-flex">

                        <div class="px-3">
                            <div class="text-muted">Precio Promedio</div>
                            <div>
                                <span class="h3 m-0">{{ producto.promedio }}</span>
                                <span class="text-warning ml-2"><i class="fa fa-level-down"></i> 0%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <canvas v-bind:id="'myChart'+ producto.id" width="300" height="300"></canvas>

                </div>
            </div>
        </div>
    </div>



</div>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">

            <div class="ibox-body">

                <table class="table table-striped m-t-20 visitors-table">
                    <thead>
                        <tr>
                            <th>Parroquia</th>
                            <th>Precio Bs</th>
                            <th>Precio USD</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="producto in productos">
                            <td>
                                {{ producto.producto }}</td>
                            <td> {{ producto.precio }}</td>

                            <td>${{ producto.usd }}</td>

                        </tr>





                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalperiodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione un Rango</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">

                        <div class="input-group ">

                            <span class="input-group-addon bg-white  ">
                                Desde </span>
                            <vuejs-datepicker :input-class="' date'" :value="fecha1" :language="es" v-model="desde"></vuejs-datepicker>

                        </div>
                    </div>


                    <div class="col">

                        <div class="input-group ">

                            <span class="input-group-addon bg-white  ">
                                Hasta </span>
                            <vuejs-datepicker :input-class="' date'" :value="fecha1" :language="es" v-model="hasta"></vuejs-datepicker>

                        </div>

                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" v-on:click="consultarProductos">Consultar</button>
            </div>
        </div>
    </div>
</div>