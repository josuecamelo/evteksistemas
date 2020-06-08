<template>
    <div>
        <paciente-form-component :paciente="paciente" :update="update" @success="success" />

        <div class="col-md-6 float-right" style="margin-left: -15px !important;">
            <div class="form-group">
                <div class="col-md-6 float-right">
                    <search @search="searchForm"></search>
                </div>
            </div>
        </div>




        <div class="col-md-12 float-left" style="padding-bottom: 5px;">
            <button @click="enabledExcludedRecord" :disabled="cadastrosAtivos ? !cadastrosAtivos : ''">Cadastros Ativos</button>
            <button @click="enabledExcludedRecord" :disabled="!cadastrosAtivos ? cadastrosAtivos : ''">Cadastros Excluídos</button>
        </div>

        <table class="table table-sm table-responsive-sm table-striped">
            <thead class="thead-light">
            <tr>
                <th @click="ordenar"><a href="#">Nome</a></th>
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
    import SearchComponent from "../../layouts/SearchComponent";

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
                order: 'ASC',
                deleted: '',
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
                cadastrosAtivos: false
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
                    order: this.order,
                    deleted: this.deleted
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
                        {text: 'Não', action: (toast) => this.$snotify.remove(toast.id),},
                    ]
                })
            },
            ordenar(){
              if(this.order == 'ASC'){
                  this.order = 'DESC'
              } else {
                  this.order = 'ASC'
              }
              this.loadPacientes(1)
            },
            enabledExcludedRecord(){
                this.cadastrosAtivos = !this.cadastrosAtivos;

                if(this.cadastrosAtivos){
                    this.deleted = 'f'
                } else {
                    this.deleted = ''
                }
                this.loadPacientes(1)
            },
            searchForm(filter) {
                this.search = filter;
                this.loadPacientes(1)
            },
            success () {
                this.update = false;
                this.loadPacientes(1)
            },
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
                        this.$snotify.success('Paciente Excluído com Sucesso', 'Alerta', {
                            timeout: 10000,
                            showProgressBar: true,
                            closeOnClick: true,
                            pauseOnHover: false,
                            position: 'centerCenter',
                            buttons: [
                                {text: 'Ok', action: (toast) => this.$snotify.remove(toast.id),},
                            ]
                        })

                        this.loadPacientes(1)
                    })
                    .catch( errors => {
                        this.$snotify.error('Algo de Errado', 'Não foi possível deletar o Paciente')
                    })
            }
        },
        components: {
            paginate: PaginationComponent,
            PacienteFormComponent,
            search: SearchComponent,
            destroy: ButtonDestroyComponent
        }
    }
</script>

<style scoped>
    .img-list {
        max-width: 100px;
    }
</style>
