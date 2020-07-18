Vue.component('documentos', {
    template: //html
        ` 
  

    <div class="row">
    <div class=" col-md-12 ml-2">

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

        
                <tr v-for="archivo in dataArchivos" >
                    <th scope="row"> {{ archivo.cod }}</th>
                    <td> {{ archivo.descripcion }}</td>
                    <td> {{ archivo.fecha }}</td>
                    <td>
                        <span target="_blank" v-on:click="showSlider(archivo)" id="iconbtn">
                            <i v-bind:class="  archivo.icon +' icon pointer' "></i> </span>

                           

                    </td>
       
                    <td>
                    
                  
                    <span target="_blank" v-on:click="eliminarArchivo( archivo.name)" id="iconbtn">
                    <i class="fa fa-trash-o  icon pointer celimimar " aria-hidden="true"></i>
                    </span>
                    </td>


                </tr>



            </tbody>
        </table>
        <h3 v-if="!resultados" class="text-secondary"> No se encontraron resultados</h3>


    </div>


</div>

    `,
    created() {

        this.ndesde = this.formatFecha(this.desde);
        this.nhasta = this.formatFecha(this.hasta);
        if (fechaDoc != '') {


            var arrayFecha = fechaDoc.split('-');
            let fecha = arrayFecha[2] + "-" + arrayFecha[1] + "-" + arrayFecha[0];
            let f = new Date(fecha)

            this.setDesde(new Date(f));
            this.setHasta(new Date(f));

            this.ndesde = fecha;
            this.nhasta = fecha;
        }

        let url = urlBase + "/search/" + this.textoBuscar + "?desde=" + this.ndesde + "&hasta=" + this.nhasta;
        this.setURLbase(url)
        this.dataUnica();

        document.querySelector("#descarga").removeAttribute("disabled");
    },
    mounted() {



    },
    data() {

        return {

            buscar: null,
            nbuscar: null,
            ndesde: new Date(),
            nhasta: new Date(),

        }

    }, 
    methods: {

        showSlider: function (archivo) {
            this.$emit('mostrar-documento', archivo)

            let url2 = urlBase + "/get/" + archivo.id+"?id="+ archivo.id;

        this.getdata(url2);





        },

        dataUnica: async function () {

            let result = await this.getDataArchivos();

            if (Subcarpeta == 'Clientes' || Subcarpeta == 'Empleados') {
                var newData = result.data.filter(element => element.principal);
                this.cargardataArchivos(newData);

            }

        },
        eliminarArchivo: function (clave) {
            let url = urlBase2 + "AlmacenamientoController/eliminar";
            console.log(url)

            try {

                swal({
                    title: "¿Estas seguro?",
                    text: "Una vez eliminado, no podrá recuperar este archivo",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    buttons: ["Cancelar", "Eliminar"],



                }).then((willDelete) => {
                    if (willDelete) {

                        let formData = new FormData();

                        formData.append("key", clave);
                        axios({
                            method: "POST",
                            url: url,
                            headers: { 'content-type': 'application/form-data' },
                            data: formData
                        }).then((response) => {
                            console.log(response)
                            if (response.data.status) {
                                swal("Archivo eliminado exitosamente!", {
                                    icon: "success",
                                    timer: 2000,
                                });
                                this.ndesde = this.formatFecha(this.desde);
                                this.nhasta = this.formatFecha(this.hasta);

                                let url2 = urlBase + "/search/" + this.textoBuscar + "?desde=" + this.ndesde + "&hasta=" + this.nhasta;

                                this.setURLbase(url2)
                                this.getDataArchivos();
                            }

                        });





                    } else {

                    }
                });


                /*    */







            } catch (error) {
                console.error(error);
            }

        },
        getdata: async function (url){
            try {
                let result = await axios({
                  method: "get",
                  url: url
                });
        

                if(result.data.length>1)
                this.cargardataArchivos(result.data);
    
        
        
        
              } catch (error) {
                console.error(error);
              }
        },
        formatFecha(fecha) {

            var d = new Date(fecha);
            let datestring = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();


            return datestring;
        },



        ...Vuex.mapMutations(['setDesde']),
        ...Vuex.mapMutations(['setHasta']),
        ...Vuex.mapMutations(['setURLbase']),
        ...Vuex.mapActions(['getDataArchivos']),
        ...Vuex.mapMutations(['cargardataArchivos']),


    },

    computed: {
        ...Vuex.mapState(['dataArchivos', 'urlBase', 'errors', 'desde', 'hasta', 'resultados', 'textoBuscar']),

    }


});
