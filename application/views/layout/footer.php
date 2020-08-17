

                    <!-- END PAGE CONTENT-->

                    <footer class="page-footer">
                        <div class="font-13">2020 © <b>GMSYT</b> - All rights reserved.</div>
                        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
                    </footer>
                </div>
            </div>
            </div>
            <!-- BEGIN PAGA BACKDROPS-->
            <div class="sidenav-backdrop backdrop"></div>
            <div class="preloader-backdrop">
                <div class="page-preloader">Cargando..</div>
            </div>
            <!-- END PAGA BACKDROPS-->
            <!-- CORE PLUGINS-->

            <script src="<?php echo  base_url()?>public/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/js/sweetalert.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/DataTables/datatables.min.js" type="text/javascript"></script>

        

            <!-- PAGE LEVEL PLUGINS-->
             <!-- CORE SCRIPTS-->
          
          
            <script  type="text/javascript">
           
            $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

            var fdesde='<?php if(isset($_GET['desde'] ))  echo $_GET['desde']  ?>';
            // url base para las consultas
            var urlBase ="<?php echo  base_url()?>"
           
            </script>
     <!-- VUE JS-->
            <script src="<?php echo  base_url()?>public/js/vue.js"></script>
            <script src="<?php echo  base_url()?>public/js/vue-router.js"></script>

            <script src="<?php echo  base_url()?>public/js/axios.min.js"></script>
            <script src="<?php echo  base_url()?>public/js/vuejs-datepicker.min.js"></script>
            <script src="<?php echo  base_url()?>public/js/vuex.min.js"></script>


            <script src="<?php echo  base_url()?>public/js/app.js" type="text/javascript"></script>
            
                <!-- Componentes VUE JS-->

            <script src="<?php echo  base_url()?>public/js/main.js" type="text/javascript"></script>


       
        </body>
        
        </html>