<template>
    <div>
        <form class="form" @submit.prevent="onSubmit">
            <div class="col-md-2 float-left">
                <img src="https://picsum.photos/200" class="img-preview">
            </div>
            <div class="col-md-10 float-right">
                <div class="form-row">
                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.cpf }]">
                            <input type="text" v-mask="'###.###.###-##'" maxlength="14" v-model="paciente.cpf" class="form-control" placeholder="CPF"/>
                            <div v-if="errors.cpf">
                                {{ errors.cpf[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div :class="['form-group', {'has-error': errors.nome }]">
                            <input type="text" v-model="paciente.nome" class="form-control"
                                   placeholder="Nome do Paciente"/>
                            <div v-if="errors.nome">
                                {{ errors.nome[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.rg }]">
                            <input type="text" v-model="paciente.rg" class="form-control" placeholder="RG"/>
                            <div v-if="errors.rg">
                                {{ errors.rg[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.cartao_sus }]">
                            <input type="text" v-model="paciente.cartao_sus" class="form-control"
                                   placeholder="Cartão SUS."/>
                            <div v-if="errors.cartao_sus">
                                {{ errors.cartao_sus[0] }}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.sexo }]">
                            <input type="text" v-model="paciente.sexo" class="form-control" placeholder="Sexo"/>
                            <div v-if="errors.sexo">
                                {{ errors.sexo[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.data_nasc }]">
                            <input type="text" v-mask="'##/##/####'" v-model="paciente.data_nasc" class="form-control"
                                   placeholder="Nascimento"/>
                            <div v-if="errors.data_nasc">
                                {{ errors.data_nasc[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div :class="['form-group', {'has-error': errors.nome_mae }]">
                            <input type="text" v-model="paciente.rg" class="form-control" placeholder="Nome da Mãe"/>
                            <div v-if="errors.nome_mae">
                                {{ errors.nome_mae[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.telefone }]">
                            <input type="text" v-model="paciente.telefone" class="form-control" placeholder="Telefone"/>
                            <div v-if="errors.telefone">
                                {{ errors.telefone[0] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.cep }]">
                            <input type="text" v-model="paciente.cep" maxlength="9" v-mask="'#####-###'" class="form-control" placeholder="CEP"/>
                            <div v-if="errors.cep">
                                {{ errors.cep[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div :class="['form-group', {'has-error': errors.logradouro }]">
                            <input type="text" v-model="paciente.logradouro" class="form-control"
                                   placeholder="Avenida/Rua"/>
                            <div v-if="errors.logradouro">
                                {{ errors.logradouro[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.numero }]">
                            <input type="text" v-model="paciente.numero" class="form-control" placeholder="Número"/>
                            <div v-if="errors.numero">
                                {{ errors.numero[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.quadra }]">
                            <input type="text" v-model="paciente.quadra" class="form-control" placeholder="Quadra"/>
                            <div v-if="errors.quadra">
                                {{ errors.quadra[0] }}
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div :class="['form-group', {'has-error': errors.lote }]">
                            <input type="text" v-model="paciente.lote" class="form-control" placeholder="Lote"/>
                            <div v-if="errors.lote">
                                {{ errors.lote[0] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-3">
                        <div :class="['form-group', {'has-error': errors.complemento }]">
                            <input type="text" v-model="paciente.complemento" class="form-control"
                                   placeholder="Complemento"/>
                            <div v-if="errors.complemento">
                                {{ errors.complemento[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div :class="['form-group', {'has-error': errors.bairro }]">
                            <input type="text" v-model="paciente.bairro" class="form-control" placeholder="Bairro"/>
                            <div v-if="errors.bairro">
                                {{ errors.bairro[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div :class="['form-group', {'has-error': errors.cidade }]">
                            <input type="text" v-model="paciente.cidade" class="form-control" placeholder="Cidade"/>
                            <div v-if="errors.cidade">
                                {{ errors.cidade[0] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div :class="['form-group', {'has-error': errors.uf }]">
                            <input type="text" v-model="paciente.uf" class="form-control" placeholder="UF"/>
                            <div v-if="errors.uf">
                                {{ errors.uf[0] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 float-left align-content-md-center">
                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" :disabled="update ? !update : ''" class="btn btn-md btn-primary">Atualizar</button>
                        <button type="submit" :disabled="!update ? update : ''" class="btn btn-md btn-success">Salvar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 float-right" style="margin-left: -10px !important;">
                <div class="form-group">
                    <div class="col-md-6 float-right">
                        <input type="text" style="margin-left: 15px !important;" placeholder="Buscar..." class="form-control" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            update: {
                require: false,
                type: Boolean,
                default: false
            },
            paciente: {
                require: false,
                type: Object
                /*default: () => {
                    return {
                        id: '',
                        name: '',
                        description: '',
                        //image: '',
                        category_id: '',
                    }
                }*/
            }
        },
        data() {
            return {
                /*product: {
                    name: '',
                    description: ''
                },*/
                errors: {},
                upload: null,
                imagePreview: null,
            }
        },
        computed: {
            /*categories () {
                return this.$store.state.categories.items.data
            }*/
        },
        methods: {
            onSubmit() {
                let action = this.update ? 'updatePaciente' : 'storePaciente'
                let msg = this.update ? 'Atualizado' : 'Cadastrado'

                const formData = new FormData()

                if(this.upload != null)
                    formData.append('image', this.upload);

                formData.append('id', this.paciente.id);
                formData.append('cpf', this.paciente.cpf);
                formData.append('nome', this.paciente.nome);
                formData.append('rg', this.paciente.rg);
                formData.append('cartao_sus', this.paciente.cartao_sus);
                formData.append('sexo', this.paciente.sexo);
                formData.append('data_nasc', this.paciente.data_nasc);
                formData.append('nome_mae', this.paciente.nome_mae);
                formData.append('telefone', this.paciente.telefone);
                formData.append('cep', this.paciente.cep);
                formData.append('logradouro', this.paciente.logradouro);
                formData.append('numero', this.paciente.numero);
                formData.append('quadra', this.paciente.quadra);
                formData.append('lote', this.paciente.lote);
                formData.append('complemento', this.paciente.complemento);
                formData.append('bairro', this.paciente.bairro);
                formData.append('cidade', this.paciente.cidade);
                formData.append('uf', this.paciente.uf);

                this.$store.dispatch(action, formData)
                    .then(() => {
                        this.$snotify.success('Paciente Cadastro com Sucesso', 'Alerta de Sucesso', {
                            timeout: 10000,
                            showProgressBar: true,
                            closeOnClick: true,
                            pauseOnHover: false,
                            position: 'centerCenter',
                            buttons: [
                                {text: 'Ok', action: (toast) => {
                                    this.$snotify.remove(toast.id),
                                    this.reset()
                                }},
                            ]
                        })
                        //this.$emit('success')
                    })
                    .catch( (errors) => {
                        this.$snotify.error('O Paciente não pode ser ' + msg + '. Tente Novamente', 'Alerta de Erro', {
                            timeout: 10000,
                            showProgressBar: true,
                            closeOnClick: true,
                            pauseOnHover: false,
                            position: 'centerCenter',
                            buttons: [
                                {text: 'Ok', action: (toast) => {
                                    this.$snotify.remove(toast.id)
                                }},
                            ]
                        })
                        this.errors = errors.response.data.errors;
                    })
            },
            reset() {
                this.errors = {}
                this.imagePreview = null
                this.upload = null
                /*this.product = {
                    id: '',
                    name: '',
                    description: '',
                    category_id: '',
                }*/
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files

                //se não há arquivo retorna null
                if (!files.length) {
                    return
                }

                this.upload = files[0];
                this.previewImage(files[0])
            },
            previewImage(file) {
                let reader = new FileReader()
                reader.onload = (e) => {
                    this.imagePreview = e.target.result
                }

                reader.readAsDataURL(file)
            },

            removePreviewImage() {
                this.imagePreview = null
                this.upload = null
            }
        }
    }
</script>

<style scoped>
    .image-preview {
        max-width: 60px;
    }
</style>
