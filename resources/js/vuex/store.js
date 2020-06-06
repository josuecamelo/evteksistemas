import Vue from 'vue'
import Vuex from 'vuex'
import preloader from "./modules/preloader/preloader";
import pacientes from "./modules/pacientes";

Vue.use(Vuex)

const store = new Vuex.Store({
   modules:{
       preloader,
       pacientes
   }
})

export default store
