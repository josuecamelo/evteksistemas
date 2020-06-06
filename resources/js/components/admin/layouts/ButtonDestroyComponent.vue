<template>
    <div>
        <a href="#" @click.prevent="confirmDelete(item)" class="btn btn-danger">Remover</a>
    </div>
</template>

<script>
    export default {
        props: {
            item: {
                required: true,
                type: Object,

            }
        },
        methods: {
            confirmDelete (item) {
                this.$snotify.error(`Deseja realmente excluir o produto ${item.name}`, 'Confirma?', {
                    timeout: 10000,
                    showProgressBar: true,
                    closeOnClick: true,
                    pauseOnHover: true,
                    buttons: [
                        {text: 'Não', action: () => { console.log('não')}},
                        {text: 'Sim', action: () => this.$emit('destroy', item.id)}, //tem que escultar o evento no componente dentro do componente pai
                    ]
                })
            },
        }
    }
</script>

<style scoped>

</style>
