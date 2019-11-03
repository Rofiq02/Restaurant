<template>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-4 order-md-2 md-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Trolley</span>
                    <span class="badge badge-secondary badge-pill">{{ listTrolley.length }}</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Product</h6>
                            <small class="text-muted"></small>
                        </div>
                        <span class="text-muted">{{ listTrolley.length }}</span>
                    </li>
                    <li v-for="(itemCart, i) in listTrolley" :key="i" class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ itemCart.name }}</h6>
                            <small class="text-muted">={{ itemCart.category }}</small>
                        </div>

                        <div>
                            <div>
                                <i class="material-icons" @click="changeQty(i,false)">remove_circle_outline</i>
                                    <span class="text-muted">{{ itemCart.cant }}</span>
                                <i class="material-icons" @click="changeQty(i, true)">add_circle_outline</i>
                            </div>
                            <span class="text-muted">{{ convertMoney(itemCart.cant * itemCart.price) }}</span>
                        </div>

                        <i class="material-icons" @click="deleteItem(i)">delete</i>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>{{ onViewTotal() }}</strong>
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
                            <a href="#" class="btn btn-primary" @click="addCart(prod)">{{ convertMoney(prod.prod_price) }}</a>
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
            listTrolley: [],
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
        },
        convertMoney(value){
            const formatterUSD = new Intl.NumberFormat('es-CO',{
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 0
            })
            let valueFinal = formatterUSD.format(value);

            return valueFinal
        },

        addCart(item){
            const itemCart = {
                id : item.prod_id,
                name : item.prod_name,
                category: item.cat_name,
                cant: 1,
                price: item.prod_price
            }

            this.listTrolley.push(itemCart)
        },
        deleteItem(i){
            this.listTrolley.splice(i, 1)
        },
        changeQty(i, type){
            //take out cart
            const dataCart = this.listTrolley

            //take out amount of product
            let cantd = dataCart[i].cant;

            if(type){
                cantd += 1
            }
            else if(type == false && cantd>= 1){
                cantd -= 1
            }

            if((type == false && cantd>1) || type){
                dataCart[i].cant = cantd
                this.listTrolley
            }
        },
        onViewTotal(){
            let total = 0
            this.listTrolley.map((data) => {
                total = total + (data.cant * data.price)
            })

            return this.convertMoney(total)
        }
    }
}
</script>

<style scoped>
    i.material-icons{
        cursor: pointer;
    }
</style>