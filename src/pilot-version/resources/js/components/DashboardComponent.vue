<template>
        <div class="content">
            <nav>
                <!-- Navigation items (if necessary) -->
            </nav>

            <main>
                <div class="card-columns">

                    <div class="card">
                        <div class="card-header">
                            運転日報
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">最新の報告</h5>
                            <p class="card-text">報告日: 2023-10-15</p>
                            <a href="#" class="btn btn-primary">報告を見る</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            PDFデータ抽出
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">最新の抽出データ</h5>
                            <p class="card-text">抽出日: 2023-10-15</p>
                            <a href="#" class="btn btn-primary">データを見る</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            ユーザーマスタ
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">ユーザー管理</h5>
                            <p class="card-text">システムのユーザー情報を管理します。</p>
                            <a :href="user" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            自動車マスタ
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">自動車管理</h5>
                            <p class="card-text">システムで管理されている自動車情報を確認、編集します。</p>
                            <a :href="car" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            所属マスタ
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">所属管理</h5>
                            <p class="card-text">ユーザーの所属部署やチーム情報を管理します。</p>
                            <a :href="department" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>

                </div>
            </main>


            <aside>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab"
                           aria-controls="notifications" aria-selected="true">通知情報</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="stickies-tab" data-toggle="tab" href="#stickies" role="tab"
                           aria-controls="stickies" aria-selected="false">付箋</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="memos-tab" data-toggle="tab" href="#memos" role="tab"
                           aria-controls="memos" aria-selected="false">メモ</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="notifications" role="tabpanel"
                         aria-labelledby="notifications-tab">
                        ここに通知情報の内容が表示されます。
                    </div>
                    <div class="tab-pane fade" id="stickies" role="tabpanel" aria-labelledby="stickies-tab">
                        ここに付箋の内容が表示されます。
                    </div>
                    <div class="tab-pane fade" id="memos" role="tabpanel" aria-labelledby="memos-tab">
                        ここにメモの内容が表示されます。
                    </div>
                </div>
            </aside>
        </div>

        <footer>
            © 2023 nnpo
        </footer>
</template>

<script>
    export default {
        mounted() {
    },
    data(){
        return{
            car: '/car',
            department: '/department',
            user: '/user',
        }
    }
    };
</script>