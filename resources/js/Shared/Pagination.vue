<template>
    <ul class="pagination pagination-sm float-right">

        <!-- Bouton précédent -->
        <li
            class="page-item"
            :class="{ disabled: !props.prev }"
        >
            <Link
                v-if="props.prev"
                class="page-link"
                :href="props.prev"
            >
                «
            </Link>

            <span v-else class="page-link">
                «
            </span>
        </li>

        <!-- Numéros de pages uniquement -->
        <li
            v-for="(link, index) in pageLinks"
            :key="index"
            class="page-item"
            :class="{ active: link.active }"
        >
            <Link
                v-if="link.url"
                class="page-link"
                :href="link.url"
                v-html="link.label"
            />

            <span
                v-else
                class="page-link"
                v-html="link.label"
            />
        </li>

        <!-- Bouton suivant -->
        <li
            class="page-item"
            :class="{ disabled: !props.next }"
        >
            <Link
                v-if="props.next"
                class="page-link"
                :href="props.next"
            >
                »
            </Link>

            <span v-else class="page-link">
                »
            </span>
        </li>

    </ul>
</template>

<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    links: {
        type: Array,
        required: true,
    },
    prev: {
        type: String,
        default: null,
    },
    next: {
        type: String,
        default: null,
    },
})

const pageLinks = computed(() => {
    // Laravel met Previous au début et Next à la fin
    return props.links.slice(1, -1)
})
</script>