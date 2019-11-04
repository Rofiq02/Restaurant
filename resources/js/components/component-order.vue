<template>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Order</h4>

                <table class="table t">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order</th>
                            <th scope="col">Amount</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(data, index) in listOrder">
                            <tr style="backgoround-color: #cecece;" :key="index">
                                <td>{{ data.ord_id }}</td>
                                <td><b>Mesa {{ data.ord_mesa }}</b> | {{ data.ord_date | moment}}</td>
                                <td>{{ data.ord_value }}</td>
                                <td>
                                    <button type="button" class="btn btn-light" @click="data.show=!data.show">Details</button>
                                </td>
                            </tr>

                            <!-- detail order -->
                            <tr v-for="(req, index) in data.requests" v-show="data.show" :key="index">
                                <td>{{ data.ord_id }}</td>
                                <td>{{ req.prod_name }}</td>
                                <td>{{ req.req_name }}</td>
                                <td>{{ req.req_qty }}</td>
                                <td>{{ req.req_value }}</td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    data(){
        return {
            listOrder: []
        }
    },
    mounted() {
        this.listOrderService()
    },
    filters: {
        moment: function(date){
            return moment(date).format('DD-MM-Y');
        }
    },
    methods: {
        listOrderService(){
            axios.get('api/order/list')
            .then(response => {
                //load data
                this.listOrder = response.data
            })
            .catch(error => {
                alert(error)
            })
        },
    }
}
</script>