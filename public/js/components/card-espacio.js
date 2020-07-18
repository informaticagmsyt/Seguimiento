Vue.component('card-espacio',{
    template: //html
    ` 
  
    <div class="card">
    <div class="card-text">
        <p class="texta">Almacenamiento </p>
        <p class="text-porcentaje">{{ porcentaje }}%</p>
        <p class="text-almacenamiento"><span class="espacio">{{ espacio.almacenamiento }}</span>/<span>2GB</span></p>
    </div>
    <div class="progress-circle " :class="'p'+absoluto">

        <div class="left-half-clipper">
            <div class="image-cloud">

            </div>
            <div class="first10-bar"></div>
            <div class="value-bar" id="value-bar"></div>

        </div>
    </div>
</div>




    `,
    created() {
    },
    mounted(){
        this.getDataEspacio();
 
    },
    data(){
        return {

    
            
        }
    },
       methods:{
       // ...Vuex.mapMutations(['cargardata']),
        ...Vuex.mapActions(['getDataEspacio'])

    },
    computed:{
        ...Vuex.mapState(['espacio','porcentaje','absoluto']),
      
    }

       
});
    