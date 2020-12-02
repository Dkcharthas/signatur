<template>
    <v-app>
        <v-navigation-drawer v-model="drawer" absolute temporary app clipped>
            <v-list>
                <v-list-item :to="{ path: '/inmuebles' }">
                    <v-list-item-action>
                        <v-icon>mdi-{{ icons[0] }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Inmuebles</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item :to="{ path: '/usuarios' }">
                    <v-list-item-action>
                        <v-icon>mdi-{{ icons[0] }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Usuarios</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-card class="mx-auto overflow-hidden" height="100%" width="100%">
            <v-system-bar color="deep-purple darken-3"></v-system-bar>
            <v-app-bar class="deep-purple accent-4 white--text">
                <v-app-bar-nav-icon
                    @click="drawer = true"
                    class="white--text"
                ></v-app-bar-nav-icon>
                <v-toolbar-title>
                    <v-list-item :to="{ path: '/' }">
                        <v-img
                            alt="Vuetify Logo"
                            class="shrink mr-2"
                            contain
                            src="https://cdn.vuetifyjs.com/images/logos/vuetify-logo-dark.png"
                            transition="scale-transition"
                            width="40"
                        />
                    </v-list-item>
                </v-toolbar-title>
                <v-card-actions class="px-3 pb-3">
                    <v-flex text-xs-right>
                        <v-btn
                            absolute
                            top
                            right
                            class="deep-purple accent-3 white--text "
                            ><i href="../../views/auth/login.blade.php"></i
                            >Login</v-btn
                        >
                    </v-flex>
                </v-card-actions>
                <v-card-actions class="px-3 pb-3">
                    <v-flex text-xs-right>
                        <v-btn
                            absolute
                            top
                            right
                            class="deep-purple accent-3 white--text "
                            ><i href="../../views/auth/register.blade.php"></i
                            >Registro</v-btn
                        >
                    </v-flex>
                </v-card-actions>
            </v-app-bar>
            <v-main>
                <v-container fluid>
                    <v-fade-transition mode="out-in">
                        <router-view></router-view>
                    </v-fade-transition>
                </v-container>
            </v-main>
        </v-card>
    </v-app>
</template>

<script>
export default {
    name: "App",
    data: () => ({
        drawer: false,
        icons: ["home"],
        email: "",
        show: false,
        password: "",
        editedItem: "",
        usuarios: "",
        rules: {
            required: value => !!value || "Required.",
            emailMatch: () => `The email and password you entered don't match`,
            email: value => {
                const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return pattern.test(value) || "Invalid e-mail.";
            }
        }
    }),

    methods: {
        entrar() {
            axios({
                method: "get",
                url: "usuarios",
                responseType: "stream"
            })
                .then(r => {
                    this.usuarios = r.data;
                    console.log(this.usuarios);
                    if (this.usuarios.email == this.email) {
                        console.log("Si se arma");
                    } else {
                        console.log("owo");
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
};
</script>
