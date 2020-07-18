


var Language=function(e,t,o,s){this.language=e,this.months=t,this.monthsAbbr=o,this.days=s,this.rtl=!1,this.ymd=!1,this.yearSuffix=""},prototypeAccessors={language:{configurable:!0},months:{configurable:!0},monthsAbbr:{configurable:!0},days:{configurable:!0}};prototypeAccessors.language.get=function(){return this._language},prototypeAccessors.language.set=function(e){if("string"!=typeof e)throw new TypeError("Language must be a string");this._language=e},prototypeAccessors.months.get=function(){return this._months},prototypeAccessors.months.set=function(e){if(12!==e.length)throw new RangeError("There must be 12 months for "+this.language+" language");this._months=e},prototypeAccessors.monthsAbbr.get=function(){return this._monthsAbbr},prototypeAccessors.monthsAbbr.set=function(e){if(12!==e.length)throw new RangeError("There must be 12 abbreviated months for "+this.language+" language");this._monthsAbbr=e},prototypeAccessors.days.get=function(){return this._days},prototypeAccessors.days.set=function(e){if(7!==e.length)throw new RangeError("There must be 7 days for "+this.language+" language");this._days=e},Object.defineProperties(Language.prototype,prototypeAccessors);
var es=new Language("Spanish",["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],["Dom","Lun","Mar","Mié","Jue","Vie","Sáb"]);

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};




	var COLORS = [
		'#4dc9f6',
		'#f67019',
		'#f53794',
		'#537bc4',
	
		'#166a8f',
		'#00a950',
		'#58595b',
		'#8549ba'
	];

  function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
  }

	
       
