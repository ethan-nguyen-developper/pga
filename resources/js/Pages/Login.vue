<template>
    <main class="login-box">
      <h1 class="login-logo">
        <a href="../index2.html"><b>Admin</b>LTE</a>
      </h1>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form @submit.prevent="soumettre" >
            <div>
                <label class="visually-hidden" for="loginEmail">Email</label>
                <div class="input-group mb-3">
                <input
                    id="loginEmail"
                    name="email"
                    type="email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.email }"
                    placeholder="Email"
                />
                <div class="input-group-text">
                    <span class="bi bi-envelope"></span>
                </div>
                </div>
            </div>

            <span
            v-if="form.errors.email"
            class="invalid-feedback error"
            >
            {{ form.errors.email }}
            </span>
            
            <label class="visually-hidden" for="loginPassword">Password</label>
            <div class="input-group mb-3">
              <input
                    id="loginPassword"
                    name="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.password }"
                    placeholder="Password"
              />
              <div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
              </div>
            </div>
            <div style="width: 100%;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Connexion</button>
            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </main>
</template>

<script>
import AuthLayout from '../Layouts/AuthLayout.vue';

    export default {
        layout: AuthLayout
    }
</script>


<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AuthLayout from '../Layouts/AuthLayout.vue'
import { useSwalError } from '../Composables/alert.js'

defineOptions({
    layout: AuthLayout,
})

const form = useForm({
    email: '',
    password: '',
})

const soumettre = () => {
    form.post(route('login.post'), {
        onError: () => {
            useSwalError(
                form.errors.email ?? 'Une erreur est survenue. Veuillez réessayer.'
            )
        },
    })
}
</script>
