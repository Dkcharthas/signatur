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
                                    v-model="editedItem.nombre"
                                    label="Nombre del departamento"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" sm="6" md="4">
                                <v-select
                                    v-model="editedItem.balcon"
                                    :items="arreglo"
                                    label="Balcon"
                                    :rules="[rules.required]"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-select
                                    v-model="editedItem.estacionamiento"
                                    :items="arreglo"
                                    label="Estacionamiento"
                                    :rules="[rules.required]"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-select
                                    v-model="editedItem.lavado"
                                    :items="arreglo"
                                    label="Auto lavado"
                                    :rules="[rules.required]"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="editedItem.nhabitacion"
                                    label="Numero de habitaciones"
                                    type="number"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="editedItem.nbaño"
                                    label="Numero de baños"
                                    type="number"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="editedItem.ncama"
                                    label="Numero de camas"
                                    type="number"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-textarea
                                    v-model="editedItem.ubicacion"
                                    label="Ubicacion"
                                    auto-grow
                                    rows="2"
                                    :rules="[rules.required]"
                                ></v-textarea>
                            </v-col>
                            <v-col cols="12">
                                <v-textarea
                                    v-model="editedItem.area"
                                    label="Area"
                                    auto-grow
                                    rows="2"
                                    :rules="[rules.required]"
                                ></v-textarea>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-select
                                    :items="arreglo2"
                                    v-model="editedItem.estado"
                                    label="Estado"
                                    :rules="[rules.required]"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field
                                    v-model="editedItem.precio"
                                    label="Precio"
                                    prefix="$"
                                    placeholder="0.00"
                                    type="number"
                                    :rules="[rules.required]"
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
                                <th class="text-center">
                                    <b>Nombre</b>
                                </th>
                                <th class="text-center"><b>Ubicacion</b></th>
                                <th class="text-center"><b>Balcon</b></th>
                                <th class="text-center">
                                    <b>Estacionamiento</b>
                                </th>
                                <th class="text-center"><b>Auto lavado</b></th>
                                <th class="text-center"><b>Habitaciones</b></th>
                                <th class="text-center"><b>Baños</b></th>
                                <th class="text-center"><b>Camas</b></th>
                                <th class="text-center"><b>Area</b></th>
                                <th class="text-center"><b>Estado</b></th>
                                <th class="text-center"><b>Precio</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="inmueble in inmuebles"
                                :key="inmueble.id"
                            >
                                <td>{{ inmueble.nombre }}</td>
                                <td>{{ inmueble.ubicacion }}</td>
                                <td>{{ inmueble.balcon }}</td>
                                <td>{{ inmueble.estacionamiento }}</td>
                                <td>{{ inmueble.lavado }}</td>
                                <td>{{ inmueble.nhabitacion }}</td>
                                <td>{{ inmueble.nbaño }}</td>
                                <td>{{ inmueble.ncama }}</td>
                                <td>{{ inmueble.area }}</td>
                                <td>{{ inmueble.estado }}</td>
                                <td>${{ inmueble.precio }}</td>
                                <td>
                                    <v-btn
                                        fab
                                        small
                                        color="primary"
                                        @click="editItem(inmueble)"
                                        ><v-icon>mdi-pencil</v-icon></v-btn
                                    >
                                    <v-btn
                                        @click.stop="dialogcancelar = true"
                                        @click="id = inmueble.id"
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
    name: "inmuebles",
    mounted() {
        this.obtenerInmuebles();
    },
    data() {
        return {
            dialogagregar: false,
            dialogcancelar: false,
            inmuebles: null,
            id: null,
            snackbar: false,
            textsnack: "¡Registro Eliminado!",
            nombre: "",
            ubicacion: "",
            estado: "",
            precio: "",
            balcon: "",
            estacionamiento: "",
            lavado: "",
            nhabitacion: "",
            nbaño: "",
            ncama: "",
            area: "",
            imagen: "",
            imagenMiniatura: "",
            editedIndex: -1,
            editedItem: {},
            defaultItem: {},
            arreglo: ["Si", "No"],
            arreglo2: ["Disponible", "No disponible"],
            rules: {
                required: value => !!value || "Campo requerido"
            }
        };
    },

    computed: {
        formTitle() {
            return this.editedIndex === -1
                ? "Nuevo departamento"
                : "Editar departamento";
        },
        imagenn() {
            return this.imagenMiniatura;
        }
    },

    watch: {
        dialogagregar(val) {
            val || this.close();
        }
    },

    methods: {
        obtenerInmuebles() {
            axios({
                method: "get",
                url: "inmuebles",
                responseType: "stream"
            })
                .then(r => {
                    this.inmuebles = r.data;
                    console.log(this.inmuebles);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        cargarImagen(e) {
            var reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);

            reader.onload = e => {
                this.imagen = e.target.result;
            };
        },

        confirmarBorrado(id) {
            axios
                .delete("inmuebles/" + id)
                .then(() => {
                    this.obtenerInmuebles();
                    this.dialogagregar = false;
                    this.snackbar = true;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        editItem(item) {
            this.editedIndex = this.inmuebles.indexOf(item);
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
                Object.assign(
                    this.inmuebles[this.editedIndex],
                    this.editedItem
                );
                axios
                    .patch("inmuebles/" + this.editedItem.id, {
                        nombre: this.editedItem.nombre,
                        ubicacion: this.editedItem.ubicacion,
                        estado: this.editedItem.estado,
                        precio: this.editedItem.precio,
                        balcon: this.editedItem.balcon,
                        estacionamiento: this.editedItem.estacionamiento,
                        lavado: this.editedItem.lavado,
                        nhabitacion: this.editedItem.nhabitacion,
                        nbaño: this.editedItem.nbaño,
                        ncama: this.editedItem.ncama,
                        area: this.editedItem.area,
                        imagen: this.editedItem.imagen
                    })
                    .then(response => {
                        console.log("data?: ", response.data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                axios
                    .post("inmuebles/", {
                        nombre: this.editedItem.nombre,
                        ubicacion: this.editedItem.ubicacion,
                        estado: this.editedItem.estado,
                        precio: this.editedItem.precio,
                        balcon: this.editedItem.balcon,
                        estacionamiento: this.editedItem.estacionamiento,
                        lavado: this.editedItem.lavado,
                        nhabitacion: this.editedItem.nhabitacion,
                        nbaño: this.editedItem.nbaño,
                        ncama: this.editedItem.ncama,
                        area: this.editedItem.area,
                        imagen: this.editedItem.imagen
                    })
                    .then(response => {
                        this.inmuebles.push({
                            nombre: response["data"]["nombre"],
                            ubicacion: response["data"]["ubicacion"],
                            estado: response["data"]["estado"],
                            precio: response["data"]["precio"],
                            balcon: response["data"]["balcon"],
                            estacionamiento:
                                response["data"]["estacionamiento"],
                            lavado: response["data"]["lavado"],
                            nhabitacion: response["data"]["nhabitacion"],
                            nbaño: response["data"]["nbaño"],
                            ncama: response["data"]["ncama"],
                            area: response["data"]["area"]
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
