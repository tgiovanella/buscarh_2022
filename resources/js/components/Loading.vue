<template>
<div>
    <div class="text-center" id="loader" v-if="$wait.any">
        <div class="spinner-border mt-5" style="" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <p class="text-center">Aguarde...</p>
    </div>
</div>
</template>

<script>
export default {};
</script>

<style></style>
