<template>
    <div id="glass">
        <h3 style="margin: 0;">瓶號生產資料庫</h3><h6><small>您的IP為@{{ ip }}</small></h6>
        <div v-if="auth">
            <form>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                        <input type="text" v-model="search" class="form-control" placeholder="請輸入瓶號">
                        <span class="input-group-btn">
                            <button v-on:click="searchGlassInfo()" class="btn btn-default" type="button">搜尋</button>
                        </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </form>
            <p></p>
            <table class="table table-bordered .table-condensed">
                <thead>
                    <tr>
                        <td>線別</td>
                        <td>瓶號</td>
                        <td>重量</td>
                        <td>機速</td>
                        <td>引出量</td>
                        <td>下支瓶號</td>
                        <td>預計換模時間</td>
                        <td>試模瓶號</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="glass in glasses">
                        <td>@{{ glass.line }}</td>
                        <td>@{{ glass.glassNumber }}</td>
                        <td>@{{ glass.weight }}</td>
                        <td>@{{ glass.speed }}</td>
                        <td>@{{ glass.quantity }}</td>
                        <td>@{{ glass.yield }}</td>
                        <td>@{{ glass.offline }}</td>
                        <td>@{{ glass.remark }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-else="auth">
            <h3>您現在不在公司範圍內，無法取得資訊!</h3>
        </div>
    </div>
</template>
<script >
    var glass = new Vue({
        el: '#glass',
        data: {
            ip: null,
            auth: false,
            glasses: [],
            search: null,

            clients: [],
            client: null,
            currentClient: null,
            newProjectClientId: {name: null, project_id: null},
            newProject: {name: null, project_id: null},
            tempClientIndex: null,
            lastRequest: false,
            msg: {success: null, error: null}
        },

        ready: function () {
            this.getIp();
        },

        methods: {
            getIp: function () {
                $.get( window.baseurl + "/api/ip", function( results ) {
                    glass.ip = results.data;
                }).fail(function(e){
                    console.log( e );
                });
            },

            searchGlassInfo: function () {
                $.get( window.baseurl + "/api/glassInfo/" + this.search, function( results ) {
                    glass.glasses = results.data;
                }).fail(function(e){
                    console.log( e );
                });
            },
        }
    });        
</script>