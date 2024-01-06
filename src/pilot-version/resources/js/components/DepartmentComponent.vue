<template>
    <div class="container mt-5">
        <h2>所属マスタ管理</h2>

        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addDepartmentModal">新規追加</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">所属ID</th>
                    <th scope="col">所属名</th>
                    <th scope="col">作成日時</th>
                    <th scope="col">更新日時</th>
                    <th scope="col">更新者</th>
                    <th scope="col">更新プログラム</th>
                    <th scope="col">バージョン</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(department, index) in departments" :key="index">
                    <th scope="row">{{ department.department_id }}</th>
                    <td>{{ department.department_name }}</td>
                    <td>{{ department.created_at }}</td>
                    <td>{{ department.updated_at }}</td>
                    <td>{{ department.updater }}</td>
                    <td>{{ department.update_program }}</td>
                    <td>{{ department.version }}</td>
                    <td>
                        <button v-on:click="showEditModal(index)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDepartmentModal">編集</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Add Department Modal -->
        <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDepartmentModalLabel">新しい所属を追加</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/department/create" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="department_id">所属ID</label>
                                <input type="text" class="form-control" name="department_id" required>
                            </div>
                            <div class="form-group">
                                <label for="department_name">所属名</label>
                                <input type="text" class="form-control" name="department_name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">電話番号</label>
                                <input type="text" class="form-control" name="phone_number" required>
                            </div>
                            <div class="form-group">
                                <label for="fax_number">FAX番号</label>
                                <input type="text" class="form-control" name="fax_number">
                            </div>
                            <div class="form-group">
                                <label for="postal_code">郵便番号</label>
                                <input type="text" class="form-control" name="postal_code">
                            </div>
                            <div class="form-group">
                                <label for="address1">住所1</label>
                                <input type="text" class="form-control" name="address1" required>
                            </div>
                            <div class="form-group">
                                <label for="address2">住所2</label>
                                <input type="text" class="form-control" name="address2">
                            </div>
                            <div class="form-group">
                                <label for="address3">住所3</label>
                                <input type="text" class="form-control" name="address3">
                            </div>
                            <div class="form-group">
                                <label for="start_date">開始日</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">終了日</label>
                                <input type="date" class="form-control" name="end_date">
                            </div>
                            <div class="form-group">
                                <label for="update_program">更新プログラム</label>
                                <input type="text" class="form-control" name="update_program">
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

        <!-- Edit Car Modal -->
        <div class="modal fade" id="editDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="editDepartmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDepartmentModalLabel">所属を編集</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/department/update" method="POST">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="department_id">所属ID</label>
                                <input type="text" disabled class="form-control" name="department_id" v-model="department_id">
                            </div>
                            <div class="form-group">
                                <label for="department_name">所属名</label>
                                <input type="text" class="form-control" name="department_name" v-model="department_name">
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
export default {
    props: ["departments"],
    data() {
        return {
            department: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            department_id: '',
            department_name: '',
        }
    },
    methods:{
        showEditModal(index){
            console.log("showEditModal:" + index);
            this.department_id = this.departments[index].department_id;
            this.department_name = this.departments[index].department_name;
        }
    }
};
</script>