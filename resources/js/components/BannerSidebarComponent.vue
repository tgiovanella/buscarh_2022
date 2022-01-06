<template>
<div>
    <div v-if="banners">
        <ul id="listaBannerDireita" class="row" v-for="banner in banners" :key="banner.id">
            <li class="col-6 col-sm-6 col-md-12 col-lg-12 col-xl-12">
                <a v-bind:href="banner.site" target="_blank">
                    <img v-bind:src="banner.file.path | assets" alt="Banner Amostra" class="img-fluid w-100" />
                </a>
            </li>
        </ul>
    </div>
    <div v-else>
        <img src="https://via.placeholder.com/300x300?text=Anuncie+Aqui" alt="Banner Amostra" class="img-fluid" />
    </div>

    <p style="color: transparent">{{ categoryId }}</p>

</div>
</template>

<script>
export default {
    props: ["categoryId"],

    data() {
        return {
            banners: null,
            info: null
        };
    },

    mounted() {
        axios.get("/api/ads/slide-sidebar/" + this.categoryId).then(response => {
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
