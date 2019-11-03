<template>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Module Product</h4>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Create a Product
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Product Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Product Name</label>
                                    <input type="text" class="form-control" v-model="fieldName">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" v-model="fieldDescription" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Price</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" class="form-control" v-model="fieldPrice">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Category</label>
                                    <select class="form-control" id="exampleFormControlSelect1" @change="onSelectCategory($event)">
                                        <option v-for="(cat, index) in listCat" :value="cat.cat_id" :key="index">{{ cat.cat_name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Images</label>
                                    <input type="file" class="form-control" ref="file" @change="onUploadImage()">
                                </div>  
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" @click="sendNetwordCreateProduct()">Save</button>
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
    data(){
        return {
            listCat : [],
            fieldName : '',
            fieldDescription: '',
            fieldPrice: '',
            fieldCategory: null,
            picFile: null
        }
    },
    mounted(){
        this.listCatService()
    },
    methods: {
        listCatService(){
            axios.get('api/category/list')
            .then(response => {
                //load data
                this.listCat = response.data
            })
            .catch(error => {
                alert(error)
            })
        },

        onSelectCategory(event){
            this.fieldCategory = event.target.value
        },

        onUploadImage(){
            this.picFile = this.$refs.file.files[0];
        },

        sendNetwordCreateProduct(){
            if(this.fieldName == ""){
                alert('complete the name field')
            }
            else if(this.fieldPrice == ""){
                alert('complete the price field')
            }
            else if(this.fieldCategory == 0){
                alert('select the category')
            }
            else{
                const formData = new FormData()
                formData.append('name', this.fieldName)
                formData.append('description', this.fieldDescription)
                formData.append('category', this.fieldCategory)
                formData.append('price',this.fieldPrice)

                //if its not null
                if(this.picFile){
                    formData.append('prod_image', this.picFile)
                }

                axios.post('api/product/create', formData)
                .then(response => {
                    //clean field
                    alert(response.data.message)
                })
                .catch(error => {
                    alert(error)
                })
            }
        }
    }
}
</script>