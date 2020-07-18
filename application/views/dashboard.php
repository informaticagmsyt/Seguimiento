
<div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong">Libertador</h2>
                                <div class="m-b-5"><br> </div><i class="ti-shopping-cart widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"  v-if="tasa">{{ tasa.anterior }}Bs</h2>
                                <div class="m-b-5">TASA DE AYER</div><i class="fa fa-money widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <h2 class="m-b-5 font-strong"  v-if="tasa">{{ tasa.tasa }}Bs</h2>
                                <div class="m-b-5">TASA DEL DIA</div><i class="fa fa-money widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                            </div>
                        </div>
                    </div>

            
                 
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                        <div class="ibox-head">
                                <div class="ibox-title">Precios de productos Hoy</div>
                            </div>
                            <div class="ibox-body">
                                
                                <table class="table table-striped m-t-20 visitors-table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio Bs</th>
                                            <th>Precio USD</th>
                                            <th>Variación Bs</th>
                               
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr  v-for="producto in productosP">
                                            <td>
                                              {{ producto.producto }}</td>
                                            <td>  {{ producto.promedio }}</td>

                                            <td>${{ producto.tasa }}</td>
                                            <td>
                                            <span class=" text-danger  ml-2" v-if="producto.subio"><i class="fa fa-level-up"></i> +{{ producto.variacion }}%</span>
                                            <span class="text-success  ml-2" v-else><i class="fa fa-level-down"></i> -{{ producto.variacion }}%</span>
                                        
                                        </td>
                                        </tr>
                                    
                                      
                                      
                                     
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>

    
                    </div>
               
                </div>