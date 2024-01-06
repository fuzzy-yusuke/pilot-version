<template>
    <div class="container mt-5">
            <h2>自動車マスタ管理</h2>

            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col">自動車ID</th>
                        <th scope="col">ナンバープレート</th>
                        <th scope="col">車種</th>
                        <th scope="col">製造年</th>
                        <th scope="col">アクション</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(car, index) in cars" :key="index">
                        <th scope="row">{{ car.car_id }}</th>
                        <td>{{ car.number_plate }}</td>
                        <td>{{ car.car_type }}</td>
                        <td>{{ car.start_date }}</td>
                        <td>
                            <form action="/car/delete" method="POST">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="car_id" :value="car.car_id">
                            <button type="button" v-on:click="showEditModal(index)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editCarModal">編集</button>
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>

        <!-- Edit Car Modal -->
        <div class="modal fade" id="editCarModal" tabindex="-1" role="dialog" aria-labelledby="editCarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCarModalLabel">自動車編集</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/car/update" method="POST">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="car_id" v-model="car_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="number_plate">ナンバープレート</label>
                                <input type="text" class="form-control" name="number_plate" v-model="number_plate">
                            </div>
                            <div class="form-group">
                                <label for="car_type">車種</label>
                                <input type="text" class="form-control" name="car_type" v-model="car_type">
                            </div>
                            <div class="form-group">
                                <label for="start_date">製造年</label>
                                <input type="date" class="form-control" name="start_date" v-model="start_date">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    props: ["cars"],
    data(){
        return{
            car: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            car_id: "",
            number_plate: "",
            car_type: "",
            start_date: "",
        }
    },
    methods: {
        showEditModal(index) {
            console.log("showEditModal:" + index);
            this.car_id = this.cars[index].car_id;
            this.number_plate = this.cars[index].number_plate;
            this.car_type = this.cars[index].car_type;
            this.start_date = this.cars[index].start_date;
        }
    }
};
</script>