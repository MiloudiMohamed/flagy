<template>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Leaderboard
                <span class="pull-right" @click.prevent="refresh">
                     <i class="fa fa-refresh" :class="{ 'fa-spin': loading }"></i>
                </span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                            <th>N°</th>
                            <th>Username</th>
                            <th>Points</th>
                            <th>Played time</th>
                            <th>Since</th>
                        </tr>
                    </thead>
                    <tbody v-if="score !== null">
                        <tr v-for="(user, index) in score" :class="{'info': userId === user.user.id }">
                            <td>{{ index+1 }}</td>
                            <td>{{ user.user.name }}</td>
                            <td>{{ user.points }}</td>
                            <td>{{ user.played_time }}</td>
                            <td>{{ user.human_date }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                score: null,
                loading: false
            }
        },

        computed: {
            userId () {
                return window.flagy.user.id
            }
        },

        methods: {
            refresh () {
                this.fetchScore()
            },

            fetchScore () {
                this.loading = true
                axios.get('/score').then((response) => {
                    this.score = response.data
                    this.loading = false
                })
            }
        },

        mounted() {
            this.fetchScore()
        }
    }
</script>
