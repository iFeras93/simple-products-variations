<template>
    <div class="row">
        <div class="col-lg-4 mb-4" v-for="(product,index) in productsArray" :key="index">
            <Item-Component :product="product"></Item-Component>
        </div>
    </div>
</template>

<script>
export default {
    name: "ListComponent",
    props: {
        productsArray: {
            type: Array,
            default: [],
        },
    },
}
</script>

<style scoped>

</style>
