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
                      class="btn btn-primary mb-4"
                      data-bs-toggle="modal"
                      data-bs-target="#createNVModal"
                  >
                      <i class="fa fa-plus"></i>
                      Nouveau
                  </button>

                  <select
                      v-model="per_page"
                      @change="search"
                      class="form-control"
                  >
                      <option value="5">5</option>
                      <option value="10">10</option>
                      <option value="20">20</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                  </select>
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
                      <th>
                        <p>Animateurs</p>
                        <input @keyup="search" v-model="searchAnimateur" type="text" class="form-control">
                      </th>
                      <th>
                        <p>Localisation</p>
                        <select @change="search" v-model="filterLocalisation" name="" id="" class="form-control">
                          <option value=""></option>
                          <option :value="localisation.id" :key="localisation.id" v-for="localisation in props.localisations">
                            {{ localisation.ville }}
                          </option>
                        </select>
                      </th>
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
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import Pagination from '../../Shared/Pagination.vue'

const props = defineProps({
    animateurs: Object,
    localisations: Array,
    filtres: Object
})

const searchAnimateur = ref(props.filtres.search ?? '')
const filterLocalisation = ref(props.filtres.filter ?? '')
const per_page = ref(String(props.filtres.per_page ?? 5))

let timeout = null

const search = () => {
    clearTimeout(timeout)

    timeout = setTimeout(() => {
        router.get(
            route('animateur.index'),
            {
                search: searchAnimateur.value,
                filter: filterLocalisation.value,
                per_page: per_page.value
            },
            {
                replace: true,
                preserveState: true,
                preserveScroll: true
            }
        )
    }, 500)
}
</script>