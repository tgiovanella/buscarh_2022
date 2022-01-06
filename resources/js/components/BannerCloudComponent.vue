<template>
<div>
    <div v-if="banners">
        <div v-for="banner in banners" :key="banner.id" class="d-inline">
            <a v-bind:href="banner.site" target="_blank">
                <img v-bind:src="banner.file.path | assets" alt="Banner Amostra" class="img-fluid" />
            </a>
        </div>
    </div>
    <div v-else>
        <img src="https://via.placeholder.com/825x120?text=Anuncie+Aqui" alt="Banner Amostra" class="img-fluid" />
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            banners: null,
            info: null
        };
    },

    mounted() {
        axios.get("/api/ads/slide-cloud").then(response => {
            this.banners = response.data;
        });
    },

    filters: {
        assets: function (value) {
            return "/" + value;
        }
    }
};
</script>
