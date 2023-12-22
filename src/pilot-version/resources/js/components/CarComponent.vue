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
                <tbody v-for="(car, index) in cars" :key="index">
                    <tr>
                        <th scope="row">{{ car.car_id }}</th>
                        <td>{{ car.numberplate }}</td>
                        <td>{{ car.car_type }}</td>
                        <td>{{ car.start_date }}</td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editCarModal">編集</button> <button type="button" class="btn btn-danger btn-sm">削除</button></td>
                    </tr>
                </tbody>
            </table>
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
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="carNumber">ナンバープレート</label>
                                <input type="text" class="form-control" id="carNumber" value="11-22">
                            </div>
                            <div class="form-group">
                                <label for="carType">車種</label>
                                <input type="text" class="form-control" id="carType" value="トヨタ・プリウス">
                            </div>
                            <div class="form-group">
                                <label for="manufacturingYear">製造年</label>
                                <input type="number" class="form-control" id="manufacturingYear" value="2015">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        <button type="button" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default{
    props:["cars"]
}
</script>