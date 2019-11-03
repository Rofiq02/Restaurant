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
                        <tr v-for="data in listCat" :key="data">
                            <td></td>
                            <td>{{ data.cat_name }}</td>
                            <td>
                                <button type="button" class="btn btn-info" v-if="data.cat_active==1" @click="updateStatus(data.cat_id,0)">Active</button>
                                <button type="button" class="btn-btn-light" v-else @click="updateStatus(data.cat_id,1)">Disabled</button>
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
    data
}
</script>