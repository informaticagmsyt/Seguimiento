Vue.component('titulo',{
    template://html
    ` 
    <div class="">
    <h1> Titulo {{numero}}<h1>

    <hijo>
    </hijo>
    </div>
    `,
    
    data(){
        return {
            numeroPadre:0,
            nombrePadre:''
        }
    },
    computed:{
        ...Vuex.mapState(['empleados'])
      
    }

       
});
    