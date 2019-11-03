<template>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Module Category {{ nameCat }}</h4>

                <div class="input-group md-3">
                    <input type="text" class="form-control" v-model="nameCat" placeholder="Category Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" @click="addCategory()">Add</button>
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data,index) in listCat" :key="index">
                            <td>{{ index+1 }}</td>
                            <td>{{ data.cat_name }}</td>
                            <td>
                                <button type="button" class="btn btn-info" v-if="data.cat_active==1" @click="updateStatus(data.cat_id,0)">Active</button>
                                <button type="button" class="btn btn-light" v-else @click="updateStatus(data.cat_id,1)">Disabled</button>
                            </td>
                        </tr>
                    </tbody>
                </table>  
            </div>  
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            nameCat: "",
            listCat: []
        }
    },
    mounted(){
        this.listCatService()
    },
    methods: {
        addCategory(){
            const formData = new FormData()
            formData.append('name',this.nameCat)

            axios.post('api/category/add',formData)
            .then(response => {
                //clear field
                this.nameCat = ""
                //load list again
                this.listCatService()
            })
            .catch(error => {
                alert(error)
            })
        },
        listCatService(){
            axios.get('api/category/list')
            .then(response=>{
                //load data
                this.listCat = response.data
            })
            .catch(error => {
                alert(error)
            })
        },
        updateStatus(id,status){
            const formData = new FormData()
            formData.append('idcat',id)
            formData.append('status',status)

            axios.post('api/category/change-status',formData)
            .then(response => {
                //clear field
                //load list again
                this.listCatService()
            })
            .catch(error => {
                alert(error)
            })
        }
    }
}
</script>