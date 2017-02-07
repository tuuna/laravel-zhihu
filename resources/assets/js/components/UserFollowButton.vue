<template>
    <button class="btn btn-default" v-bind:class="{'btn-success':followed}" v-text="text" v-on:click="follow"></button>
</template>

<script>
    export default{
        props:['question'],
        mounted() {
            this.$http.post('/api/user/followers',
            { 'question':this.question })
                .then(response => {
                    this.followed = response.data.followed
                })
        },
        data() {
            return {
                followed: false
            }
        },
        computed: {
            text() {
                return this.followed ?
                            '已关注' : '关注他'
            }
        },
        methods:{
            follow() {
                this.$http.post('/api/user/follow',{ 'question':this.question })
                    .then(response => {
                        this.followed = response.data.followed
                    })
            }
        },

    }
</script>
