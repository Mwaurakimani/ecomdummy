<template>
    <div class="loader">
        <slot></slot>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "loader",
    components:{
        Link
    }
}
</script>

<style scoped>

.loader{
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding-left: 30px;
}


</style>
