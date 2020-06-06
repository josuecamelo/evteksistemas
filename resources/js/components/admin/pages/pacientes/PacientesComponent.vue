<template>
    <div>
        <paciente-form-component :paciente="paciente" :update="update" />

        <table class="table table-sm table-responsive-sm table-striped">
            <thead class="thead-light">
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>CPF</th>
                <th width="200">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="paciente in pacientes.data" :key="paciente.id">
                <td class="align-middle">{{ paciente.nome }}</td>
                <td class="align-middle">{{ paciente.data_nasc | calcIdade }}</td>
                <td class="align-middle">{{ paciente.cpf }}</td>
                <td class="d-inline-flex align-middle">
                    <a href="#" @click.prevent="edit(paciente.id)" class="btn btn-primary btn-xs">Editar</a>
                    <destroy :item="paciente" @destroy="destroy"/>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="float-right">
            <paginate
                :pagination="pacientes"
                :offset="10"
                @paginate="loadPacientes">
            </paginate>
        </div>
    </div>
</template>


<script>
    import Vue from 'vue';
    import PaginationComponent from '../../../layouts/PaginationComponent'
    import PacienteFormComponent from "./partials/PacienteFormComponent";
    import ButtonDestroyComponent from "../../layouts/ButtonDestroyComponent";

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
                paciente: {
                    id: '',
                    cpf: '',
                    nome: '',
                    rg: '',
                    cartao_sus: '',
                    sexo: '',
                    data_nasc: '',
                    nome_mae: '',
                    telefone: '',
                    cep: '',
                    logradouro: '',
                    numero: '',
                    quadra: '',
                    lote: '',
                    complemento: '',
                    bairro: '',
                    cidade: '',
                    uf: '',
                },
                update: false,
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
            edit (id) {
                this.$snotify.info(`Deseja realmente atualizar o cadastro do Paciente?`, 'Alerta', {
                    timeout: 10000,
                    showProgressBar: true,
                    closeOnClick: true,
                    pauseOnHover: false,
                    position: 'centerCenter',
                    buttons: [
                        {text: 'Não', action: (toast) => this.$snotify.remove(toast.id),},
                        {text: 'Sim', action: (toast) => {
                            this.reset()
                            this.$store.dispatch('loadPaciente', id)
                                .then(response => {
                                    this.paciente = response
                                    this.update = true;
                                })
                                .catch( errors => {
                                    this.$snotify.error('Algo de Errado', 'Erro ao Carregar o Paciente')
                                })
                            this.$snotify.remove(toast.id)
                        }},
                    ]
                })
            },
            /*searchForm(filter) {
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
            },*/
            reset () {
                this.paciente = {
                    id: '',
                    cpf: '',
                    nome: '',
                    rg: '',
                    cartao_sus: '',
                    sexo: '',
                    data_nasc: '',
                    nome_mae: '',
                    telefone: '',
                    cep: '',
                    logradouro: '',
                    numero: '',
                    quadra: '',
                    lote: '',
                    complemento: '',
                    bairro: '',
                    cidade: '',
                    uf: '',
                }
            },
            destroy (id) {
                this.$store.dispatch('destroyPaciente', id)
                    .then(response => {
                        this.$snotify.success('Alerta', 'Paciente Excluído com Sucesso')
                        this.loadPacientes(1)
                    })
                    .catch( errors => {
                        this.$snotify.error('Algo de Errado', 'Não foi possível deletar o Paciente')
                    })
            }
        },
        components: {
            paginate: PaginationComponent,
            //search: SearchComponent,
            PacienteFormComponent,
            destroy: ButtonDestroyComponent
        }
    }
</script>

<style scoped>
    .img-list {
        max-width: 100px;
    }
</style>
