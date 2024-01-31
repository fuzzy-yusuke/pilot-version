<template>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            コントロールマスタ
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">コントロール管理</h5>
                            <p class="card-text">コントロールの管理が行えます。</p>
                            <a href="#" class="btn btn-primary">コントロール画面へ</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            システムユーザーマスタ
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">システムユーザー管理</h5>
                            <p class="card-text">システムユーザーの管理が行えます。</p>
                            <a href="system_users.html" class="btn btn-primary">システムユーザー画面へ</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            テナントマスタ
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">テナント管理</h5>
                            <p class="card-text">テナントの管理が行えます。</p>
                            <a :href="tenant" class="btn btn-primary">テナント画面へ</a>
                        </div>
                    </div>
                </div>
            </div>
</template>

<script>
export default {
    mounted() {
    },
    data() {
        return {
            tenant: '/admin/tenant',
        }
    }
};
</script>