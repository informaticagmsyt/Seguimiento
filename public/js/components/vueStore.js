const store = new Vuex.Store({
  state: {
    espacio: [
      {
        almacenamiento: "0.00 GB"
      }
    ],
    numero: 1,
    porcentaje: 0,
    absoluto: 0,
    dataArchivos: [],
    urlBase: "",
    errors: [],
    desde: new Date(),
    hasta: new Date(),
    resultados:true,
    'disabled':'disabled',
    textoBuscar:null,
  },
  mutations: {
    increment(state) {
      state.numero++;
    },
    setDesde (state,desde) {
      state.desde=desde;
    },
    setHasta (state,hasta) {
      state.hasta=hasta;
    }, 
    setBuscar (state,buscar) {
      state.textoBuscar=buscar;
    },
    setErrors (state,error) {
      state.errors.push(error);
    },
    setResultado (state,result) {
      state.resultados=result;
      if(result)
      state.disabled='';
      else
      state.disabled='disabled';
    },
    porcentaje(state, cantidad) {
      state.porcentaje = (cantidad / 2) * 100 || 0;
      state.absoluto = parseFloat(state.porcentaje).toFixed(0);
    },
    setURLbase(state, url) {
      state.urlBase = url;
    },
    cargardata(state, data) {
      state.espacio = data;
    },
    cargardataArchivos(state, data) {
      state.dataArchivos = data;
    }
  },
  actions: {
    getDataEspacio: async function({ commit, state}) {
      try {
        let result = await axios({
          method: "get",
          url: urlBase2+"AlmacenamientoController/index"
        });

        console.log(result.data);
        commit("cargardata", result.data);
        commit("porcentaje", result.data);
      } catch (error) {
        console.error(error);
      }
    },
    getDataArchivos: async function({ commit, state }) {
      try {
        let result = await axios({
          method: "get",
          url: state.urlBase
        });

  
        commit("cargardataArchivos", result.data);
          
        if(result.data.length==0)
   commit('setResultado',false)
        else
     commit('setResultado',true)


        return result;

      } catch (error) {
        console.error(error);
      }
    },
    
  }
});
