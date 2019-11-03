<template>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-4 order-md-2 md-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your Cart</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Product Name</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Second product</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Third item</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo Code</h6>
                            <small>Exmaple Code</small>
                        </div>
                        <span class="text-success">-$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$20</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Food And Drink</h4>
                <button type="button" class="btn btn-light" v-for="(cat,index) in listCat" :key="index" @click="selectCategory=cat.cat_id">{{ cat.cat_name }}</button>
                <hr>
                <div class="row">
                    <div class="card col-md-4" v-show="prod.prod_category == selectCategory || selectCategory == 0" style="padding: 0px;" v-for="(prod, index) in listProd" :key="index">
                        <img class="card-img-top" :src="prod.prod_image" alt="Card image cap">
                        <div class="card-body">
                                <h5 class="card-title">{{ prod.prod_name }}</h5>
                                <p class="card-text">{{ prod.prod_description }}</p>
                            <a href="#" class="btn btn-primary">{{ prod.prod_price }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            listProd: [],
            listCat: [],
            selectCategory: 0
        }
    },
    mounted(){
        this.listCatService()
        this.listProdService()
    },
    methods: {
        listCatService(){
            axios.get('api/category/available')
            .then(response => {
                //load data
                this.listCat = response.data
            })
            .catch(error => {
                alert(error)
            })
        },
        listProdService(){
            axios.get('api/product/visible')
            .then(response => {
                //load daata
                this.listProd = response.data
            })
            .catch(error => {
                alert(error)
            })
        }
    }
}
</script>