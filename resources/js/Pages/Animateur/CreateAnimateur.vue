<template>
  <!--begin::App Content-->
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">
                Ajout d'un étudiant
              </h3>
            </div>

            <div class="card-body">
              <form @submit.prevent="soumettre" id="formulaire">

                <div class="form-group">
                  <label for="">Nom :</label>

                  <input
                    required
                    type="text"
                    :class="{ 'is-invalid': form.errors.nom }"
                    class="form-control"
                    v-model="form.nom"
                  >

                  <span
                    v-if="form.errors.nom"
                    class="invalid-feedback error"
                  >
                    {{ form.errors.nom }}
                  </span>
                </div>


                <div class="form-group">
                  <label for="">Prénom :</label>

                  <input
                    required
                    type="text"
                    :class="{ 'is-invalid': form.errors.prenom }"
                    class="form-control"
                    v-model="form.prenom"
                  >

                  <span
                    v-if="form.errors.prenom"
                    class="invalid-feedback error"
                  >
                    {{ form.errors.prenom }}
                  </span>
                </div>


                <div class="form-group">
                  <label for="">Sexe</label>

                  <select
                    :class="{ 'is-invalid': form.errors.sexe }"
                    class="form-control"
                    v-model="form.sexe"
                  >
                    <option value=""></option>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                  </select>

                  <span
                    v-if="form.errors.sexe"
                    class="invalid-feedback error"
                  >
                    {{ form.errors.sexe }}
                  </span>
                </div>


                <div class="form-group">
                  <label for="">Âge :</label>

                  <input
                    required
                    type="number"
                    :class="{ 'is-invalid': form.errors.age }"
                    class="form-control"
                    v-model="form.age"
                  >

                  <span
                    v-if="form.errors.age"
                    class="invalid-feedback error"
                  >
                    {{ form.errors.age }}
                  </span>
                </div>


                <div class="form-group">
                  <label for="">Localisation</label>

                  <select
                    :class="{ 'is-invalid': form.errors.localisation_id }"
                    class="form-control"
                    v-model="form.localisation_id"
                  >
                    <option value=""></option>

                    <option
                      :value="loc.id"
                      :key="loc.id"
                      v-for="loc in props.localisations"
                    >
                      {{ loc.ville }}
                    </option>
                  </select>

                  <span
                    v-if="form.errors.localisation_id"
                    class="invalid-feedback error"
                  >
                    {{ form.errors.localisation_id }}
                  </span>
                </div>


                <div class="d-flex justify-content-between">
                  <div class="form-group">
                    <label for="">Photo :</label>

                    <input
                    :key="inputKey"
                      type="file"
                      accept="image/*"
                      class="form-control"
                      @input="previewImage($event)"
                    >
                  </div>

                  <div>
                    <img
                      src=""
                      alt=""
                      id="image-preview"
                      style="
                        width: 75px;
                        height: 75px;
                        border-radius: 25px;
                        display: none;
                      "
                    >
                  </div>
                </div>

              </form>
            </div>

            <div class="card-footer">
              <button
                type="submit"
                class="btn btn-success"
                form="formulaire"
              >
                Soumettre
              </button>
            </div>

          </div>
        </div>
        <!-- /.col -->
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import {
    useSwalSuccess,
    useSwalError
} from '../../Composables/alert'
import { ref } from 'vue'

const props = defineProps({
    localisations: Array
})

const inputKey = ref(0);

const form = useForm({
    nom: '',
    prenom: '',
    sexe: '',
    age: '',
    localisation_id: '',
    photo: null
})

const soumettre = () => {
    form.post(route('animateur.store'), {
        onSuccess: () => {
            useSwalSuccess('Animateur ajouté avec succès !')

            form.reset()

            inputKey.value += 1

            document.getElementById('image-preview').style.display = 'none'
        },

        onError: () => {
            useSwalError('Une erreur a été rencontrée')
        }
    })
}

const previewImage = (event) => {
    if (event.target.files.length > 0) {
        form.photo = event.target.files[0]

        const src = URL.createObjectURL(event.target.files[0])

        const previewImage = document.getElementById('image-preview')

        previewImage.src = src
        previewImage.style.display = 'block'
    }
}
</script>