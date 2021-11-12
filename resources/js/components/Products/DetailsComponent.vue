<template>
    <div class="super_container">
        <div class="single_product">
            <div class="container-fluid" style=" background-color: #fff; padding: 11px;">
                <div class="row">
                    <div class="col-lg-4 order-lg-2 order-1">
                        <div class="image_selected"><img :src="`/${detailsObject.image}`" alt="" ref="bigImage"></div>
                    </div>
                    <div class="col-lg-6 order-3">
                        <div class="product_description">

                            <div class="product_name">
                                {{ detailsObject.title }}

                                <hr>
                                <!--                                {{ selectedData }}-->
                                <!--                                {{ availableData }}-->
                            </div>
                            <div><span class="product_price">$ {{ detailsObject.price }}</span></div>
                            <hr class="singleline">
                            <div>
                                <span class="product_info">
                                    {{ detailsObject.description }}
                                </span>
                            </div>
                            <div>
                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-12 mb-3" style="margin-left: 15px;"
                                         v-if="detailsObject.extra_data.color.length > 0">
                                        <span class="product_options">Color Options</span><br>
                                        <span v-for="(value,index) in detailsObject.extra_data.color" :key="index">
                                            <img :src="`http://localhost:8000/${value.image}`" alt="" width="50"
                                            >
                                             <button class="btn btn-primary btn-sm mr-1"
                                                     @click="setSelectedColor(value)">
                                            {{ value.title }}
                                             </button>
                                        </span>

                                    </div>

                                    <div class="col-12 mb-3" style="margin-left: 15px;"
                                         v-if="detailsObject.extra_data.sizes.length > 0">
                                        <span class="product_options">Sizes Options</span><br>
                                        <button class="btn btn-primary btn-sm mr-1"
                                                v-for="(size,index) in detailsObject.extra_data.sizes" :key="index"
                                                @click="setSelectSize(size)">
                                            {{ size.title }}
                                        </button>
                                    </div>

                                    <div class="col-12 mb-3" style="margin-left: 15px;"
                                         v-if="detailsObject.extra_data.types.length > 0">
                                        <span class="product_options">Types Options</span><br>
                                        <span v-for="(value,index) in detailsObject.extra_data.types" :key="index">
                                            <img :src="`http://localhost:8000/${value.image}`" alt="" width="50">
                                             <button class="btn btn-primary btn-sm mr-1" @click="setSelectType(value)">
                                            {{ value.title }}
                                             </button>
                                        </span>
                                    </div>

                                    <div class="col-12 mb-3" style="margin-left: 15px;"
                                         v-if="detailsObject.extra_data.texts.length > 0">
                                        <span class="product_options">Additional Information</span><br>
                                        <ul>
                                            <li v-for="(text,index) in detailsObject.extra_data.texts.length">
                                                {{ text.title }} : {{ text.description }}
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <hr class="singleline">
                            <div class="order_info d-flex flex-row">
                                <form action="#"></form>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    Selected Options:
                                    <!--                                    {{ availableData }}-->
                                    <p v-if="selectedData.color">Color: {{ selectedData.color.title }}</p>
                                    <p v-if="selectedData.size">Size: {{ selectedData.size.title }}</p>
                                    <p v-if="selectedData.type">Type: {{ selectedData.type.title }}</p>
                                </div>
                                <div class="col-12" v-if="userDetails !==null">
                                    <div class="alert alert-danger" role="alert" v-if="errorMessage">
                                        {{ errorMessage }}
                                    </div>
                                    <button type="button" class="btn btn-success  btn-block" @click="makeOrder">
                                        Buy Now
                                    </button>
                                </div>
                                <div class="col-12" v-else>
                                    Login to buy product
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DetailsComponent",
    props: {
        detailsObject: {
            type: Object,
            default: null
        },

        userDetails: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            selectedData: {
                color: null,
                size: null,
                type: null,
            },
            availableData: {
                color: false,
                size: false,
                type: false,
            },
            enableBuyBtn: false,
            errorMessage: '',
        }
    },
    mounted() {
        // console.log(window.origin)
        // console.log(process.env.MIX_PUSHER_APP_KEY)
        this.availableData.color = (this.detailsObject.extra_data.color.length > 0) ? true : false
        this.availableData.size = (this.detailsObject.extra_data.sizes.length > 0) ? true : false
        this.availableData.type = (this.detailsObject.extra_data.types.length > 0) ? true : false
    },
    methods: {
        setActiveOption(selectedValue = {}, option = 'color') {
            return ((this.selectedData[option] !== null) && (this.selectedData[option] !== selectedValue))
        },
        setSelectedColor(value) {
            this.selectedData.color = value
            if ('image' in value) {
                // console.log(this.$refs.colorImage)
                this.$refs.bigImage.src = window.origin+'/'+value.image
            }
        },
        setSelectSize(value) {
            this.selectedData.size = value
        },
        setSelectType(value) {
            this.selectedData.type = value
            if ('image' in value) {
                // console.log(this.$refs.colorImage)
                this.$refs.bigImage.src = window.origin+'/'+value.image
            }
        },
        makeOrder() {
            if (this.availableData.color === true && this.selectedData.color === null) {
                alert('please select Color')
                return;
            }
            if (this.availableData.size === true && this.selectedData.size === null) {
                alert('please select Size')
                return;
            }
            if (this.availableData.type === true && this.selectedData.type === null) {
                alert('please select Type')
                return;
            }
            let date = {
                product: this.detailsObject,
                variations: this.selectedData,
                user_id: this.userDetails.id
            }
            this.errorMessage = ''
            window.axios.post(`${window.origin}/api/v1/order`, date).then(({data}) => {
                console.log(data)
                alert('your order submitted successfully')
                location.href = window.origin + '/my-orders'
            }).catch(({response}) => {
                console.log(response)
                this.errorMessage = response.data.message
            })
        },
    },
    watch: {},
}
</script>

<style scoped>

</style>
