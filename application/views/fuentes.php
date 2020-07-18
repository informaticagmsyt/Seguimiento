<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title">Fuentes</div>
    </div>
    <div class="ibox-body">
        <table class="table">
            <thead>
                <tr>
        
                <th>ID</th>
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
                                    
                                        <td>   <?php  echo $value->id  ?></td>
                                            <td>   <?php  echo $value->origen  ?></td>
                                            <td> <?php  echo $value->fuente  ?></td>

                                            <td> <?php  echo $value->parroquia  ?></td>

                                      
                                        
                                

                                        </tr>
                                        <?php
                                     $i++;
                                    } ?>
             
            
            </tbody>
        </table>
    </div>
</div>
