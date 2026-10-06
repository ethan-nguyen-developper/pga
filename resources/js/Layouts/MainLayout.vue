<template>
    <div class="app-wrapper">

        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-lte-toggle="sidebar"
                            href="#"
                            role="button"
                            aria-label="Toggle sidebar"
                        >
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

        <Menu />

        <main class="app-main">
            <slot />
        </main>

        <Footer />

    </div>
</template>

<script setup>
import Footer from './Partials/Footer.vue'
import Menu from './Partials/Menu.vue'
</script>