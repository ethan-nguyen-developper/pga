<template>
    <!-- Bouton pour ouvrir le modal -->
    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#createNVModal"
    >
        <i class="fa fa-plus"></i>
        Nouveau
    </button>

    <!-- Modal -->
    <div
        class="modal fade"
        id="createNVModal"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="createNVModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <h1
                        class="modal-title fs-5"
                        id="createNVModalLabel"
                    >
                        Ajout d'une localisation
                    </h1>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Fermer"
                        @click="resetForm"
                    ></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <form
                        id="createForm"
                        @submit.prevent="soumettre"
                    >
                        <div class="form-group">
                            <label for="ville">
                                Ville
                            </label>

                            <input
                                id="ville"
                                type="text"
                                class="form-control"
                                v-model="villeLocalisation"
                                required
                                autofocus
                            >
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-bs-dismiss="modal"
                        @click="resetForm"
                    >
                        Fermer
                    </button>

                    <button
                        form="createForm"
                        type="submit"
                        class="btn btn-success"
                        :disabled="processing"
                    >
                        <span
                            v-if="processing"
                            class="spinner-border spinner-border-sm me-1"
                        ></span>

                        {{ processing ? 'Enregistrement...' : 'Soumettre' }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { Modal } from 'bootstrap'
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
import { useSwalSuccess, useSwalError } from '../../Composables/alert'

const villeLocalisation = ref('')
const processing = ref(false)

const resetForm = () => {
    villeLocalisation.value = ''
}

const fermerModal = () => {
    const modalElement = document.getElementById('createNVModal')

    if (modalElement) {
        const modal = Modal.getInstance(modalElement)

        if (modal) {
            modal.hide()
        }
    }
}

const soumettre = () => {
    if (!villeLocalisation.value.trim()) {
        return
    }

    processing.value = true

    router.post(
        route('localisation.store'),
        {
            ville: villeLocalisation.value
        },
        {
            preserveScroll: true,

            onSuccess: () => {
                processing.value = false

                resetForm()
                fermerModal()

                useSwalSuccess('Localisation ajoutée avec succès!')
            },

            onError: (errors) => {
                processing.value = false

                console.log('Erreurs Laravel :', errors)

                useSwalError("Une erreur s'est produite")
            },

            onFinish: () => {
                processing.value = false
            },
        }
    )
}
</script>