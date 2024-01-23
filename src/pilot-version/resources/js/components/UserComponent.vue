<template>
    <div class="container mt-5">
        <h2>社員マスタ管理</h2>
        <form action="/user" method="get">
            <input type="text" name="keyword">
            <button type="submit" class="btn btn-primary btn-sm">検索</button>
        </form>
        <button type="button" v-on:click="showNewModal()" class="btn btn-primary mb-3"  data-toggle="modal" data-target="#addUserModal">新規追加</button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ユーザーID</th>
                    <th scope="col">所属名</th>
                    <th scope="col">ユーザー名</th>
                    <th scope="col">運用開始日</th>
                    <th scope="col">運用終了日</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(member, index) in members" :key="index">
                    <th scope="row">{{ member.user_id }}</th>
                    <td>{{ member.department_id }}</td>
                    <td>{{ member.user_name }}</td>
                    <td>{{ member.start_date }}</td>
                    <td>{{ member.end_date }}</td>
                    <td>
                        <form action="/user/delete" method="POST" @submit="submit(index)">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="user_id" :value="member.user_id">
                        <button type="button" v-on:click="showEditModal(index)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUserModal">編集</button>
                        <button type="button" v-on:click="showNewModal(index)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal">複写</button>
                        <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Add User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog"
            aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">新しい所属を追加</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/user/create" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user_id">ユーザーID</label>
                                <input type="text" class="form-control" name="user_id" required>
                            </div>
                            <div class="form-group">
                                <label for="department_name">所属名</label>
                                <select class="form-select" name="department_id" v-model="department_id" required>
                                    <option v-for="department in departments" :value="department.department_id">
                                        {{ department.department_name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_name">ユーザー名</label>
                                <input type="text" class="form-control" name="user_name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">メールアドレス</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">パスワード</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="role">役割</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="role" value=true>
                                <label class="form-check-label" for="role">テナント管理者</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="role" value=false checked>
                                <label class="form-check-label" for="role">一般ユーザー</label>
                            </div>
                            <div class="form-group">
                                <label for="start_date">運用開始日</label>
                                <input type="date" class="form-control" name="start_date" v-model="start_date" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">運用終了日</label>
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

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog"
            aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">社員情報を編集</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/user/update" method="POST">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="user_id" v-model="user_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user_id">ユーザーID</label>
                                <input type="text" disabled class="form-control" name="user_id"
                                    v-model="user_id">
                            </div>
                            <div class="form-group">
                                <label for="department_name">所属名</label>
                                <select class="form-select" name="department_id" v-model="department_id" required>
                                    <option v-for="department in departments" :value="department.department_id">
                                        {{ department.department_name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_name">ユーザー名</label>
                                <input type="text" class="form-control" name="user_name" v-model="user_name">
                            </div>
                            <div class="form-group">
                                <label for="email">メールアドレス</label>
                                <input type="email" class="form-control" name="email" v-model="email">
                            </div>
                            <div class="form-group">
                                <label for="role">役割</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="role" value=true v-model="role">
                                <label class="form-check-label" for="role">テナント管理者</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="role" value=false v-model="role">
                                <label class="form-check-label" for="role">一般ユーザー</label>
                            </div>
                            <div class="form-group">
                                <label for="start_date">運用開始日</label>
                                <input type="date" class="form-control" name="start_date" v-model="start_date">
                            </div>
                            <div class="form-group">
                                <label for="end_date">運用終了日</label>
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
    props: ["members", "departments"],
    data() {
        return {
            member: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            department_id: "",
            user_id: '',
            user_name: '',
            email: '',
            role: '',
            start_date: '',
            end_date: '',
            update_program: '',
        }
    },
    methods: {
        showNewModal(index) {
            if (index == null) {
                this.user_id = null;
                this.department_id = null;
                this.user_name = null;
                this.email = null;
                this.role = false;
                this.start_date = null;
                this.end_date = null;
                this.update_program = null;
            } else {
                this.user_id = this.members[index].user_id;
                this.department_id = this.members[index].department_id;
                this.user_name = this.members[index].user_name;
                this.role = this.members[index].role;
                this.start_date = this.members[index].start_date;
                this.end_date = this.members[index].end_date;
                this.update_program = this.members[index].update_program;
            }
        },
        showEditModal(index) {
            console.log("showEditModal:" + index);
            this.user_id = this.members[index].user_id;
            this.department_id = this.members[index].department_id;
            this.user_name = this.members[index].user_name;
            this.email = this.members[index].email;
            this.role = this.members[index].role;
            this.start_date = this.members[index].start_date;
            this.end_date = this.members[index].end_date;
            this.update_program = this.members[index].update_program;
        },
        submit(index) {
            const ans = confirm(this.members[index].user_name + 'を削除しますか。');
            if (!ans) event.preventDefault();
        }
    }
};
</script>