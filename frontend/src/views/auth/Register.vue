<template>
  <div>
    <BCard
      title="Create an account"
      img-src="https://picsum.photos/id/25/600/300"
      img-alt="Register-Image"
      img-top
      tag="article"
      style="max-width: 30rem"
      class="mx-auto my-auto text-left d-flex align-center justify-center register-card"
    >
      <BForm @submit.prevent="registerUser()">
        <BCardText class="align-right mt-4">
          <BInputGroup class="mt-3">
            <BFormInput
              id="input-first"
              v-model="firstName"
              placeholder="First Name"
              class="register-input px-2"
            />
            <BFormInput
              id="input-last"
              v-model="lastName"
              type="text"
              placeholder="Last Name"
              class="register-input px-2"
            />
          </BInputGroup>
          <BFormInput
            id="input-username"
            v-model="username"
            type="text"
            placeholder="Username"
            class="register-input px-2 mt-3"
            required
          />
          <BFormInput
            id="input-1"
            v-model="email"
            type="email"
            placeholder="Enter email"
            class="register-input px-2 mt-3"
            required
          />
          <span class="text-red-700 font-bold error-msg" v-if="validationErrors?.email">
            <span class="col-12 px-0" v-for="error in validationErrors.email">{{ error }}</span>
          </span>       

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
              class="register-input px-2"
              required
            />
          </BInputGroup>
          <BFormInput
            id="input-3"
            v-model="confirmPassword"
            type="password"
            placeholder="Confirm password"
            class="register-input px-2 mt-3"
            required
          />
          <span class="text-red-700 font-bold error-msg" v-if="validationErrors?.password">
            <span class="col-12 px-0" v-for="error in validationErrors.password">{{ error }}</span>
          </span>
          <BFormInput
            id="input-phone"
            v-model="phoneNumber"
            type="text"
            placeholder="Phone"
            class="register-input px-2 mt-3"
            required
          />
        </BCardText>
        <ValidationErrors :errors="validationErrors"/>
        <div class="col-12 px-0 text-center align-items-center justify-content-center mt-3">
          <BButton class="col-8" pill variant="primary" type="submit" v-if="!requestProcessing">Register</BButton>
          <BButton class="col-8" pill variant="primary" v-else :disabled="true">Processing...</BButton>
        </div>
        <div class="col-12 px-0 text-center mt-2">
          <span>Already have an account? <span class="login-here-text" @click="goToLogin()">Login here</span></span>
        </div>
      </BForm>
    </BCard>
  </div>
</template>

<script>
import { BButton, BForm, BFormGroup, BFormInput, BInputGroup, BInputGroupText } from 'bootstrap-vue-next';
import { useAuthStore } from '../../stores/auth/auth'
import { useToast } from "vue-toastification";

import ValidationErrors from "../../components/Helpers/ValidationErrors.vue";

export default {
  name: "Register",
  setup() {
    const authStore = useAuthStore()
    return { authStore }
  },
  components: {
    ValidationErrors
  },
  data() {
    return {
      username: null,
      firstName: null,
      lastName: null,
      email: null,
      password: null,
      phoneNumber: null,
      requestProcessing: false,
      validationErrors: null,
      loginError: null,
      showPassword: false
    }
  },
  methods: {
    registerUser() {
      this.errors = null
      this.requestProcessing = true
      this.validationErrors = null

      this.authStore.register({
        username: this.username,
        email: this.email,
        password: this.password,
        c_password: this.confirmPassword,
        first_name: this.firstName,
        last_name: this.lastName,
        phone: this.phoneNumber
      }).then(response => {
        this.requestProcessing = false
        
        if(response.errors) {
          this.validationErrors = response.errors
        }
      }, this).catch(error => {
        if (error.status === 401) {
          this.loginError = error.response?.data?.message
          useToast().error(this.loginError)
        }
      })
    },
    togglePassword() {
      this.showPassword = !this.showPassword
    },
    goToLogin() {
      this.$router.push({path: '/login'})
    }
  }
};
</script>
  
<style scoped>

h2 {
  color: #42b983;
}

.register-input {
  border-radius: 0px;
  padding-left: 5px;
  color: rgb(90, 90, 90) !important;
  height: 3rem;
  border: 0px 0px 1px 1px gray solid;
}

.error-msg {
  color: red !important;
}

.new-account-text {
  cursor: pointer !important;
}

.new-account-text:hover {
  text-decoration: underline;
}

.card-body > h4 {
  font-size: 30px !important;
}

.register-card {
  box-shadow: 3px 3px 3px rgba(201, 201, 201, 0.438);
}

#forgot-pass-eye {
  color: rgb(0, 121, 177) !important;
  font-size: 20px;
}

.pass-append {
  height: 3rem;
}

.login-here-text {
  color: rgb(0, 102, 255) !important;
  cursor: pointer !important;
  font-size: 16px;
  font-weight: 600 !important;
}

.login-here-text:hover {
  text-decoration: underline;
}
</style>
  