var app = new Vue({ 
  el: "#app",
  components: {
  	vuejsDatepicker
  },
  
  data: function() {
    return {

     
      es:es,
      id:0,
      urlImagen: "",
      productos:[],
      dataEditProductos:"",
      listproductos:[],
      parroquias:[],
      productosall:[],
      arrayTasa:[],
      columna:4,
      circuitos:[],
      origenes:[],
      tasa:null,
      tasaActual:"",
      fecha1:  new Date(),
      fechaf:7,
      moneda:"bs",
      eje:"",
      tasar:"",
      id_segimiento:"",
      fuentet:"BCV",
      width:400,
      height:400,
      productosP:[],
      errors: [],
      fechae:"",
     parroquiasF:[],
      arrayFuentes:[],
      nuevaClave:"",
      nuevaTasa:"",

      registro:{
        parroquia:null,
        circuito:null,
        precio:null,
        tasa:null,
        fecha:null,
        semana:null,
        origen:null,
        fuente:null,
        nombre:null,
        eje:null,
        producto:null,
        tasar:"",

       
      },
      usuario:"",
      perfil:null,
      clave:"",
      origen:"1",

      desde:"",
      hasta:new Date(),
      nuevoproducto:null,
      id_parroquia:"",
      id_producto:1
     
    };
  },
  mounted(){
   
    if(fdesde && fdesde !=""){
     var year= fdesde.split("-");
     var mes =year[1]-1;
      this.desde= new Date(year[0], mes, year[2])
      console.log( year)
    }else{
      this.desde=  new Date()
    }

    this.id_parroquia="todos";
    this.eje="todos";
    this.registro.origen="";
    this.registro.producto=1;
    this.registro.fuente=1;
    this.registro.fecha=new Date();
    this.getGraficas(7,"todos",1, this.id_producto)
    var x= new Date()

     this.getParroquiasF()


    this.getRangoTasa();
    //this.getParroquias();


    this.getOrigen();
    this.productosPromedio();
    this.getProductosALL();
    this.getFuentes(1);
    
  },
  computed:{
  

 
    


  
},
  created() {
  
 

  },

  methods: {
    
    consultarTasa: function(e){
      e.preventDefault();
      
      this.getRangoTasa();


    }, getRangoTasa:async function(){

      var url=urlBase+'index.php/tasaactual?desde='+this.formatFecha(this.desde)+"&hasta="+this.formatFecha(this.hasta)
      const datos= await axios({
       method: 'GET',
       url:  url,
     
     })
     var arraydata= datos.data.BCV;
     var arraydataMonitor= datos.data.MONITOR;
     this.arrayTasa= datos.data.BCV.datos[0];
     console.log(this.arrayTasa)
     var ctx = document.getElementById("myChartasa");

     if(!arraydata.label){
      arraydata.label=arraydataMonitor.label
 
     }

   
 
     var myChart = new Chart(ctx, {

      type: 'line',
      data: {
        labels: arraydata.label,
        datasets: [{
          label: 'BCV',
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
      
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)'
          
      ],
          fill: false,
          data: arraydata.data,
        }, {
          label: 'Monitor',
          backgroundColor: [
            'rgba(88, 193, 167, 0.2)',
      
        ],
        borderColor: [
          'rgba(99, 193, 167, 1)'
          
      ],
          fill: false,
          data:arraydataMonitor.data,
        }]
      },
      options: {
        responsive: true,
        title: {
          display: true,
        },
        scales: {
          xAxes: [{
            display: true,
          }],
          yAxes: [{
            display: true,
           
          }]
        }
      }
    
        /* type: 'line',
         data: {
             labels: arraydata.label,
             datasets: [{
                 label: 'BCV',
                 
        
                 data:arraydata.data,
             
                 backgroundColor: [
                     'rgba(255, 99, 132, 0.2)',
               
                 ],
                 borderColor: [
                     'rgba(255, 99, 132, 1)'
                     
                 ],
                 borderWidth: 1
             },
             {
              label: 'MONITOR',
              
            
              data:arraydataMonitor.data,
            
              backgroundColor: [
                  'rgba(88, 193, 167, 0.2)',
            
              ],
              borderColor: [
                  'rgba(99, 193, 167, 1)'
                  
              ],
              borderWidth: 2
          }
            
            ]
         },
         options:  {  
      
      
        }*/
     }
     
     );

    },
    
    formatFecha(fecha){

      var d= new Date(fecha);
        datestring =  d.getFullYear()  + "-" + (d.getMonth()+1) + "-" + d.getDate() ;


      return   datestring ;
    },
    changeFuente(){

      console.log(this.registro.fuente)
      this.getParroquias(this.registro.fuente)
   
    },
    changeOrigen(){
      this.registro.fuente=""
      this.getFuentes(this.registro.origen);
     
    },
    consultarListaSeguimiento:async function(e){
      e.preventDefault();
      location.href=urlBase+"index.php/listaseguimiento?desde="+this.formatFecha(this.desde)+"&hasta="+this.formatFecha(this.hasta)

    },
    editarSeguimiento:async function(id){

      this.getSeguimientoID(id)


    },
    editarUsuario: function(id){
      this.id=id;
      $("#modaleditar").modal("show")
    },
    getSeguimientoID:async function(id){

      var url=urlBase+'index.php/findseguimiento?id='+id;
      this.id_segimiento=id;
      try {
        
        const data= await axios({
          method: 'GET',
          url:  url,
         
        
        })
        this.dataEditProductos=data.data[0];
        this.registro.origen=this.dataEditProductos.id_origen;
        this.registro.fuente=this.dataEditProductos.id_fuente;
        this.registro.parroquia=this.dataEditProductos.id_parroquia;
        this.registro.producto=this.dataEditProductos.producto_id;
        this.registro.precio=this.dataEditProductos.precio;
        var d= new Date(this.dataEditProductos.fecha);
        var datestring =  d.getFullYear()  + "-" + (d.getMonth()+1) + "-" + d.getDate() ;
        console.log(d)
        this.fechae=datestring;

        console.log(  this.dataEditProductos)
        $("#modaleditar").modal("show")

      } catch (error) {
        console.log(error)
      }
     

    },
    eliminartasa:async function(id){
      var url=urlBase+'index.php/eliminarTasa';
      const data= await axios({
        method: 'POST',
        url:  url,
        data:{ id:id}
      
      })
     console.log(data.data)
      swal(
       { title: "¡ Buen trabajo !",
         text:"Se elimino Exitosamente",
         icon: "success",
         timer: 5000,
       })

       setTimeout(() => {
        location.reload()
       }, 2000);
  
    },
    eliminarSeguimiento:async function(id){
      var url=urlBase+'index.php/eliminarSeguimiento';

      try {
        
        const data= await axios({
          method: 'POST',
          url:  url,
          data:{ id:id}
        
        })
       console.log(data.data)
        swal(
         { title: "¡ Buen trabajo !",
           text:"Se elimino Exitosamente",
           icon: "success",
           timer: 5000,
         })

         location.href=urlBase+"index.php/listaseguimiento?desde="+this.formatFecha(this.desde)+"&hasta="+this.formatFecha(this.hasta)

    
      } catch (error) {
        console.log(error)
      }
    },
    checkEdicionUsuario: function(){
     
      
      if (this.perfil && this.nuevaClave) {
     
          
          this.guardarEdicionUsuario()
      return true;
    }
    this.errors = [];
    if (!this.perfil ) {
      this.errors.push('el perfil es obligatorio.');
    }
    if (!this.nuevaClave) {
      this.errors.push('la clave es obligatoria.');
    }


    },
    guardarEdicionUsuario:async function(){
      var url=urlBase+'index.php/guardarEdicionUsuario';
      
      const data= await axios({
        method: 'POST',
        url:  url,
        data: {id:this.id,perfil:this.perfil,nuevaClave:this.nuevaClave}
      
      })
     console.log(data)
      swal(
       { title: "¡ Buen trabajo !",
         text:"Cambios  guardados Exitosamente",
         icon: "success",
         timer: 5000,
       })
       location.reload()

       $("#modaleditar").modal("hide")
    },
    guardarEdicion:async function(){

      var url=urlBase+'index.php/guardarEdicion';

      try {
        
        const data= await axios({
          method: 'POST',
          url:  url,
          data: {precio:this.registro.precio,id:this.id_segimiento}
        
        })
       console.log(data)
        swal(
         { title: "¡ Buen trabajo !",
           text:"Cambios guardados Exitosamente",
           icon: "success",
           timer: 5000,
         })

         location.href=urlBase+"index.php/listaseguimiento?desde="+this.formatFecha(this.desde)+"&hasta="+this.formatFecha(this.hasta)

         $("#modaleditar").modal("hide")
      } catch (error) {
        console.log(error)
      }
    },
    guardarTasa:async function(){

      var url=urlBase+'index.php/guardarTasa';

      try {
        
        const data= await axios({
          method: 'POST',
          url:  url,
          data: {tasa:this.tasar,fecha:this.formatFecha(this.registro.fecha),fuente:this.fuentet}
        
        })
       
        swal(
         { title: "¡ Buen trabajo !",
           text:"Cambios guardados Exitosamente",
           icon: "success",
           timer: 5000,
         })
         this.getTasa(); 

         $("#modaltasa").modal("hide")
      } catch (error) {
        console.log(error)
      }
     
    },
    guardarProductos:async function(){

      var url=urlBase+'index.php/guardarProducto';

      try {
        
        const data= await axios({
          method: 'POST',
          url:  url,
          data: {nuevoproducto:this.nuevoproducto}
        
        })
      if(data.data.result){
        swal(
          { title: "¡ Buen trabajo !",
            text:"Cambios guardados Exitosamente",
            icon: "success",
            timer: 5000,
          })
       
      }else{

        swal(
          { title: "¡ Error !",
            text:"Esta producto ya se encuentra Registrada",
            icon: "warning",
            timer: 5000,
          })
      }
 
         $("#modalProducto").modal("hide")
      } catch (error) {
        console.log(error)
      }
     
    },
    editarTipocambio: function(event){
      var id= event.target.dataset.id;
      var tasa= event.target.dataset.tasa;
      this.id=id;
      this.nuevaTasa=tasa;
      $("#modalEditarTasa").modal("show")
    },
    editarProducto: function(event){
      var id= event.target.dataset.id;
      var producto= event.target.dataset.producto;
      this.productosP=id;
      this.nuevoproducto=producto;
      $("#modalProductoE").modal("show")

    },
    guardarTasaEdicion:async function(){

      var url=urlBase+'index.php/editarTasa';

      const data= await axios({
       method: 'POST',
       url:  url,
       data:{id: this.id,nuevaTasa:this.nuevaTasa}
     
     })

     swal(
      { title: "¡ Buen trabajo !",
        text:"Cambios guardados Exitosamente",
        icon: "success",
        timer: 5000,
      })
     setTimeout(() => {
      location.reload()
     }, 2000);

    },
    guardarProductosEdicion:async function(){
     
   
      var url=urlBase+'index.php/editarProducto';

      const data= await axios({
       method: 'POST',
       url:  url,
       data:{id: this.productosP,producto:this.nuevoproducto}
     
     })

     swal(
      { title: "¡ Buen trabajo !",
        text:"Cambios guardados Exitosamente",
        icon: "success",
        timer: 5000,
      })
     setTimeout(() => {
      location.reload()
     }, 2000);

    },
    checkFormUsuario: function(){

      
      if (this.usuario && this.clave && this.perfil  ) {
     
          
          this.regitrarUsuario()
      return true;
    }
    this.errors = [];

    if (!this.usuario ) {
      this.errors.push('el usuario es obligatorio.');
    }
    if (!this.clave) {
      this.errors.push('la clave es obligatorio.');
    }

    if (!this.perfil) {
      this.errors.push('el perfil es obligatorio.');
    }


    },
    checkFormFuente: function(){


      if (this.registro.parroquia 
      
     
        && this.registro.nombre
  
       
        && this.registro.origen

        ) {
     
          
          this.regitrarFuente()
      return true;
    }

    this.errors = [];

    if (!this.registro.parroquia ) {
      this.errors.push('la parroquia es obligatoria.');
    }
    if (!this.registro.nombre) {
      this.errors.push('el nombre es obligatorio.');
    }

    if (!this.registro.origen) {
      this.errors.push('el origen es obligatoria.');
    }

    e.preventDefault();
    },
    checkForm: function (e) {
 

      if (this.registro.parroquia 
      
          && this.registro.precio
      
          && this.registro.fecha
         
          && this.registro.origen
     
          && this.registro.producto
          ) {
       
            this.regitrarSeguimiento()
        return true;
      }

      this.errors = [];

      if (!this.registro.parroquia ) {
        this.errors.push('la parroquia es obligatoria.');
      }
    

      if (!this.registro.origen) {
        this.errors.push('el origen es obligatoria.');
      }

      if (!this.registro.producto) {
        this.errors.push('el producto es obligatorio.');
      }



      if (!this.registro.fecha) {
        this.errors.push('la fecha es obligatoria.');
      }
  if (!this.registro.precio) {
        this.errors.push('el precio es obligatoria.');
      }
      e.preventDefault();
    },changePeriodo:function (event) {
      var id =event.target.value;
      if(id=="rango"){
        $("#modalperiodo").modal("show")
      }
console.log(id)
    },

    changeParroquia: function (event) {
     var id =event.target.value;

      this.getCircuito(id);
    },
    consultarProductos: function(){
      $("#modalperiodo").modal("hide")

      this.getGraficas(this.fechaf,this.id_parroquia,this.registro.origen,this.id_producto)
    },
    getGraficas: async function (fecha,parroquia,origen,id_producto,fuente) {
     
      var params = new URLSearchParams();
     
 
      var url=urlBase+'index.php/getproductos?fecha='+fecha+"&parroquia="+parroquia+"&origen="+origen+"&id="+id_producto+"&fuente="+this.registro.fuente+"&desde="+this.formatFecha(this.desde)+"&hasta="+this.formatFecha(this.hasta)
     const detalles= await axios({
      method: 'GET',
      url:  url,
    
    })

    if(this.fechaf=="rango"){
      this.fechaf=""
    }
    this.columna=4;
    if(this.id_parroquia=="promediado"){

      this.columna=8;
   
    }
   
    console.log(detalles)
    let data= detalles.data;

    this.productos =data;

    setTimeout(() => {
      
      for (let i = 0; i < data.length; i++) {
        const element = data[i];
        var datos=  JSON.parse(JSON.stringify(element.datos.data));
        var datosUSD=  JSON.parse(JSON.stringify(element.datos.usd));
        var nuevadata = datos.map(function (datos, index, array) {
           return  parseFloat(datos); 
           });
           var usd = datosUSD.map(function (datos, index, array) {
            return  parseFloat(datos); 
            });
           var labels=JSON.parse(JSON.stringify(element.datos.label));
          var producton=JSON.parse(JSON.stringify(element.producto));
          var id=JSON.parse(JSON.stringify(element.id));
           this.mostraGrafica(producton,labels, "myChart"+id,nuevadata,usd)
  
      
        
      }
    }, 1000);
  





    this.getTasa(); 
  
    },
   
    
    regitrarUsuario:async function(){

      var url=urlBase+'index.php/addUser';
      const data= await axios({
        method: 'POST',
        url:  url,
        data:{usuario:this.usuario,clave:this.clave,perfil:this.perfil}
      
      })
     console.log(data.data)
     if(data.data.result){
       swal(
         { title: "¡ Buen trabajo !",
           text:"Se guardado Exitosamente",
           icon: "success",
           timer: 5000,
         })
        setTimeout(() => {
         location.reload()
        }, 2000);
         
 
     }else{
 
       swal(
         { title: "¡ Error !",
           text:"Esta fuente ya se encuentra Registrada",
           icon: "warning",
           timer: 5000,
         })
       
         
     }
     

    },
    getProductosALL:async function(){



      var url=urlBase+'index.php/productosall';
     const productos= await axios({
      method: 'GET',
      url: url,
    
    });
    

      this.productosall=productos.data;

    
    },

       
    productosPromedio:async function(){



      var url=urlBase+'index.php/productospromedio';
     const productos= await axios({
      method: 'GET',
      url: url,
    
    });
    

      this.productosP=productos.data;

    
    },
    getTasa:async function(){



      var url=urlBase+'index.php/tasa';
     var response= await axios({
      method: 'GET',
      url: url,
    
    })
      this.tasa=response.data;
      this.tasaActual=tasa=this.tasa.tasa
      this.registro.tasa=this.tasa.tasa
 
    
    },

    getFuentes:async function(id){



      var url=urlBase+'index.php/getFuentes?id='+id;
     var response= await axios({
      method: 'GET',
      url: url,
    
    })
      this.arrayFuentes=response.data;
    
    
    },

    getCircuito:async function(id){



      var url=urlBase+'index.php/eje?id='+id;
     var response= await axios({
      method: 'GET',
      url: url,
    
    })
      this.tasa=response.data;


 
    
    },

    getOrigen:async function(){



      var url=urlBase+'index.php/origen';
     var response= await axios({
      method: 'GET',
      url: url,
    
    })
      this.origenes=response.data;

 
    
    },
    
    regitrarFuente: async function(){

      var url=urlBase+'index.php/registrarFuente';

      const data= await axios({
       method: 'POST',
       url:  url,
       data:this.registro
     
     })
    console.log(data.data)
    if(data.data.result){
      swal(
        { title: "¡ Buen trabajo !",
          text:"Se guardado Exitosamente",
          icon: "success",
          timer: 5000,
        })
       setTimeout(() => {
        location.reload()
       }, 2000);
        

    }else{

      swal(
        { title: "¡ Error !",
          text:"Esta fuente ya se encuentra Registrada",
          icon: "warning",
          timer: 5000,
        })
      
        
    }
    
    
     },
    regitrarSeguimiento: async function(){

      var url=urlBase+'index.php/registrarSeguimiento';
      this.registro.fecha= this.formatFecha(this.registro.fecha)
      const data= await axios({
       method: 'POST',
       url:  url,
       data:this.registro
     
     })
    
     if(data.data.result){
      swal(
        { title: "¡ Buen trabajo !",
          text:"Cambios guardados Exitosamente",
          icon: "success",
          timer: 5000,
        })

        setTimeout(() => {
          location.reload()
        }, 3000); 
     
    }else{

      swal(
        { title: "¡ Error !",
          text:"Por Favor primero agregue la tasa de cambio para la fecha "+this.registro.fecha,
          icon: "warning",
          timer: 10000,
        })
    }
      
    console.log(data)
     },
    getParroquias:async function(id){


      var url=urlBase+'index.php/parroquias?id='+id;

      const data= await axios({
       method: 'GET',
       url:  url,
     
     })
    
     this.parroquias=data.data
     
     
     },
     getParroquiasF:async function(){


      var url=urlBase+'index.php/parroquias?id=1';

      const data= await axios({
       method: 'GET',
       url:  url,
     
     })
    
     this.parroquiasF=data.data
     
     
     },
    mostraGrafica: function (nombre,labels,element,data,usd) {
      var numColor=getRandomArbitrary(0, 8).toFixed()
      var numColor2=getRandomArbitrary(0, 8).toFixed()
      var ctx = document.getElementById(element);
      var mixedChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: "Bs",
                data: data,
                yAxisID: 'y-axis-1',
                lineTension:0.1,
                borderColor:COLORS[numColor],
                "fill":false
             

            },
             {
              label: 'USD',
              borderColor:'#acc236',
    
              fill: false,
              data:usd,
              yAxisID: 'y-axis-2'
            }
          
          

          
          ],
            labels: labels
        },
        options:  {
          responsive: true,
          hoverMode: 'index',
          stacked: false,
          title: {
            display: true,
            text: nombre
          },
          scales: {
            yAxes: [{
              type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
              display: true,
              position: 'left',
              id: 'y-axis-1',
            }, {
              type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
              display: true,
              position: 'right',
              id: 'y-axis-2',
    
              // grid line settings
              gridLines: {
                drawOnChartArea: false, // only want the grid lines for one axis to show up
              },
            }],
          }
        }
    });

     
      /*new Morris.Line({
        // ID of the element in which to draw the chart.
        element: element,
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data:data,
        // The name of the data record attribute that contains x-values.
        xkey: xkey,
        // A list of names of data record attributes that contain y-values.
        ykeys: [ykeys],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: [labels]
      });
*/

    }


  }
});

function valideKey(evt)
{
  var code = (evt.which) ? evt.which : evt.keyCode;
  if(code==8) 
  {
    //backspace
    return true;
  }
  else if(code>=48 && code<=57) 
  {
    //is a number
    return true;
  }
  else
  {
    return false;
  }
}




