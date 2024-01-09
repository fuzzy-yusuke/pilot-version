<template>
    <div class="container mt-5">
        <h2>所属マスタ管理</h2>
        <form  action="/department" method="get">
            <input type="text" name="keyword">
            <button type="submit" class="btn btn-primary btn-sm">検索</button>
        </form>
        <button type="button" v-on:click="showNewModal()" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addDepartmentModal">新規追加</button>

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
                        <button v-on:click="showNewModal(index)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDepartmentModal">複写</button>
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
                                <input type="text" class="form-control" name="department_name" v-model="department_name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">電話番号</label>
                                <input type="text" class="form-control" name="phone_number" v-model="phone_number" required>
                            </div>
                            <div class="form-group">
                                <label for="fax_number">FAX番号</label>
                                <input type="text" class="form-control" name="fax_number" v-model="fax_number">
                            </div>
                            <div class="form-group">
                                <label for="postal_code">郵便番号</label>
                                <input type="text" class="form-control" name="postal_code" v-model="postal_code">
                            </div>
                            <div class="form-group">
                                <label for="address1">住所1</label>
                                <input type="text" class="form-control" name="address1" v-model="address1" required>
                            </div>
                            <div class="form-group">
                                <label for="address2">住所2</label>
                                <input type="text" class="form-control" name="address2" v-model="address2">
                            </div>
                            <div class="form-group">
                                <label for="address3">住所3</label>
                                <input type="text" class="form-control" name="address3" v-model="address3">
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
                        <input type="hidden" name="department_id" v-model="department_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="department_id">所属ID</label>
                                <input type="text" disabled class="form-control" name="department_id" v-model="department_id">
                            </div>
                            <div class="form-group">
                                <label for="department_name">所属名</label>
                                <input type="text" class="form-control" name="department_name" v-model="department_name">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">電話番号</label>
                                <input type="text" class="form-control" name="phone_number" v-model="phone_number">
                            </div>
                            <div class="form-group">
                                <label for="fax_number">FAX番号</label>
                                <input type="text" class="form-control" name="fax_number" v-model="fax_number">
                            </div>
                            <div class="form-group">
                                <label for="postal_code">郵便番号</label>
                                <input type="text" class="form-control" name="postal_code" v-model="postal_code">
                            </div>
                            <div class="form-group">
                                <label for="address1">住所1</label>
                                <input type="text" class="form-control" name="address1" v-model="address1">
                            </div>
                            <div class="form-group">
                                <label for="address2">住所2</label>
                                <input type="text" class="form-control" name="address2" v-model="address2">
                            </div>
                            <div class="form-group">
                                <label for="address3">住所3</label>
                                <input type="text" class="form-control" name="address3" v-model="address3">
                            </div>
                            <div class="form-group">
                                <label for="start_date">開始日</label>
                                <input type="date" class="form-control" name="start_date" v-model="start_date">
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
            phone_number: '',
            fax_number: '',
            postal_code: '',
            address1: '',
            address2: '',
            address3: '',
            start_date: '',
            end_date: '',
            update_program: '',
        }
    },
    methods:{
        showNewModal(index){
            if(index == null){
                this.department_id = null;
                this.department_name = null;
                this.phone_number = null;
                this.fax_number = null;
                this.postal_code = null;
                this.address1 = null;
                this.address2 = null;
                this.address3 = null;
                this.start_date = null;
                this.end_date = null;
                this.update_program = null;
            }else{
                this.department_id = this.departments[index].department_id;
                this.department_name = this.departments[index].department_name;
                this.phone_number = this.departments[index].phone_number;
                this.fax_number = this.departments[index].fax_number;
                this.postal_code = this.departments[index].postal_code;
                this.address1 = this.departments[index].address1;
                this.address2 = this.departments[index].address2;
                this.address3 = this.departments[index].address3;
                this.start_date = this.departments[index].start_date;
                this.end_date = this.departments[index].end_date;
                this.update_program = this.departments[index].update_program;
            }
        },
        showEditModal(index){
            console.log("showEditModal:" + index);
            this.department_id = this.departments[index].department_id;
            this.department_name = this.departments[index].department_name;
            this.phone_number = this.departments[index].phone_number;
            this.fax_number = this.departments[index].fax_number;
            this.postal_code = this.departments[index].postal_code;
            this.address1 = this.departments[index].address1;
            this.address2 = this.departments[index].address2;
            this.address3 = this.departments[index].address3;
            this.start_date = this.departments[index].start_date;
            this.end_date = this.departments[index].end_date;
            this.update_program = this.departments[index].update_program;
        }
    }
};
</script>