import axios from 'axios'
import { URL_BASE } from '../../../configs/configs'

const RESOURCE = 'pacientes'
const CONFIGS = {
    headers: {
        'content-type': 'multipart/form-data'
    }
}

export default {
    loadPacientes (context, params) {
        return axios.get(`${URL_BASE}${RESOURCE}`, { params })
            .then(response => context.commit('LOAD_PACIENTES', response.data))
            .catch(error => console.log(error))
            .finally( () => {
                //
            })
    },
    /*storeProduct (context, formData) {
        context.commit('CHANGE_PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.post(`${URL_BASE}${RESOURCE}`, formData, CONFIGS)
                .then(response => resolve())
                .catch(error => {
                    context.commit('CHANGE_PRELOADER', false)
                    reject(error.response)
                })
            // .finally(() => context.commit('PRELOADER', false))
        })
    },*/

    loadPaciente (context, id) {
        //context.commit('CHANGE_PRELOADER', true)
        return new Promise((resolve, reject) => {
            axios.get(`${URL_BASE}${RESOURCE}/${id}`)
                .then(response => resolve(response.data))
                .catch(error => reject())
                .finally( () => {
                    //context.commit('CHANGE_PRELOADER', false)
                })
        })
    },

    /*updateProduct (context, formData) {
        context.commit('CHANGE_PRELOADER', true)

        formData.append('_method', 'PUT')

        return new Promise((resolve, reject) => {
            axios.post(`${URL_BASE}${RESOURCE}/${formData.get('id')}`, formData)
                .then(response => resolve())
                .catch(error => reject(error))
                .finally(() => context.commit('CHANGE_PRELOADER', false))
        })
    },

    destroyProduct (context, id) {
        context.commit('CHANGE_PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.delete(`${URL_BASE}${RESOURCE}/${id}`)
                .then(response => resolve())
                .catch(error => {
                    reject();
                    context.commit('CHANGE_PRELOADER', false)
                })
                //.finally(() => context.commit('CHANGE_PRELOADER', false))
        })
    }*/
}
