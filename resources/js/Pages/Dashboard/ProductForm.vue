<template>
    <nav>
        <div class="nav-buttons">
            <h1>Site 1</h1>
        </div>
        <div class="action-buttons">
            <a href="/">Home</a>
            <button @click="logout"> Log Out </button>
        </div>
    </nav>
    <div class="navigation-panel">
    </div>
    <h5 class="m-[30px]" style="font-size: 1.3em" >Products 1</h5>
    <loader>
        <Link :href="route('dashboard')" > Back to Products </Link>
    </loader>
    <div class="products-section">



        <div class="product-detail">
            <div class="image-section">
                <div class="image-display">
                    <img :src="product && product.file ? '/storage/ProductImages/'+product.file : '/storage/systemImages/default_product_image.png'" alt="">
                </div>
                <div class="input-group">
                    <label for="">Upload Image</label>
                    <input type="file" @input="form.file = $event.target.files[0]">
                </div>
            </div>
            <div class="product-description">
                <div class="input-group">
                    <label>Title</label>
                    <input type="text" v-model="form.title">
                </div>
                <div class="input-group">
                    <label>Description</label>
                    <textarea v-model="form.description">

                    </textarea>
                </div>
                <div class="input-group">
                    <label>Stock value</label>
                    <input type="number" v-model="form.stock">
                </div>
                <div class="price-value">
                    <div class="input-group">
                        <label>Price(Ksh)</label>
                        <input type="number" v-model="form.price">
                    </div>
                </div>
                <button v-if="!(product == null)" @click="update_product">Update</button>
                <button v-else @click="post_product">Create</button>
            </div>
        </div>
    </div>
</template>

<script>
import loader from "./loader.vue";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "ProductForm",
    components: {
        loader,
        Link
    },

    props:['product','test'],
    data() {
        return {
            form: this.$inertia.form({
                title: this.product != null ? this.product.title : null ,
                description: this.product != null ? this.product.description : null,
                stock: this.product != null ? this.product.stock : null,
                price: this.product != null ? this.product.price : null,
                file:null,
            }),
        }
    },
    methods:{
        post_product(){
            this.form.post(route('post_product'))
        },
        update_product(){

            console.log(this.form);

            this.form.post(route('put_product',this.product.id))
        }
    }
}
</script>

<style scoped lang="scss">

nav{
    display: flex;
    align-items: center;
    justify-content: space-between;
    .nav-buttons{
        width: 200px;
        height: 100%;
    }
    .action-buttons{
        margin-right: 20px;
        a,button{
            margin: 0px 10px;
            padding: 5px 15px;
            border-radius: 8px;
            &:hover{
                background-color: #04c204;
                color: white;
            }
        }
    }
}


.products-section{
    max-width: 1000px;
    padding: 10px;
    display: flex;
    height: fit-content;
    margin: auto;

    .product-detail{
        width: 100%;
        background-color: white;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        padding: 10px;
        .image-section{
            width: 300px;
            height: 300px;
            display: flex;
            border: 1px solid #e7e7e7;
            flex-direction: column;
            .image-display{
                margin: auto;
                justify-self: center;
                width: 180px;
                height: 180px;
                background-color: white;
            }
            .input-group{
                margin: auto;
                display: flex;
                align-items: center;
                justify-content: center;
                padding-left: 20px;
                input{
                    margin-top: 10px;
                    display: block;
                }
            }
        }
    }
    .product-description{
        width: calc(100% - 320px);
        height: fit-content;
        padding: 10px;
        .input-group{
            margin-bottom: 10px;
            width: 100%;
            padding-left: 10px;

            label{
                padding-top: 10px;
                width: 200px;
                font-weight: bolder;
            }
            input,textarea{
                width: 300px;
                height: 40px;
                border: 1px solid #e7e7e7;
            }
            textarea{
                height: 150px;
            }
        }

        button{
            display: block;
            margin: auto;
            margin-top: 20px;
            background-color: #04c204;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
        }
    }
}

</style>
