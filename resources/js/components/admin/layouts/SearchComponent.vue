<template>
    <div>
        <form class="form form-inline" @submit.prevent="search">

            <input type="text" v-model="filter" @keyup="search" style="margin-left: 15px !important;" placeholder="Buscar..." class="form-control mr-sm-2">

<!--            <div v-if="filter">-->
<!--                <p>Resultados para: {{ filter }}</p>-->
<!--            </div>-->
<!--            <button type="submit" class="btn btn-outline-success">Pesquisar</button>-->
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
                if(this.filter.length > 3) {
                    this.$emit('search', this.filter)
                }else{
                    this.$emit('search', '')
                }
            }
        }
    }
</script>
