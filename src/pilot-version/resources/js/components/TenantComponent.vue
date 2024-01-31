<template>
    <div class="container mt-5">
        <h2>テナントマスタ管理</h2>
        <form action="/admin/tenant" method="get">
            <input type="text" name="keyword">
            <button type="submit" class="btn btn-primary btn-sm">検索</button>
        </form>
        <button type="button" v-on:click="showNewModal()" class="btn btn-primary mb-3" data-toggle="modal"
            data-target="#addTenantModal">新規追加</button>


        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">テナントID</th>
                    <th scope="col">テナント名</th>
                    <th scope="col">メールアドレス</th>
                    <th scope="col">運用開始日</th>
                    <th scope="col">運用終了日</th>
                    <th scope="col">利用人数</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(tenant, index) in tenants" :key="index">
                    <th scope="row">{{ tenant.tenant_id }}</th>
                    <td>{{ tenant.tenant_name1 }}</td>
                    <td>{{ tenant.admin_email }}</td>
                    <td>{{ tenant.start_date }}</td>
                    <td>{{ tenant.end_date }}</td>
                    <td>{{ tenant.number_of_users }}</td>
                    <td>
                        <form action="/admin/tenant/delete" method="POST" @submit="submit(index)">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="tenant_id" :value="tenant.tenant_id">
                            <button type="button" v-on:click="showEditModal(index)" class="btn btn-primary btn-sm"
                                data-toggle="modal" data-target="#editTenantModal">編集</button>
                            <button type="button" v-on:click="showNewModal(index)" class="btn btn-success btn-sm"
                                data-toggle="modal" data-target="#addTenantModal">複写</button>
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Add Tenant Modal -->
        <div class="modal fade" id="addTenantModal" tabindex="-1" role="dialog" aria-labelledby="addTenantModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTenantModalLabel">新しいテナントを追加</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/admin/tenant/create" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tenant_name1">テナント名1</label>
                                <input type="text" class="form-control" name="tenant_name1" required>
                            </div>
                            <div class="form-group">
                                <label for="tenant_name2">テナント名2</label>
                                <input type="text" class="form-control" name="tenant_name2">
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
                                <label for="admin_email">メールアドレス</label>
                                <input type="email" class="form-control" name="admin_email" v-model="admin_email" required>
                            </div>
                            <div class="form-group">
                                <label for="number_of_users">利用人数</label>
                                <input type="number" class="form-control" name="number_of_users" value="1" min="1" max="100" step="1" v-model="number_of_users" required>
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
                                <label for="representative">代表者名</label>
                                <input type="text" class="form-control" name="representative" v-model="representative" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_person">連絡担当者</label>
                                <input type="text" class="form-control" name="contact_person" v-model="contact_person">
                            </div>
                            <div class="form-group">
                                <label for="Invoice_Issuer">適格請求書(インボイス)発行事業者</label>
                                <input type="text" class="form-control" name="Invoice_Issuer" v-model="Invoice_Issuer">
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

        <!-- Edit Tenant Modal -->
        <div class="modal fade" id="editTenantModal" tabindex="-1" role="dialog" aria-labelledby="editTenantModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTenantModalLabel">テナント編集</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/admin/tenant/update" method="POST">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="tenant_id" v-model="tenant_id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tenant_id">テナントID</label>
                                <input type="text" disabled class="form-control" name="tenant_id" v-model="tenant_id" required>
                            </div>
                            <div class="form-group">
                                <label for="tenant_name1">テナント名1</label>
                                <input type="text" class="form-control" name="tenant_name1" v-model="tenant_name1" required>
                            </div>
                            <div class="form-group">
                                <label for="tenant_name2">テナント名2</label>
                                <input type="text" class="form-control" name="tenant_name2" v-model="tenant_name2">
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
                                <label for="admin_email">メールアドレス</label>
                                <input type="email" class="form-control" name="admin_email" v-model="admin_email" required>
                            </div>
                            <div class="form-group">
                                <label for="number_of_users">利用人数</label>
                                <input type="number" class="form-control" name="number_of_users" value="1" min="1" max="100" step="1" v-model="number_of_users" required>
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
                                <label for="representative">代表者名</label>
                                <input type="text" class="form-control" name="representative" v-model="representative" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_person">連絡担当者</label>
                                <input type="text" class="form-control" name="contact_person" v-model="contact_person">
                            </div>
                            <div class="form-group">
                                <label for="Invoice_Issuer">適格請求書(インボイス)発行事業者</label>
                                <input type="text" class="form-control" name="Invoice_Issuer" v-model="Invoice_Issuer">
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
    props: ["tenants"],
    data() {
        return {
            tenant: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            tenant_id: "",
            tenant_name1: "",
            tenant_name2: "",
            start_date: "",
            end_date: "",
            admin_email: "",
            number_of_users: "",
            phone_number: "",
            fax_number: "",
            postal_code: "",
            address1: "",
            address2: "",
            address3: "",
            representative: "",
            contact_person: "",
            Invoice_Issuer: "",
            update_program: "",
        }
    },
    methods: {
        showNewModal(index) {
            if (index == null) {
                this.tenant_name1 = null;
                this.tenant_name2 = null;
                this.start_date = null;
                this.end_date = null;
                this.admin_email = null;
                this.number_of_users = null;
                this.phone_number = null;
                this.fax_number = null;
                this.postal_code = null;
                this.address1 = null;
                this.address2 = null;
                this.address3 = null;
                this.representative = null;
                this.contact_person = null;
                this.Invoice_Issuer = null;
                this.update_program = null;
            } else {
                this.tenant_name1 = this.tenants[index].tenant_name1;
                this.tenant_name2 = this.tenants[index].tenant_name2;
                this.start_date = this.tenants[index].start_date;
                this.end_date = this.tenants[index].end_date;
                this.admin_email = this.tenants[index].admin_email;
                this.number_of_users = this.tenants[index].number_of_users;
                this.phone_number = this.tenants[index].phone_number;
                this.fax_number = this.tenants[index].fax_number;
                this.postal_code = this.tenants[index].postal_code;
                this.address1 = this.tenants[index].address1;
                this.address2 = this.tenants[index].address2;
                this.address3 = this.tenants[index].address3;
                this.representative = this.tenants[index].representative;
                this.contact_person = this.tenants[index].contact_person;
                this.Invoice_Issuer = this.tenants[index].Invoice_Issuer;
                this.update_program = this.tenants[index].update_program;
            }
        },
        showEditModal(index) {
            this.tenant_id = this.tenants[index].tenant_id;
            this.tenant_name1 = this.tenants[index].tenant_name1;
            this.tenant_name2 = this.tenants[index].tenant_name2;
            this.start_date = this.tenants[index].start_date;
            this.end_date = this.tenants[index].end_date;
            this.admin_email = this.tenants[index].admin_email;
            this.number_of_users = this.tenants[index].number_of_users;
            this.phone_number = this.tenants[index].phone_number;
            this.fax_number = this.tenants[index].fax_number;
            this.postal_code = this.tenants[index].postal_code;
            this.address1 = this.tenants[index].address1;
            this.address2 = this.tenants[index].address2;
            this.address3 = this.tenants[index].address3;
            this.representative = this.tenants[index].representative;
            this.contact_person = this.tenants[index].contact_person;
            this.Invoice_Issuer = this.tenants[index].Invoice_Issuer;
            this.update_program = this.tenants[index].update_program;
        },
        submit(index) {
            const ans = confirm(this.tenants[index].tenant_name1 + 'を削除しますか。');
            if (!ans) event.preventDefault();
        }
    }
};
</script>