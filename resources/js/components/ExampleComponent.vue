<template>
    <div class="container">
        <navbarVue></navbarVue>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import navbarVue from './navbar.vue';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            navbarVue
        }
    }
</script>
