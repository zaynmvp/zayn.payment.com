<?php /*a:1:{s:43:"/www/zayn.payment.com/view/order/index.html";i:1625643508;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>充值</title>
    <!-- 引入样式文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vant@2.12/lib/index.css"/>
</head>
<body>
<div id="app">
    <van-form style="width: 350px;margin: auto">
        <van-row type="flex">
            <van-button class="button" :plain="index != form.amount" type="danger" v-for="(desc,index) in amount_config"
                        @click="changeAmount(index)">{{desc}}
            </van-button>
        </van-row>
        <van-row type="flex" align="center">
            <van-row class="label">用户ID</van-row>
            <van-row>
                <van-field v-model="form.user_id" disabled readonly placeholder="用户ID"/>
            </van-row>
        </van-row>

        <van-row type="flex" align="center">
            <van-row class="label">支付方式</van-row>
            <van-row type="flex">
                <van-button :plain="index != form.pay_type" type="primary" v-for="(desc,index) in pay_type_config"
                            @click="changePayType(index)" class="button">{{desc}}
                </van-button>
            </van-row>
        </van-row>
        <van-row type="flex" justify="space-around">
            <van-button style="width: 150px;margin:20px; border-radius: 6px" block type="info" @click="onSubmit"
                        size="large">提交
            </van-button>
        </van-row>
    </van-form>
</div>

</body>

<!-- 引入 Vue 和 Vant 的 JS 文件 -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6/dist/vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vant@2.12/lib/vant.min.js"></script>
<script src="/static/jquery.min.js">
</script>
<script>
    new Vue({
        el: '#app',
        data: function () {
            return {
                amount_config: {
                    100: '10:10',
                    300: '20:20',
                    500: '30:30',
                    1000: '30:30'
                },
                pay_type_config: {
                    1: '微信',
                    2: '支付宝'
                },
                form: {
                    user_id: '<?php echo htmlentities($user_id); ?>',
                    amount: '<?php echo htmlentities($amount); ?>',
                    pay_type: '<?php echo htmlentities($pay_type); ?>'
                }
            }
        },
        methods: {
            onSubmit() {
                const params = $.param(this.form)
                switch (this.form.pay_type) {
                    case '1':
                        window.location.href = '/wx_pay?' + params
                        break
                    case '2':
                        window.location.href = '/zfb_pay?' + params
                        break
                    default:
                        alert('未知的支付方式')
                }
            },
            changeAmount(index) {
                this.form.amount = index
            },
            changePayType(index) {
                this.form.pay_type = index
            }
        }
    });
</script>
<style>
    #app {
        margin-top: 100px;
    }

    #app .van-row {
        margin-top: 20px;
    }

    html, body {
        margin: 0;
        padding: 0;
        background: #eeedec;
    }

    .label {
        color: #928f8f;
        margin-right: 30px;
        width: 100px;
    }

    .button {
        width: 85px;
        margin: 10px 25px 0 0;
    }

    .van-button--danger {
        background-color: #f1722d;
        border: 1px solid #f1722d;
        color: #fff;
    }

    .van-button--plain.van-button--danger {
        background-color: #fff;
    }
</style>
</html>