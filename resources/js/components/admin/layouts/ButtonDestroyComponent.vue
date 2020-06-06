<template>
    <div>
        <a href="#" @click.prevent="confirmDelete(item)" class="btn btn-danger btn-xs">Excluir</a>
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
                this.$snotify.error(`Deseja realmente excluir o cadastro do Paciente?`, 'Alerta', {
                    timeout: 10000,
                    showProgressBar: true,
                    closeOnClick: true,
                    pauseOnHover: false,
                    position: 'centerCenter',
                    buttons: [
                        {text: 'Não', action: (toast) => this.$snotify.remove(toast.id),},
                        {text: 'Sim', action: () => this.$emit('destroy', item.id)},
                    ]
                })
            },
        }
    }
</script>

<style scoped>

</style>
