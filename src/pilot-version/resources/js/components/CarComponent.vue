<template>
    <div class="container mt-5"  v-for="(car, index) in cars" :key="index">
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
                    <tr>
                        <th scope="row">{{ car.car_id }}</th>
                        <td>{{ car.number_plate }}</td>
                        <td>{{ car.car_type }}</td>
                        <td>{{ car.start_date }}</td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#editCarModal' + index">編集</button>
                            <button type="button" class="btn btn-danger btn-sm">削除</button></td>
                    </tr>
                </tbody>
            </table>

        <!-- Edit Car Modal -->
        <div class="modal fade" :id="'editCarModal' + index" tabindex="-1" role="dialog" aria-labelledby="editCarModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCarModalLabel">自動車編集</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="number_plate">ナンバープレート</label>
                                <input type="text" class="form-control" name="number_plate" v-model="car.number_plate" value="{{ old('number_plate') }}">
                            </div>
                            <div class="form-group">
                                <label for="car_type">車種</label>
                                <input type="text" class="form-control" name="car_type" v-model="car.car_type" value="{{ old('car_type') }}">
                            </div>
                            <div class="form-group">
                                <label for="start_date">製造年</label>
                                <input type="date" class="form-control" name="start_date" v-model="car.start_date" value="{{ old('start_date') }}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <form method="post" action="{{ action('CarController@update', car.car_id) }}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    props: ["cars", "car"],
    data(){
        return{
            car: {}
        }
    },
}
</script>