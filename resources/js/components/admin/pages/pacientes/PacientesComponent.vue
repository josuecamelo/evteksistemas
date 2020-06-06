<template>
    <div>
        <table class="table table-responsive table-bordered">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th width="200">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="paciente in pacientes.data" :key="paciente.id">
                <td>{{ paciente.nome }}</td>
                <td>{{ paciente.data_nasc | calcIdade }}</td>
            </tr>
            </tbody>
        </table>

        <paginate
            :pagination="pacientes"
            :offset="10"
            @paginate="loadPacientes">
        </paginate>
    </div>
</template>


<script>
    import Vue from 'vue';
    import PaginationComponent from '../../../layouts/PaginationComponent'
    import PacienteFormComponent from "./partials/PacienteFormComponent";

    Vue.filter('calcIdade', function (value) {
        let d = new Date,
            ano_atual = d.getFullYear(),
            mes_atual = d.getMonth() + 1,
            dia_atual = d.getDate(),
            dataNasc = new Date(value),
            ano_aniversario = dataNasc.getFullYear(),
            mes_aniversario = dataNasc.getMonth() - 1,
            dia_aniversario = dataNasc.getDay(),
            quantos_anos = ano_atual - ano_aniversario;

        if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
            quantos_anos--;
        }
        return quantos_anos < 0 ? 0 : quantos_anos;
    })

    export default {
        created() {
            this.loadPacientes(1)
        },
        data() {
            return {
                search: '',
                /*product: {
                    id: '',
                    name: '',
                    description: '',
                    category_id: '',
                },
                update: false,*/
            }
        },
        computed: {
            pacientes() {
                return this.$store.state.pacientes.items
            },
            params() {
                return {
                    page: this.pacientes.current_page,
                    filter: this.search,
                }
            }
        },
        methods: {
            loadPacientes(page) {
                this.$store.dispatch('loadPacientes', {...this.params, page})
            },
            /*edit (id) {
                this.reset()

                this.$store.dispatch('loadProduct', id)
                    .then(response => {
                        this.product = response
                        this.showModal = true;
                        this.update = true;
                    })
                    .catch( errors => {
                        this.$snotify.error('Algo de Errado', 'Erro ao Carregar o Produto')
                    })
            },
            searchForm(filter) {
                this.search = filter;
                this.loadProducts(1)
            },
            hideModal () {
                this.showModal = false;
            },
            success () {
                this.hideModal()
                this.loadProducts(1)
            },
            create () {
                this.showModal = true;
                this.update = false;
                this.reset()
            },
            reset () {
                this.product = {
                    id: '',
                    name: '',
                    description: '',
                    category_id: '',
                }
            },

            destroy (id) {
                this.$store.dispatch('destroyProduct', id)
                    .then(response => {
                        this.$snotify.success('Tudo certo', 'Deletou o Produto')
                        this.loadProducts(1)
                    })
                    .catch( errors => {
                        this.$snotify.error('Algo de Errado', 'Não foi possível deletar o Produto')
                    })
            }*/
        },
        components: {
            paginate: PaginationComponent,
            //search: SearchComponent,
            PacienteFormComponent,
            //destroy: ButtonDestroyComponent
        }
    }
</script>

<style scoped>
    .img-list {
        max-width: 100px;
    }
</style>
