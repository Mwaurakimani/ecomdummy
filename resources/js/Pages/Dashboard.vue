<template>
    <nav>
        <div class="nav-buttons">
            <h1>Site 1</h1>
        </div>
        <div class="action-buttons">
            <a href="/">Home</a>
            <button @click="logout"> Log Out</button>
        </div>
    </nav>
    <div class="navigation-panel">
    </div>
    <h5 class="m-[30px]" style="font-size: 1.3em">Products</h5>
    <loader>
        <Link :href="route('create_products')">Create a Product</Link>
    </loader>

    <div v-if="products.length > 0" class="products-section">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Thumb</th>
                <th scope="col">Product Name</th>
                <th scope="col">Stock Quantity</th>
            </tr>
            </thead>
            <tbody>
            <Link v-for="(product,index) in products" as="tr" :href="'/products/'+product.id">
                <th scope="row"> {{ index + 1 }}</th>
                <td style="overflow: hidden">
                    <div class="image-display flex items-center justify-center w-[70px] h-[70px] p-[1px]">
                        <img :src=" product.file ? '/storage/ProductImages/'+product.file : '/storage/systemImages/default_product_image.png' " alt="">
                    </div>
                </td>
                <td> {{ product.title }}</td>
                <td> {{ product.stock }}</td>
            </Link>
            </tbody>
        </table>
    </div>

    <div v-else class="products-section w-[100%] h-[100px] flex items-center justify-center">
        <p style="font-size: 1.4em">No products found</p>
        <Link :href="route('create_products')" class="ml-[50px]"
              style="padding: 10px 20px;background-color: #04c204;color: white">Create
        </Link>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import loader from "./Dashboard/loader.vue";

export default {
    name: "Dashboard",
    props: ['products'],
    components: {
        Link,
        loader
    },
    methods: {
        logout() {
            axios.post('logout').then(() => {
                    window.location.href = '/'
                }
            )
        }
    }
}
</script>

<style lang="scss">

nav {
    display: flex;
    align-items: center;
    justify-content: space-between;

    .nav-buttons {
        width: 200px;
        height: 100%;
    }

    .action-buttons {
        margin-right: 20px;

        a, button {
            margin: 0px 10px;
            padding: 5px 15px;
            border-radius: 8px;

            &:hover {
                background-color: #04c204;
                color: white;
            }
        }
    }
}

h1 {
    font-size: 2em;
    padding-left: 50px;
    font-weight: 600;
    font-style: italic;
    color: var(--theme-color-primary);
}

.navigation-panel {
    width: 100%;
    height: 80px;
    background-color: white;
    display: flex;
    align-items: center;

    a {

    }
}

.products-section {
    width: 1000px;
    height: 800px;
    margin: auto;
    background-color: white;

    thead {
        background-color: #04c204;
        color: white;
    }

    tbody {
        tr {
            &:hover {
                cursor: pointer;
                background-color: #6fee6f;
                color: white;
            }
        }
    }
}


</style>
