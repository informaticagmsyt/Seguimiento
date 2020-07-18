<div class="ibox">
    <p v-if="errors.length">
        <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
        <ul>
            <li v-for="error in errors">{{ error }}</li>
        </ul>
    </p>


    <div class="ibox-body">
        <form method="POST" class="form-registrar">
            <div class="row">

                <div class="col-sm-4 form-group">
                    <label>Usuario</label>
                    <input class="form-control" required type="text" v-model="usuario" placeholder="Usuario">
                </div>

                <div class="col-sm-4 form-group">
                    <label>Clave</label>
                    <input class="form-control" required type="text" v-model="clave" placeholder="clave">
                </div>
                <div class="col-sm-4 form-group">
                    <label>Perfil</label>

                    <select class="form-control" v-model="perfil">

                        <option value="administrador"> Administrador</option>
                        <option value="transcriptor"> Transcriptor</option>
                        <option value="monitor"> Monitor</option>
                        <option value="tasa"> Regitrador Tasa</option>
                        <option value="coord. monitor"> Coordinador Monitor</option>
                    </select>

                </div>




            </div>


    </div>
    <div class="row    justify-content-center">
        <div class="col"> </div>

        <div class="col">
            <div class="form-group">
                <button class="btn btn-primary" type="submit" v-on:click="checkFormUsuario">Registrar</button>


            </div>

        </div>

    </div>
</div>

<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Usuarios</div>
    </div>
    <div class="ibox-body">
        <table class="table">
            <thead>
                <tr>

                    <th>#</th>

                    <th>Usuario</th>
                    <th>Clave</th>
                    <th>perfil</th>
                    <th>editar</th>
                </tr>
            </thead>
            <tbody>


                <?php

                $i = 1;

                foreach ($usuarios as $key => $value) {
                    # code...
                ?>
                    <tr>

                        <td> <?php echo $i  ?></td>
                        <td> <?php echo $value->usuario  ?></td>
                        <td> <?php echo $value->clave   ?></td>
                        <td> <?php echo $value->perfil  ?></td>
                        <td>
                            <button type="button" class="btn" v-on:click="editarUsuario(<?php echo $value->id  ?>)"><i class="ti-pencil-alt"></i></button>
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
                    <form method="POST" class="form-registrar">
                        <div class="row">
                        <p v-if="errors.length">
                            <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </p>


                            <div class="col-md-12 form-group">
                                <label>Perfil</label>


                                <select class="form-control" v-model="perfil">

                                    <option value="administrador"> Administrador</option>
                                    <option value="transcriptor"> Transcriptor</option>
                                    <option value="monitor"> Monitor</option>
                                    <option value="tasa"> Regitrador Tasa</option>
                                    <option value="coord. monitor"> Coordinador Monitor</option>
                                </select>

                            </div>

                            <div class="col-md-12 form-group">
                                <label>Nueva Clave</label>


                                <input class="form-control" required type="text" v-model="nuevaClave">
                            </div>



                        </div>



                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" v-on:click="checkEdicionUsuario">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>