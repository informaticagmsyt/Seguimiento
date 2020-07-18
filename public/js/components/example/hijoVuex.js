Vue.component('hijo',{
    template://html
    ` 
    <div class="">
    <button @click="increment">+</button>
  
    <div v-for="item of empleados">

    <img :src="item.path" class="img-fluid " alt="">
    </div>
    </div>
    `,
    props:['numero'],
    

    data(){
        return {

        nombre:'Jhonatan'

        }
    },
    methods:{
        ...Vuex.mapMutations(['increment']),
        ...Vuex.mapActions(['getEmpleados'])
    },computed:{
        ...Vuex.mapState(['numero','empleados'])
      
    },
    mounted(){
this.getEmpleados();
    }

    
    });