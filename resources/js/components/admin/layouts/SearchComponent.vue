<template>
    <div>
        <form class="form form-inline" @submit.prevent="search">

            <input type="text" v-model="filter" placeholder="Pesquisar:" class="form-control mr-sm-2">

            <div v-if="filter">
                <p>Resultados para: {{ filter }}</p>
            </div>
            <button type="submit" class="btn btn-outline-success">Pesquisar</button>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                filter: ''
            }
        },
        methods: {
            search () {
                //emite ação para o pai de algum componente
                this.$emit('search', this.filter)
            }
        }
    }
</script>
