<template>
<v-app id="login">
    <notifier :alert="alert"></notifier>
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Dashboard Login</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-tooltip bottom>
                  <v-btn icon large :href="'/'" target="_blank" slot="activator">
                    <v-img :src="`/imgs/logo.png`" max-width="64"></v-img>
                  </v-btn>
                  <span>Source</span>
                </v-tooltip>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field prepend-icon="person" v-model="form.username" name="login" label="Username" type="text"></v-text-field>
                  <v-text-field prepend-icon="lock" v-model="form.password" name="password" label="Password" id="password" type="password"></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click.stop="authenticate">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  import { login } from '../../helpers/auth';
  import Alert from '../_templates/notification/Alert'

  export default {
    name: "login",
    components: {
      'notifier': Alert
    },
    data() {
      return {
        error: null,
        form: {
          username: '',
          password: ''
        },
        alert: {
          isActive: false,
          type: 'error',
          content: ''
        },
      };
    },

    methods: {
      authenticate() {
        this.$store.dispatch('DO_LOGIN');

        login(this.$data.form)
          .then((res) => {
            this.$store.commit("LOGIN_SUCCESS", res);
            this.$router.push({path: '/'});
          })
          .catch((error) => {
            this.$store.commit('LOGIN_FAILED', {error});
            this.alert.isActive = true
            this.alert.content = this.authError
          })
      }
    },

    computed: {
      authError() {
        return this.$store.getters.authError;
      }
    }

  }
</script>
