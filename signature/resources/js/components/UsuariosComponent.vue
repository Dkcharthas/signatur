<template>
    <v-container>
        <!-- Tabla de departamentos -->

        <!--*************************** VENTANA DIALOG INICIO ****************************-->
        <v-spacer></v-spacer>
        <v-dialog v-model="dialogagregar" max-width="900px">
            <template v-slot:activator="{ on, attrs }">
                <v-row>
                    <v-col class="mb-1">
                        <v-btn
                            class="mx-2"
                            fab
                            dark
                            color="indigo"
                            v-bind="attrs"
                            v-on="on"
                        >
                            <v-icon dark>mdi-plus</v-icon>
                        </v-btn>
                    </v-col>
                </v-row>
            </template>
            <v-card>
                <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="editedItem.name"
                                    label="Nombre del usuario"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="editedItem.email"
                                    label="Email"
                                    :rules="[rules.required, rules.email]"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    :append-icon="
                                        show ? 'mdi-eye' : 'mdi-eye-off'
                                    "
                                    :rules="[rules.required, rules.min]"
                                    :type="show ? 'text' : 'password'"
                                    name="input-10-2"
                                    label="Not visible"
                                    hint="At least 8 characters"
                                    value=""
                                    class="input-group--focused"
                                    @click:append="show = !show"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">
                        Cancel
                    </v-btn>
                    <v-btn color="blue darken-1" text @click="save">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--*********************************** VENTANA DIALOG FIN ******************************* -->
        <v-row class="text-center">
            <v-col cols="12">
                <v-simple-table fixed-header class="elevation-3">
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-center"><b>Usuario</b></th>
                                <th class="text-center"><b>Email</b></th>
                                <th class="text-center">
                                    <b>Ultima conexion</b>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="usuario in usuarios" :key="usuario.id">
                                <td>{{ usuario.name }}</td>
                                <td>{{ usuario.email }}</td>
                                <td>{{ usuario.log }} Hoy a las 3:45 p.m.</td>
                                <td>
                                    <v-btn
                                        fab
                                        small
                                        color="primary"
                                        @click="editItem(usuario)"
                                        ><v-icon>mdi-pencil</v-icon></v-btn
                                    >
                                    <v-btn
                                        @click.stop="dialogcancelar = true"
                                        @click="id = usuario.id"
                                        fab
                                        small
                                        color="error"
                                        ><v-icon>mdi-delete</v-icon></v-btn
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-col>
        </v-row>

        <!-- Ventana de dialogo para eliminar registros -->
        <v-dialog v-model="dialogcancelar" max-width="350">
            <v-card>
                <v-card-title class="headline"
                    >¿Desea eliminar el registro?</v-card-title
                >
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="dialogcancelar = false">Cancelar</v-btn>
                    <v-btn @click="confirmarBorrado(id)" color="error"
                        >Aceptar</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-snackbar v-model="snackbar" color="success"
            >{{ textsnack }}
            <template v-slot:action="attrs">
                <v-btn text v-bind="attrs" @click="snackbar = false"></v-btn>
            </template>
        </v-snackbar>
    </v-container>
</template>

<script>
import axios from "axios";
export default {
    name: "usuarios",
    mounted() {
        this.obtenerusuarios();
    },
    data() {
        return {
            dialogagregar: false,
            dialogcancelar: false,
            usuarios: null,
            id: null,
            snackbar: false,
            textsnack: "¡Registro Eliminado!",
            nombre: "",
            email: "",
            email_verified_at: "",
            password: "",
            remeber_token: "",
            log: "",
            editedIndex: -1,
            editedItem: {},
            defaultItem: {},
            arreglo: ["Si", "No"],
            arreglo2: ["Disponible", "No disponible"],
            show: false,
            password: "Password",
            rules: {
                required: value => !!value || "Required.",
                counter: value => value.length <= 20 || "Max 20 characters",
                min: v => v.length >= 8 || "Min 8 characters",
                emailMatch: () =>
                    `The email and password you entered don't match`,
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return pattern.test(value) || "Invalid e-mail.";
                }
            }
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "Nuevo departamento"
                : "Editar departamento";
        }
    },

    watch: {
        dialogagregar(val) {
            val || this.close();
        }
    },

    methods: {
        obtenerusuarios() {
            axios({
                method: "get",
                url: "usuarios",
                responseType: "stream"
            })
                .then(r => {
                    this.usuarios = r.data;
                    console.log(this.usuarios);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        confirmarBorrado(id) {
            axios
                .delete("usuarios/" + id)
                .then(() => {
                    this.obtenerusuarios();
                    this.dialogagregar = false;
                    this.snackbar = true;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        editItem(item) {
            this.editedIndex = this.usuarios.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogagregar = true;
        },
        close() {
            this.dialogagregar = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.usuarios[this.editedIndex], this.editedItem);
                axios
                    .patch("usuarios/" + this.editedItem.id, {
                        nombre: this.editedItem.name,
                        email: this.editedItem.email,
                        password: this.editedItem.password
                    })
                    .then(response => {
                        console.log("data?: ", response.data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                axios
                    .post("usuarios/", {
                        nombre: this.editedItem.name,
                        email: this.editedItem.email,
                        password: this.editedItem.password
                    })
                    .then(response => {
                        this.usuarios.push({
                            nombre: response["data"]["name"],
                            email: response["data"]["email"],
                            password: response["data"]["password"]
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
            this.close();
        }
    }
};
</script>
