<template>
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Liste des localisations</h1>
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
                  <CreateLocalisation />
                </div>
                <div class="card-tools">
                  <Pagination
                    :links="props.localisations.links"
                    :prev="props.localisations.prev_page_url"
                    :next="props.localisations.next_page_url" />
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Localisations</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="localisation in props.localisations.data">
                      <td>{{localisation.ville}}</td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <button @click="openEditModal(localisation)" class="btn btn-info me-2">
                            <i class="fas fa-pencil"></i>
                          </button>
                          <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
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

  <EditLocalisation
    :localisation="editingLocalisation"
    :show="showModal"
    @close="showModal = false"
  />
</template>

<script setup>
  import Pagination from '../../Shared/Pagination.vue';
  import CreateLocalisation from './CreateLocalisation.vue';
  import EditLocalisation from './EditLocalisation.vue';

  import { ref } from 'vue';

  const props = defineProps({
    localisations: Object
  })

  const editingLocalisation = ref(null)
  const showModal = ref(false)

  const openEditModal = (localisation) => {
      editingLocalisation.value = localisation
      showModal.value = true
  }
</script>