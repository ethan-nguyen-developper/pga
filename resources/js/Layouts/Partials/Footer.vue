
<template>
    <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">
            <Link
                :href="route('logout')"
                method="post"
                as="button"
                type="button"
                class="btn btn-link"
            >
                Déconnexion
            </Link>
        </div>

        <strong>
            Copyright © 2014-2026&nbsp;
            <a
                href="https://adminlte.io"
                class="text-decoration-none"
            >
                AdminLTE.io
            </a>.
        </strong>
        All rights reserved.
    </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
</script>
