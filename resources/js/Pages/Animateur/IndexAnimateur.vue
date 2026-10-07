<template>
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Liste des animateurs</h1>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content Header-->
  <!--begin::App Content-->
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-12">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                  <button
                      type="button"
                      class="btn btn-primary"
                      data-bs-toggle="modal"
                      data-bs-target="#createNVModal"
                  >
                      <i class="fa fa-plus"></i>
                      Nouveau
                  </button>
                  <!-- <CreateAnimateur /> -->
                </div>
                <div class="card-tools">
                  <Pagination
                    :links="props.animateurs.links"
                    :prev="props.animateurs.prev_page_url"
                    :next="props.animateurs.next_page_url" />
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Animateurs</th>
                      <th>Localisation</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="animateur in props.animateurs.data" :key="animateur.id">
                        <td>
                            {{ animateur.nom }} {{ animateur.prenom }}
                        </td>

                        <td>
                            {{ animateur.localisation?.ville ?? 'Aucune localisation' }}
                        </td>

                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-info me-2">
                                    <i class="fas fa-pencil"></i>
                                </button>

                                <button class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->

  <!-- <EditAnimateur
    :animateur="editingAnimateur"
    :show="showModal"
    @close="showModal = false"
  /> -->
</template>

<script setup>
import Pagination from '../../Shared/Pagination.vue'
// import CreateAnimateur from './CreateAnimateur.vue'
// import EditAnimateur from './EditAnimateur.vue'

// import { router } from '@inertiajs/vue3'
// import { route } from 'ziggy-js'

// import {
//     useSwalConfirm,
//     useSwalError,
//     useSwalSuccess
// } from '../../Composables/alert.js'

// import { ref } from 'vue'

const props = defineProps({
    animateurs: Object
})

// const editingAnimateur = ref(null)
// const showModal = ref(false)

// const openEditModal = (animateur) => {
//     editingAnimateur.value = animateur
//     showModal.value = true
// }

// const deleteAnimateur = (id) => {
//     router.delete(
//         route('animateur.delete', {
//             animateur: id
//         }),
//         {
//             preserveScroll: true,

//             onSuccess: () => {
//                 useSwalSuccess(
//                     'Animateur supprimée avec succès !'
//                 )
//             },

//             onError: (errors) => {
//                 useSwalError(
//                     errors.message ??
//                     'Impossible de supprimer cette animateur.'
//                 )
//             }
//         }
//     )
// }

// const deleteConfirmation = (animateur) => {
//     const message =
//         `Vous êtes sur le point de supprimer "${animateur.nom}". Voulez-vous continuer ?`

//     useSwalConfirm(message, () => {
//         deleteLocalisation(animateur.id)
//     })
// }
</script>