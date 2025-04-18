<template>
  <div>
    <BCard
      title="Sign In"
      img-src="https://picsum.photos/id/25/600/300"
      img-alt="Login-Image"
      img-top
      tag="article"
      style="max-width: 25rem"
      class="mx-auto my-auto text-left d-flex align-center justify-center login-card"
    >
      <BForm @submit.prevent="loginUser()">
        <BCardText class="align-right mt-4">
          <BFormInput
            id="input-1"
            v-model="email"
            type="email"
            placeholder="Enter email"
            class="login-input px-2"
            required
            autofocus
          />
          <span class="text-red-700 font-bold error-msg" v-if="validationErrors?.email">{{ validationErrors.email[0] }}</span>          

          <BInputGroup class="mt-3">
            <template #append>
              <BInputGroupText class="pass-append">
                <i id="forgot-pass-eye" :class="showPassword === false ? 'bi bi-eye-slash' : 'bi bi-eye-fill'" @click="togglePassword()"></i>
              </BInputGroupText>
            </template>
            <BFormInput
              id="input-2"
              v-model="password"
              :type="showPassword === false ? 'password' : 'text'"
              placeholder="Enter password"
              class="login-input px-2"
              required
            />
          </BInputGroup>
          <span class="text-red-700 font-bold error-msg" v-if="validationErrors?.password">{{ validationErrors.password[0] }}</span>
        </BCardText>

        <div class="row mx-0 d-flex" v-if="loginError">
          <span class="col-12 text-center invalid-login-text">Invalid login credentials provided</span>
        </div>
        <div class="col-12 px-0 text-center align-items-center justify-content-center mt-3">
          <BButton class="col-8" pill variant="primary" type="submit" v-if="!requestProcessing">Sign In</BButton>
          <BButton class="col-8" pill variant="primary" v-else :disabled="true">Processing...</BButton>
        </div>
        <span class="col-12 px-0 justify-content-center d-flex my-2 or-span">or</span>
        <div class="col-12 px-0 text-center">
          <BButton class="col-6" type="button" pill variant="outline-secondary" @click="goToRegistration()">Register</BButton>
        </div>
      </BForm>
    </BCard>
  </div>
</template>

<script>
import { BButton, BForm, BFormGroup, BFormInput, BInputGroup, BInputGroupText } from 'bootstrap-vue-next';
import { useAuthStore } from '../../stores/auth/auth'
import { useToast } from "vue-toastification";

export default {
  name: "Login",
  setup() {
    const authStore = useAuthStore()
    return { authStore }
  },
  data() {
    return {
      email: null,
      password: null,
      requestProcessing: false,
      validationErrors: null,
      loginError: null,
      showPassword: false
    }
  },
  methods: {
    loginUser() {
      this.errors = null
      this.requestProcessing = true

      this.authStore.login({
        email: this.email,
        password: this.password
      }).then(response => {
        this.requestProcessing = false
        
      }, this).catch(error => {
        if (error.status === 422) {
          this.validationErrors = error.response.data.errors
        }

        if (error.status === 401) {
          this.loginError = error.response?.data?.message
          //useToast().error(this.loginError)
        }
      })
    },
    togglePassword() {
      this.showPassword = !this.showPassword
    },
    goToRegistration() {
      this.$router.push({path: '/register'})
    }
  }
};
</script>
  
<style scoped>

h2 {
  color: #42b983;
}

.login-input {
  border-radius: 0px;
  padding-left: 5px;
  color: rgb(90, 90, 90) !important;
  height: 3rem;
  border: 0px 0px 1px 1px gray solid;
}

.error-msg {
  color: red !important;
}

.forgot-password {
  color: rgb(0, 174, 255) !important;
  cursor: pointer !important;
  font-size: 14px;
  font-weight: 600 !important;
}

.forgot-password:hover {
  text-decoration: underline;
}

.new-account-text {
  cursor: pointer !important;
}

.new-account-text:hover {
  text-decoration: underline;
}

.or-span {
  padding-left: 10px;
}

.or-span::before, .or-span::after {
  content: "";
  flex: 1 1;
  margin: auto;
}

.or-span::after, .or-span::before {
  border-bottom: 1px #8080806b solid;
  margin-right: 10px;
  margin-left: 10px;
}

.invalid-login-text {
  color: red;
  font-size: 12px;
  font-weight: 600;
}

.card-body > h4 {
  font-size: 30px !important;
}

.login-card {
  box-shadow: 3px 3px 3px rgba(201, 201, 201, 0.438);
}

#forgot-pass-eye {
  color: rgb(0, 121, 177) !important;
  font-size: 20px;
}

.pass-append {
  height: 3rem;
}
</style>
  