<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Productos</div>
    </div>
    <div class="ibox-body">
        <table class="table">
            <thead>
                <tr>
        
                <th>ID</th>
                <th>Producto</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>


            <?php
          
      
          
                                    $i=1;
                                    
                                    foreach ($data as $key => $value) {
                                        # code...
                                   ?>
                                        <tr>
                                    
                                        <td>   <?php  echo $value->id  ?></td>
                                            <td>   <?php  echo $value->descripcion  ?></td>
                                            <?php        if( $_SESSION["perfil"]=="administrador"){ ?>

                                            <td><button type="button" class="btn"  data-producto="<?php  echo $value->descripcion  ?>" data-id="<?php  echo $value->id  ?>"  v-on:click="editarProducto"><i class="ti-pencil-alt"></i></button>
                                            <?php     } ?>
                                        
                                

                                        </tr>
                                        <?php
                                     $i++;
                                    } ?>
             
            
            </tbody>
        </table>
    </div>
</div>

   <!-- Modal -->
   <div class="modal fade" id="modalProductoE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
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
                  <button type="button" class="btn btn-primary" v-on:click="guardarProductosEdicion">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>
