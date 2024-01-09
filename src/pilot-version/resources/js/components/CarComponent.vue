<template>
    <div class="container mt-5">
            <h2>自動車マスタ管理</h2>
            <form  action="/car" method="get">
                <input type="text" name="keyword">
                <button type="submit" class="btn btn-primary btn-sm">検索</button>
            </form>
            <button type="button" v-on:click="showNewModal()" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addCarModal">新規追加</button>


            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th scope="col">自動車ID</th>
                        <th scope="col">所属ID</th>
                        <th scope="col">ナンバープレート</th>
                        <th scope="col">自動車名</th>
                        <th scope="col">運用開始日</th>
                        <th scope="col">運用終了日</th>
                        <th scope="col">アクション</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(car, index) in cars" :key="index">
                        <th scope="row">{{ car.car_id }}</th>
                        <td>{{ car.department_id }}</td>
                        <td>{{ car.number_plate }}</td>
                        <td>{{ car.car_type }}</td>
                        <td>{{ car.start_date }}</td>
                        <td>{{ car.end_date }}</td>
                        <td>
                            <form action="/car/delete" method="POST">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="car_id" :value="car.car_id">
                            <button type="button" v-on:click="showEditModal(index)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editCarModal">編集</button>
                            <button type="button" v-on:click="showNewModal(index)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCarModal">複写</button>
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>

        <!-- Add Car Modal -->
            <div class="modal fade" id="addCarModal" tabindex="-1" role="dialog" aria-labelledby="addCarModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCarModalLabel">新しい自動車を追加</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/car/create" method="post">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="car_id">自動車ID</label>
                                    <input type="text" class="form-control" name="car_id" required>
                                </div>
                                <div class="form-group">
                                    <label for="department_id">所属</label>
                                    <select class="form-select" name="department_id" v-model="department_id" required>
                                        <option v-for="department in departments" :value="department.department_id">
                                            {{ department.department_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="car_type">自動車名</label>
                                    <input type="text" class="form-control" name="car_type" v-model="car_type" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">ナンバープレート</label>
                                    <input type="text" class="form-control" name="number_plate" v-model="number_plate" required>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">開始日</label>
                                    <input type="date" class="form-control" name="start_date" v-model="start_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">終了日</label>
                                    <input type="date" class="form-control" name="end_date" v-model="end_date">
                                </div>
                                <div class="form-group">
                                    <label for="update_program">更新プログラム</label>
                                    <input type="text" class="form-control" name="update_program" v-model="update_program">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                <button type="submit" class="btn btn-primary">登録</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                                    <label for="department_id">所属</label>
                                    <select class="form-select" name="department_id" v-model="department_id" required>
                                        <option v-for="department in departments" :value="department.department_id">
                                            {{ department.department_name }}
                                        </option>
                                    </select>
                                </div>
                            <div class="form-group">
                                    <label for="car_type">自動車名</label>
                                    <input type="text" class="form-control" name="car_type" v-model="car_type" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">ナンバープレート</label>
                                    <input type="text" class="form-control" name="number_plate" v-model="number_plate" required>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">開始日</label>
                                    <input type="date" class="form-control" name="start_date" v-model="start_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="end_date">終了日</label>
                                    <input type="date" class="form-control" name="end_date" v-model="end_date">
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
    props: ["cars","departments"],
    data(){
        return{
            car: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            department_id: "",
            car_id: "",
            number_plate: "",
            car_type: "",
            start_date: "",
            end_date: "",
            update_program: "",
        }
    },
    methods: {
        showNewModal(index) {
            if (index == null) {
                this.car_id = null;
                this.department_id = null;
                this.car_type = null;
                this.number_plate = null;
                this.start_date = null;
                this.end_date = null;
                this.update_program = null;
            } else {
                this.car_id = this.cars[index].car_id;
                this.department_id = this.cars[index].department_id;
                this.car_type = this.cars[index].car_type;
                this.number_plate = this.cars[index].number_plate;
                this.start_date = this.cars[index].start_date;
                this.end_date = this.cars[index].end_date;
                this.update_program = this.cars[index].update_program;
            }
        },
        showEditModal(index) {
            console.log("showEditModal:" + index);
            this.car_id = this.cars[index].car_id;
            this.department_id = this.cars[index].department_id;
            this.car_type = this.cars[index].car_type;
            this.number_plate = this.cars[index].number_plate;
            this.start_date = this.cars[index].start_date;
            this.end_date = this.cars[index].end_date;
            this.update_program = this.cars[index].update_program;
        }
    }
};
</script>