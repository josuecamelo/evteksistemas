<template>
    <div>
        <ul class="nav">
            <li class="nav-item"><router-link class="nav-link" :to="{name: 'admin.dashboard'}">Dashboard</router-link></li>
            <li class="nav-item"><router-link class="nav-link" :to="{name: 'admin.pacientes'}">Pacientes</router-link></li>
        </ul>

        <div class="container-fluid">
            <div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            /*totalCategories (){
                return this.$store.state.categories.items.data.length
            } ,
            me () {
                return this.$store.state.auth.me
            }*/
        },
    }
</script>

<style scoped>

</style>
