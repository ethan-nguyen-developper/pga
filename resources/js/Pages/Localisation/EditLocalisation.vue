<template>
    <div
        class="modal fade"
        id="EditModal"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="editModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h1
                        class="modal-title fs-5"
                        id="editModalLabel"
                    >
                        Edition d'une localisation
                        <span v-if="editLocalisation.ville">
                            "{{ editLocalisation.ville }}"
                        </span>
                    </h1>

                    <button
                        type="button"
                        class="btn-close"
                        aria-label="Fermer"
                        @click="closeModal"
                    ></button>
                </div>

                <div class="modal-body">
                    <form
                        id="editForm"
                        @submit.prevent="soumettre"
                    >
                        <div class="form-group">
                            <label for="editVille">
                                Ville
                            </label>

                            <input
                                id="editVille"
                                type="text"
                                class="form-control"
                                :class="{
                                    'is-invalid': villeError !== ''
                                }"
                                v-model="editLocalisation.ville"
                                required
                            >

                            <span
                                v-if="villeError !== ''"
                                class="invalid-feedback"
                            >
                                {{ villeError }}
                            </span>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-danger"
                        @click="closeModal"
                    >
                        Fermer
                    </button>

                    <button
                        form="editForm"
                        type="submit"
                        class="btn btn-success"
                        :disabled="processing"
                    >
                        {{ processing ? 'Modification...' : 'Soumettre' }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { Modal } from 'bootstrap'
import {
    ref,
    reactive,
    watch
} from 'vue'

import {
    useSwalSuccess,
    useSwalError
} from '../../Composables/alert'

const props = defineProps({
    localisation: {
        type: Object,
        default: null
    },

    show: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['close'])

const editLocalisation = reactive({
    id: '',
    ville: ''
})

const villeError = ref('')
const processing = ref(false)

const openModal = () => {
    const modalElement = document.getElementById('EditModal')

    if (!modalElement) {
        return
    }

    const modal = Modal.getOrCreateInstance(modalElement)

    modal.show()
}

const closeModal = () => {
    const modalElement = document.getElementById('EditModal')

    if (!modalElement) {
        return
    }

    // Retire le focus avant aria-hidden
    document.activeElement?.blur()

    const modal = Modal.getInstance(modalElement)

    if (modal) {
        modal.hide()
    }

    // Informe le parent que le modal est fermé
    emit('close')
}

const soumettre = () => {
    processing.value = true
    villeError.value = ''

    router.put(
        route('localisation.update', {
            localisation: editLocalisation.id
        }),
        {
            ville: editLocalisation.ville
        },
        {
            preserveScroll: true,

            onSuccess: () => {
                closeModal()

                useSwalSuccess(
                    'Localisation modifiée avec succès !'
                )
            },

            onError: (errors) => {
                villeError.value = errors.ville ?? ''

                useSwalError(
                    errors.ville ?? 'Une erreur est survenue.'
                )
            },

            onFinish: () => {
                processing.value = false
            }
        }
    )
}

watch(
    () => props.localisation,
    (localisation) => {
        if (localisation) {
            editLocalisation.id = localisation.id
            editLocalisation.ville = localisation.ville
            villeError.value = ''
        }
    },
    {
        immediate: true
    }
)

watch(
    () => props.show,
    (show) => {
        if (show) {
            openModal()
        } else {
            closeModal()
        }
    }
)
</script>