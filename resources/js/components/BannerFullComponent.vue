<template>
<div>
    <slick v-if="banners" ref="slick" :options="slickOptions">
        <a v-for="(item, index) in banners" :key="index" v-bind:href="item.site" target="_blank">
            <img v-bind:src="item.file.path | assets" :alt="item.file_id" class="img-fluid" />
        </a>
    </slick>
</div>
</template>

<script>
import Slick from "vue-slick";
Vue.use(Slick);

export default {
    props: ["categoryId"],

    data() {
        return {
            banners: null,
            info: null,
            slickOptions: {
                infinite: true,
                slideToShow: 1,
                slidesToScroll: 1,
                dots: false,
                speed: 500,
                autoplaySpeed: 1500,
                centerMode: true,
                arrows: false,
                variableWidth: true,
                autoplay: true,
                breakpoint: 1024,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slideToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false,
                        variableWidth: false,
                        adaptiveHeight: true,
                        centerMode: true,
                        mobileFirst: true
                    }
                }]
            }
        }
    },

    components: {
        Slick
    },

    mounted() {
        let url = '';
        if (this.categoryId === undefined || this.categoryId == '') {
            url = '/api/ads/full';
        } else {
            url = '/api/ads/full/' + this.categoryId
        }

        axios
            .get(url)
            .then(response => {
                console.log('teste', response);
                this.banners = response.data;
            });

        console.log('============>>');
        console.log(this.banners);
        console.log('============');
    },

    filters: {
        assets: function (value) {
            return '/' + value;
        }
    }
}
</script>
