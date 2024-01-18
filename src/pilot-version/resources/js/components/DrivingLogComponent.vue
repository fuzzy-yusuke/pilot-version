<template>
    <div class="container mt-5">
            <h2>運転日報一覧</h2>
            <form action="/drivinglog" method="get">
                <input type="text" name="keyword">
                <button type="submit" class="btn btn-primary btn-sm">検索</button>
            </form>
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createLogModal">新規作成</button>
            <table class="table">
                <thead>
                    <tr>
                        <th>運転日</th>
                        <th>作成者</th>
                        <th>営業車</th>
                        <th>目的地</th>
                        <th>出発時間</th>
                        <th>到着時間</th>
                        <th>運転免許証</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(drivinglog, index) in drivinglogs" :key="index">
                        <!-- 運転日報データのサンプル表示 -->
                        <td>{{ drivinglog.updated_at }}</td>
                        <td>{{ drivinglog.user_name }}</td>
                        <td>{{ drivinglog.car_type }}</td>
                        <td>{{ drivinglog.destination }}</td>
                        <td>{{ drivinglog.departure_time }}</td>
                        <td>{{ drivinglog.arrival_time }}</td>
                        <td>{{ drivinglog.license_confirmation }}</td>
                        <td>
                            <form action="/drivinglog/delete" method="POST" @submit="submit(index)">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="log_id" :value="drivinglog.log_id">
                            <button type="button" v-on:click="showEditModal(index)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editLogModal">編集</button>
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 新規作成モーダル -->
        <div class="modal" id="createLogModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">新規運転日報作成</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/drivinglog/create" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="driving_date">乗車日</label>
                                <input type="date" class="form-control" name="driving_date" required>
                            </div>
                            <div class="form-group">
                                <label for="user_id">運転手</label>
                                <input type="text" class="form-control" name="user_id" v-model="user['user_name']" required>
                            </div>
                            <div class="form-group">
                                <label for="car_type">営業車</label>
                                <select class="form-select" name="car_id" v-model="car_id" required>
                                    <option v-for="car in cars" :value="car.car_id">
                                        {{ car.car_type }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="license_confirmation">運転免許証</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="license_confirmation" value=true>
                                <label class="form-check-label" for="license_confirmation">確認済み</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="license_confirmation" value=false checked>
                                <label class="form-check-label" for="license_confirmation">未確認</label>
                            </div>
                            <div class="form-group">
                                <label for="ride_time">乗車時間</label>
                                <input type="datetime-local" class="form-control" name="departure_time" required>
                                <input type="datetime-local" class="form-control" name="arrival_time" required>
                            </div>
                            <div class="form-group">
                                <label for="destination">行き先</label>
                                <input type="text" class="form-control" name="destination" required>
                            </div>
                            <div class="form-group">
                                <label for="meter">メーター 乗車時/帰社時</label>
                                <input type="number" class="form-control" name="start_mileage" required>
                                <input type="number" class="form-control" name="end_mileage" required>
                            </div>
                            <div class="form-group">
                                給油：<output id="output1">1</output>
                                <input type="range" name="fuel" value="1" min="1" max="100" step="1" oninput="document.getElementById('output1').value=this.value">
                            </div>
                            <div class="form-group">
                                <label for="pre_alcohol_checker_id">運転前チェック担当者</label>
                                <select class="form-select" name="pre_alcohol_checker_id" required>
                                    <option v-for="member in members" :value="member.user_id">
                                        {{ member.user_name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="pre_alcohol_check">運転前アルコールチェック</label>
                                <div class="d-flex justify-content-end">
                                <input type="checkbox" class="form-check-input" name="pre_alcohol_check" role="switch" value="false" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="post_alcohol_checker_id">運転後チェック担当者</label>
                                <select class="form-select" name="post_alcohol_checker_id">
                                    <option v-for="member in members" :value="member.user_id">
                                        {{ member.user_name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="post_alcohol_check">運転後アルコールチェック</label>
                                <div class="d-flex justify-content-end">
                                <input type="checkbox" class="form-check-input" name="post_alcohol_check" role="switch" value="false">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="update_program">更新プログラム</label>
                                <input type="text" class="form-control" name="update_program" v-model="update_program">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- 編集モーダル -->
        <div class="modal" id="editLogModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">運転日報編集</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="edit-driving-date">運転日</label>
                                <input type="date" class="form-control" id="edit-driving-date" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-destination">目的地</label>
                                <input type="text" class="form-control" id="edit-destination" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-departure-time">出発時間</label>
                                <input type="time" class="form-control" id="edit-departure-time" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-arrival-time">到着時間</label>
                                <input type="time" class="form-control" id="edit-arrival-time" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-start-mileage">運転開始時の走行距離</label>
                                <input type="number" class="form-control" id="edit-start-mileage" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-end-mileage">運転終了時の走行距離</label>
                                <input type="number" class="form-control" id="edit-end-mileage" required>
                            </div>
                            <!-- その他の項目もここにフォームを追加していく -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        <button type="button" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    props: ["drivinglogs", "cars", "members", "user"],
    data() {
        return {
            drivinglog: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            log_id: '',
            driving_date: '',
            car_id: '',
            car_type: '',
            license_confirmation: '',
            destination: '',
            fuel: '',
            start_mileage: '',
            end_mileage: '',
            pre_alcohol_check: '',
            pre_alcohol_checker_id: '',
            post_alcohol_check: '',
            post_alcohol_checker_id: '',
            update_program: '',
        }
    },
    methods: {
        showNewModal() {
                this.log_id = null;
                this.driving_date = null;
                this.car_id = null;
                this.car_type = null;                
                this.license_confirmation = null;
                this.fuel = null;
                this.destination = null;
                this.start_mileage = null;
                this.end_mileage = null;
                this.pre_alcohol_check = false;
                this.pre_alcohol_checker_id = null;
                this.post_alcohol_check = false;
                this.post_alcohol_checker_id = null;
                this.update_program = null;
        },
        showEditModal(index) {
            console.log("showEditModal:" + index);
            this.log_id = this.drivinglogs[index].log_id;
            this.driving_date = this.drivinglogs[index].driving_date;
            this.user_id = this.user[index].user_id;
            this.user_name = this.user[index].user_name;
            this.car_id = this.cars[index].car_id;
            this.car_type = this.cars[index].car_type;
            this.license_confirmation = this.drivinglogs[index].license_confirmation;
            this.destination = this.drivinglogs[index].destination;
            this.pre_alcohol_checker_id = this.drivinglogs[index].pre_alcohol_checker_id;
            this.post_alcohol_checker_id = this.drivinglogs[index].post_alcohol_checker_id;
            this.update_program = this.drivinglogs[index].update_program;
        },
        submit(index) {
            const ans = confirm(this.drivinglogs[index].log_id + 'を削除しますか。');
            if (!ans) event.preventDefault();
        }
    }
};
</script>