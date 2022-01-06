<template>
<div>
    <slick v-if="banners" ref="slick" :options="slickOptions">
        <a v-for="(item, index) in banners" :key="index" v-bind:href="item.site" target="_blank">
            <img v-bind:src="item.file.path | assets" alt="Banner Amostra" class="img-fluid mx-2" />
        </a>
    </slick>
</div>
</template>

<script>
import Slick from "vue-slick";
Vue.use(Slick);

export default {
    data() {
        return {
            banners: null,
            slickOptions: {
                infinite: true,
                slideToShow: 15,
                slidesToScroll: 1,
                dots: false,
                speed: 500,
                autoplaySpeed: 1500,
                centerMode: false,
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
        };
    },

    components: {
        Slick
    },

    mounted() {
        axios.get("/api/ads/slide-logo").then(response => {
            this.banners = response.data;
        });
    },

    filters: {
        assets: function (value) {
            return "/" + value;
        }
    },

    // All slick methods can be used too, example here
    methods: {
        next() {
            this.$refs.slick.next();
        },

        prev() {
            this.$refs.slick.prev();
        },

        reInit() {
            // Helpful if you have to deal with v-for to update dynamic lists
            this.$nextTick(() => {
                this.$refs.slick.reSlick();
            });
        },

        // Events listeners
        handleAfterChange(event, slick, currentSlide) {
            console.log("handleAfterChange", event, slick, currentSlide);
        },
        handleBeforeChange(event, slick, currentSlide, nextSlide) {
            console.log("handleBeforeChange", event, slick, currentSlide, nextSlide);
        },
        handleBreakpoint(event, slick, breakpoint) {
            console.log("handleBreakpoint", event, slick, breakpoint);
        },
        handleDestroy(event, slick) {
            console.log("handleDestroy", event, slick);
        },
        handleEdge(event, slick, direction) {
            console.log("handleEdge", event, slick, direction);
        },
        handleInit(event, slick) {
            console.log("handleInit", event, slick);
        },
        handleReInit(event, slick) {
            console.log("handleReInit", event, slick);
        },
        handleSetPosition(event, slick) {
            console.log("handleSetPosition", event, slick);
        },
        handleSwipe(event, slick, direction) {
            console.log("handleSwipe", event, slick, direction);
        },
        handleLazyLoaded(event, slick, image, imageSource) {
            console.log("handleLazyLoaded", event, slick, image, imageSource);
        },
        handleLazeLoadError(event, slick, image, imageSource) {
            console.log("handleLazeLoadError", event, slick, image, imageSource);
        }
    }
};
</script>
