
const store = new Vuex.Store({
    state: {
      numero: 10,
      empleados:[],
 
    },
    mutations: {
      increment (state) {
        state.numero++
      },
     
      cargarEmpleados(state,dataEmpleados){
        state.empleados=dataEmpleados;
      }
    },actions:{
      getEmpleados: async function({commit}){
       let result=  await axios({
          method: 'get',
          url:  'http://localhost/archivadora/api/10833/empleados'
          
        });

        commit('cargarEmpleados',result.data.data);
        console.log(result.data.data)

      }

    }
  })