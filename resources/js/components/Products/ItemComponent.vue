<template>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" :src="`${product.image}`" alt="Card image cap" width="286" height="180">
        <div class="card-body">
            <h5 class="card-title">{{ strLimit(product.title) }}</h5>
            <p class="card-text">
                {{ strLimit(product.description, 60) }}
            </p>
            <a :href="`products/${product.slug}`" class="btn btn-primary">Show Details</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "ItemComponent",
    props: {
        product: {
            type: Object,
            default: null
        },
    },
    data() {
        return {}
    },
    methods: {
        strLimit(str, length = 20) {
            return str.length > length ?
                str.substring(0, length) + '...' :
                str;
        }
    },
}
</script>

<style scoped>

</style>
