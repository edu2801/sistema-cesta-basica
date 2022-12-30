<template>
    <v-app>
        <div class="col-12">
            <div class="mx-5 d-flex justify-content-between align-items-center">
                <h1 class="page-title">Gerenciamento de usuários</h1>
                <a href="/users/create" class="d-block btn btn-primary btn-icon text-white me-2">
                    <span>
                        <i class="fe fe-plus"></i>
                    </span> Adicionar
                </a>
            </div>

            <v-data-table :headers="columns" :items="dataTable">
                <template v-slot:item.status="{ item }">
                    <span v-if="item.status == 1" class="badge bg-success">Ativo</span>
                    <span v-else-if="(item.status == 2)" class="badge bg-danger">Bloqueado</span>
                    <span v-else class="badge bg-warning">Inativo</span>
                </template>
                <template v-slot:item.expiration_date="{ item }">
                    {{ item.expiration_date.split('-').reverse().join('/') }}
                </template>
                <template v-slot:item.actions="{ item }">
                    <td class="d-flex justify-content-center" style="font-size: 20px;">
                        <a :href="('/users/edit/' + item.id)" class="icons-table my-auto text-primary me-1"
                            title="Editar">
                            <i class="side-menu__icon fa fa-pencil"></i>
                        </a>
                        <a class="icons-table text-danger my-auto" style="cursor: pointer;" title="Excluir"
                            data-bs-target="#modalDelete" data-bs-toggle="modal" @click="setDeleteId(item.id)">
                            <i class="side-menu__icon fa fa-trash"></i>
                        </a>
                    </td>
                </template>
            </v-data-table>

            <div class="modal fade" id="modalDelete">
                <div class="modal-dialog modal-dialog-centered text-center " role="document">
                    <div class="modal-content tx-size-sm">
                        <div class="modal-body text-center p-4">
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                                    aria-hidden="true">&times;</span></button>
                            <i class="fe fe-x-square fs-100 text-danger lh-1 mb-5 d-inline-block"></i>
                            <h4 class="text-danger tx-semibold">Você realmente deseja excluir?</h4>
                            <p class="mg-b-20 mg-x-20">Ao prosseguir esse usuário será removido.</p>
                            <button class="btn btn-danger pd-x-25" data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success pd-x-25" data-bs-dismiss="modal"
                                @click="deleteItem()">Prosseguir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
import axios from 'axios';

export default {
    name: 'index',
    props: {
        data: {
            default: () => []
        }
    },
    data() {
        return {
            columns: [
                { text: "#", value: "id", 'align': 'center' },
                { text: "Nome", value: "name", 'align': 'center' },
                { text: "E-mail", value: "email", 'align': 'center' },
                { text: "Telefone", value: "phone", 'align': 'center' },
                { text: "Status", value: "status" },
                // { text: "Data de compra", value: "purchase_date", 'align': 'center' },
                { text: "Data de expiração", value: "expiration_date", 'align': 'center' },
                { text: "Ações", value: "actions", 'align': 'center' },
            ],
            dataTable: JSON.parse(this.data),
            deleteId: null
        }
    },
    methods: {
        setDeleteId(id) {
            this.deleteId = id;
        },
        deleteItem() {
            axios.get("/users/delete/" + this.deleteId)
                .then(response => {
                    this.dataTable = this.dataTable.filter(item => item.id !== this.deleteId);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
}
</script>