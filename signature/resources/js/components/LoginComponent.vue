<template>
    <v-row justify="center">
        <v-col cols="12" sm="10" md="8" lg="6">
            <v-card ref="form">
                <v-card-text>
                    <v-text-field
                        prepend-icon="mdi-account-circle"
                        ref="email"
                        v-model="email"
                        :rules="[() => !!email || 'This field is required']"
                        label="Email"
                        placeholder="Example@gmail.com"
                        required
                    ></v-text-field>
                    <v-text-field
                        prepend-icon="mdi-lock"
                        v-model="password"
                        :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                        :rules="[rules.required]"
                        :type="show ? 'text' : 'password'"
                        name="input-10-2"
                        label="Password"
                        placeholder="******"
                        class="input-group--focused"
                        @click:append="show = !show"
                    ></v-text-field>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" @click="entrar()">
                        Entrar
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
export default {
    name: "login",
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
